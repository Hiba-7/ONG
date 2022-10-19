<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Http\Request;
use File;
use Filament\Notifications\Notification;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $user = auth()->user();
        return view('livewire.components.profile', compact('user'));
    }
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'photo_profile' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060'],
            'email' => ['nullable', 'email', 'unique:users', 'max:255', 'unique:users'],
            'nom' => ['nullable', 'sometimes', 'string', 'max:255'],
            'prénom' => ['nullable', 'string', 'max:255'],
            'adresse' => ['nullable', 'string'],
            'téléphone' => ['nullable', 'string', 'max:255'],
        ]);

        // Notification::make()
        //     ->title(__('Profile Updated successfully'))
        //     ->success()
        //     ->send();

        // return redirect()->route('parametres');
        $filteredData = array_filter($validatedData, 'strlen');



        if (empty($filteredData)) {
            Notification::make()
                ->title(__('No Changes Detected'))
                ->danger()
                ->send();

            $error = \Illuminate\Validation\ValidationException::withMessages([
                'form' => ['Form is empty'],
            ]);
            throw $error;
        }
        $user = User::find(auth()->user())[0];

        if (isset($filteredData['photo_profile'])) {
            $file = $request->file('photo_profile');
            $old_photo = '/images/avatar/' . $user->photo_profile;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/avatar'), $filename);
            if (File::exists(public_path($old_photo))) {
                File::delete(public_path($old_photo));
            }
            $filteredData['photo_profile'] = $filename;
        }


        $user->update($filteredData);



        Notification::make()
            ->title(__('Profile Updated successfully'))
            ->success()
            ->send();

        return redirect()->route('parametres');
    }
}