<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use App\Models\Carte;
use App\Models\VoteCarte;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Arr;
use Filament\Notifications\Notification;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $user = auth()->user();
        $carte = Carte::find($user->carte->id);
        $vote_carte = VoteCarte::find($user->vote_carte->id);
        return view('livewire.components.profile', compact('user', 'carte', 'vote_carte'));
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
            'numero' => ['nullable', 'numeric', 'maxdigits:20'],
            'date_delivrance' => ['nullable', 'date', 'max:255'],
            'date_expiration' => ['nullable', 'date', 'max:255'],
            'scan' => ['nullable', 'mimes:jpg,jpeg,png,bmp,tiff,svg', 'max:2060']
        ]);

        $carte_data = [
            'numero' => $validatedData['numero'],
            'date_delivrance' => $validatedData['date_delivrance'],
            'date_expiration' => $validatedData['date_expiration'],
        ];
        // Notification::make()
        //     ->title(__('Profile Updated successfully'))
        //     ->success()
        //     ->send();

        // return redirect()->route('parametres');
        $filteredData = array_filter($validatedData, 'strlen');
        $carte_data = array_filter($carte_data, 'strlen');

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
        $carte = Carte::find($user->carte->id);

        if (isset($filteredData['photo_profile'])) {
            $file = $request->file('photo_profile');
            $old_photo = '/images/avatars/' . $user->photo_profile;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/avatars'), $filename);
            if (File::exists(public_path($old_photo)) && $user->photo_profile != "default.jpg") {
                File::delete(public_path($old_photo));
            }
            $filteredData['photo_profile'] = $filename;
        }

        if (isset($validatedData['scan'])) {
            $file = $request->file('scan');
            $old_scan = '/images/scans/' . $user->carte->scan;
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('images/scans'), $filename);
            if (File::exists(public_path($old_scan))) {
                File::delete(public_path($old_scan));
            }
            $carte_data['scan'] = $filename;
        }

        $user->update(Arr::except($filteredData, ['numero', 'date_delivrance', 'date_expiration', 'scan']));

        $carte->update($carte_data);



        Notification::make()
            ->title(__('Profile Updated successfully'))
            ->success()
            ->send();

        return redirect()->route('parametres');
    }
}