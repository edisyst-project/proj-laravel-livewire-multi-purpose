<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Exports\AppointmentsExport;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;

class ListAppointments extends AdminComponent
{
    protected $listeners = [
        'deleteConfirmed' => 'deleteAppointment',
    ];

    public $appointmentIdBeingRemoved = null;
    public $status = null;

    protected $queryString = ['status'];
    public $selectedRows = [];
    public $selectPageRows = false;


    public function updateAppointmentsOrder($items)
    {
//        dd($items);
        foreach ($items as $item){
            Appointment::find($item['value'])->update([
                'order_position' => $item['order']
            ]);
        }

        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments sorted!']);
    }

    public function export()
    {
        return (new AppointmentsExport($this->selectedRows))->download('appointments.xlsx');
//        return Excel::download(new AppointmentsExport, 'appointments.xlsx');
    }

    public function markAllAsClosed()
    {
        Appointment::whereIn('id',$this->selectedRows)->update([
            'status' => 'CLOSED',
        ]);

        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as closed!']);

        $this->reset(['selectedRows']);
        $this->reset(['selectPageRows']);
    }

    public function markAllAsScheduled()
    {
        Appointment::whereIn('id',$this->selectedRows)->update([
            'status' => 'SCHEDULED',
        ]);

        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as scheduled!']);

        $this->reset(['selectedRows']);
        $this->reset(['selectPageRows']);
    }

    public function deleteSelectedRows()
    {
        Appointment::whereIn('id',$this->selectedRows)->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected appointments got deleted!']);

        $this->reset(['selectedRows']);
        $this->reset(['selectPageRows']);
    }

    public function updatedSelectPageRows($value)
    {
        if ($value){
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id){
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows']);
            $this->reset(['selectPageRows']);
        }
    }


    public function getAppointmentsProperty()
    {
        return Appointment::with('client')
            ->when($this->status, function ($query, $status){
                return $query->where('status', $status);
            })
//            ->latest()
            ->orderBy('order_position')
            ->paginate(5);
    }

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
        $appointments = $this->appointments;

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
