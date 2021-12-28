<div>
    <x-loading-indicator />

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointments List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <a href="{{route('admin.appointments.create')}}">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New Appointment
                            </button>
                        </a>

                        @if ($selectedRows)
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Bulk Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a wire:click.prevent="markAllAsScheduled" class="dropdown-item" href="#">Mark as Scheduled</a>
                                    <a wire:click.prevent="markAllAsClosed" class="dropdown-item" href="#">Mark as Closed</a>
                                    <div class="dropdown-divider"></div>
                                    <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">Delete Selected</a>
                                    <a wire:click.prevent="export" class="dropdown-item" href="#">Export XLS</a>
                                </div>
                                <span class="ml-4">
                                    Selected {{ count($selectedRows) }} {{ \Illuminate\Support\Str::plural('appointment', count($selectedRows)) }}
                                </span>
                            </div>
                        @endif

                        <div class="btn-group">
                            <button wire:click="filterAppointmentByStatus" type="button"
                                    class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info">{{ $appointmentsCount }}</span>
                            </button>
                            <button wire:click="filterAppointmentByStatus('SCHEDULED')" type="button"
                                    class="btn {{ ($status == 'SCHEDULED') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Scheduled</span>
                                <span class="badge badge-pill badge-primary">{{ $scheduledAppointmentsCount }}</span>
                            </button>
                            <button wire:click="filterAppointmentByStatus('CLOSED')" type="button"
                                    class="btn {{ ($status == 'CLOSED') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Closed</span>
                                <span class="badge badge-pill badge-success">{{ $closedAppointmentsCount }}</span>
                            </button>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">
                                        <div class="icheck-primary d-inline ml-2">
                                            <input wire:model="selectPageRows" type="checkbox" id="todoCheck2" value="">
                                            <label for="todoCheck2"></label>
                                        </div>
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody wire:sortable="updateAppointmentsOrder">
                                @forelse($appointments as $appointment)
                                    <tr wire:sortable.item="{{ $appointment->id }}" wire:key="task-{{ $appointment->id }}">
                                        <td wire:sortable.handle style="cursor: move;"><i class="fa fa-arrows-alt"></i></td>
                                        <td>
                                            <div class="icheck-primary d-inline ml-2">
                                                <input wire:model="selectedRows" type="checkbox" value="{{ $appointment->id }}" id="{{ $appointment->id }}">
                                                <label for="{{ $appointment->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->client->name }}</td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>
                                            <span class="badge badge-{{ $appointment->status_badge }}">{{ $appointment->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.appointments.edit', $appointment)}}">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>
                                            <a href="#" wire:click.prevent="confirmDeleteAppointment({{ $appointment->id }})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-default-danger text-bold">NO APPOINTMENTS YET</div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
{{--                            @dump($selectedRows)--}}
{{--                            @dump($selectPageRows)--}}
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $appointments->links() }}
                    </div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <x-confirmation-alert />
</div>

@push('styles')
    <style>
        .draggable-mirror {
            background-color: white;
            width: 950px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
    </style>
@endpush


@push('after-livewire-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush
