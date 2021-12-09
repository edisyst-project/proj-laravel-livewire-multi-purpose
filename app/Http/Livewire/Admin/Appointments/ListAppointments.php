<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Illuminate\Support\Facades\App;

class ListAppointments extends AdminComponent
{
    protected $listeners = [
        'deleteConfirmed' => 'deleteAppointment',
    ];

    public $appointmentIdBeingRemoved = null;
    public $status = null;

    protected $queryString = ['status'];

    public function filterAppointmentByStatus($status = null)
    {
        $this->resetPage();

        $this->status = $status;
    }


    public function confirmDeleteAppointment($appointmentId)
    {
        $this->appointmentIdBeingRemoved = $appointmentId;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }


    public function deleteAppointment()
    {
        $appointment = Appointment::findOrFail($this->appointmentIdBeingRemoved);
        $appointment->delete();

        $this->dispatchBrowserEvent('appointment-delete', ['message' => 'Appointment deleted successfully!']);
    }


    public function render()
    {
        $appointments = Appointment::with('client')
            ->when($this->status, function ($query, $status){
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(3);

        $appointmentsCount = Appointment::count();
        $scheduledAppointmentsCount = Appointment::where('status', 'SCHEDULED')->count();
        $closedAppointmentsCount = Appointment::where('status', 'CLOSED')->count();

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' => $appointments,
            'appointmentsCount' => $appointmentsCount,
            'scheduledAppointmentsCount' => $scheduledAppointmentsCount,
            'closedAppointmentsCount' => $closedAppointmentsCount,
        ]);
    }
}
