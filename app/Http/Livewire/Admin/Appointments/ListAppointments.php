<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{





    public function render()
    {
        $appointments = Appointment::all();

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' => $appointments
        ]);
    }
}
