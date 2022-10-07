<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Validator;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;




class ProfilePass extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                Grid::make(2)->schema([
                    TextInput::make('current_password')
                        ->label('Mot de passe courant')
                        ->autofocus()
                        ->password()
                        ->rules([
                            function () {
                                return function (string $label, $value, $fail) {
                                    if (!Hash::check($value, User::find(auth()->id())->password)) {
                                        $fail(__('validation.current_password'));
                                    }
                                };
                            },
                        ])
                        ->required(),
                ]),

                TextInput::make('new_password')
                    ->label('Nouveau mot de passe')
                    ->password()
                    ->minLength(8)
                    ->maxLength(20)
                    ->different('current_password')
                    ->confirmed()
                    ->required(),

                TextInput::make('new_password_confirmation')
                    ->label('Confirmer le nouveau mot de passe')
                    ->password()
                    ->required(),

            ])
        ];
    }

    public function submit(): void
    {
        $state = $this->form->getState();
        $user = User::find(auth()->id());
        $user->password = $state['new_password'];
        $user->save();
        Notification::make()
            ->title(__('Password changed successfully'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        App::setLocale('fr');
        return view('livewire.components.profile-pass');
    }
}