<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status' => "SCHEDULED",
    ];


    public function createAppointment()
    {
//        dd($this->state['color']);
        Validator::make(
            $this->state,
            [
                'client_id' => ['required'],
                'date'      => ['required'],
                'time'      => ['required'],
                'status'    => ['required', 'in:SCHEDULED,CLOSED'],
                'note'      => ['nullable'],
                'members'   => ['required'],
                'color'     => ['required'],
            ],[
                'client_id.required' => 'YOU HAVE TO SELECT A CLIENT!!!!!!',
        ])->validate();

//        dd($this->state['color']);

        Appointment::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']);
    }


    public function render()
    {
        $clients = Client::all();

        return view('livewire.admin.appointments.create-appointment-form', compact('clients'));
    }
}
