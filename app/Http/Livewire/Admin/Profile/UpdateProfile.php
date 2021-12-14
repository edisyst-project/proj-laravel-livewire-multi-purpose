<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\FileUploadConfiguration;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $image;


    public function updatedImage()
    {
        $previousPath = auth()->user()->avatar;
//        dd($previousPath);

        $path = $this->image->store('/', 'avatars');
//        dd($path);

        auth()->user()->update(['avatar' => $path]);
        Storage::disk('avatars')->delete($previousPath);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile changed successfully!']);
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

    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }
}
