<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class UpdateSettings extends Component
{
    public $state = [];


    public function mount()
    {
        if (Setting::first()) {
            $this->state = Setting::first()->toArray();
        }
    }

    public function updateSettings()
    {
        $setting = Setting::first();

        if ($setting){
            $setting->update($this->state);
        } else {
            Setting::create($this->state);
        }

        $this->dispatchBrowserEvent('updated', ['message' => 'Settings updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.settings.update-settings');
    }
}
