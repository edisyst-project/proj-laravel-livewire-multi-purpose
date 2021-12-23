<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class UpdateSettings extends Component
{
    public $state = [];


    public function mount()
    {
        $setting = Setting::first();

        if ($setting) {
            $this->state = $setting->toArray();
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

        Cache::forever('setting', $setting);

        $this->dispatchBrowserEvent('updated', ['message' => 'Settings updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.settings.update-settings');
    }
}
