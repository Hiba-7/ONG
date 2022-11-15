<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\UsersImport;
use App\Models\User;


class Importation extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $title = 'Import Users';
    protected static ?string $navigationGroup = 'administration';
    protected static string $view = 'filament.pages.importation';

    public function mount(): void
    {
        $this->form->fill();
    }
    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                FileUpload::make('csv_file')
                    ->label('Upload a csv File')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['text/csv'])
                    ->required(),

            ])
        ];
    }


    public function submit()
    {
        $state = $this->form->getState();
        $path = storage_path() . "/app/public/" . $state['csv_file'];
        $users_arr = Excel::toArray(new UsersImport, $path);
        $fields = array();
        $imported_users = array();
        $imported_user = array();
        // $emails = array();
        foreach ($users_arr[0] as $key => $user) {
            if ($key == 0) {
                $fields = $user;
            } else {
                foreach ($fields as $f_key => $field) {
                    $imported_user[$field] =  $user[$f_key];
                    $imported_users[$key] = $imported_user;
                }
            }
        }
        foreach ($imported_users as $key => $user) {
            $user    = new User($user);
            // array_push($emails, $user['email']);
            $user->save();
            // if ($user['email'] == 'davinci.smartcraft@gmail.com') {
            //     Mail::to($user['email'])->send(new UserMail($user['email']));
            // }
        }
        // dd($emails);
        dd($imported_users);
        return true;
    }
}