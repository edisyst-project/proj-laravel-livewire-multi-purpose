<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\FileUploadConfiguration;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $image;
    public $state = [];


    public function updateProfile(UpdatesUserProfileInformation $updater)
    {
        $updater->update(auth()->user(), [
            'name'  => $this->state['name'],
            'email' => $this->state['email'],
        ]);

        $this->emit('nameChanged', auth()->user()->name);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile updated successfully!']);
    }

    public function updatedImage()
    {
        $previousPath = auth()->user()->avatar;
        $path = $this->image->store('/', 'avatars');

        auth()->user()->update(['avatar' => $path]);
        Storage::disk('avatars')->delete($previousPath);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile image changed successfully!']);
    }

    protected function cleanupOldUploads() // riscrivo questo metodo del trait WithFileUploads
    {
        $storage = Storage::disk('local');
//        dd($storage->allFiles('livewire-tmp'));

        foreach ($storage->allFiles('livewire-temp') as $filePathname) {
            $yesterdaysStamp = now()->subHours(12)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    public function mount()
    {
        $this->state = auth()->user()->only(['name', 'email']);
    }

    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }
}
