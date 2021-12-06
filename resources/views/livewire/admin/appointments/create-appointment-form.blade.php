
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
                    <li class="breadcrumb-item"><a href="#">Appointments</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
            <div class="col-md-6">
                <form wire:submit.prevent="createAppointment">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add new Appointment</h3>
                        </div>
                        <div class="card-body">

                            <!-- Client select -->
                            <div class="form-group">
                                <label>Client:</label>
                                <select wire:model.defer="state.client_id" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date -->
                            <div class="form-group">
                                <label>Appointment Date:</label>
                                <div wire:ignore class="input-group date" id="appointmentDate" data-target-input="nearest" data-appointment-date="@this">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDate" id="appointmentDateInput">
                                    <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Time Picker -->
                            <div class="form-group">
                                <label>Appointment Time:</label>
                                <div wire:ignore class="input-group date" id="appointmentTime" data-target-input="nearest" data-appointment-time="@this">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#appointmentTime" id="appointmentTimeInput">
                                    <div class="input-group-append" data-target="#appointmentTime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Textarea Note -->
                            <div class="form-group">
                                <label>Note:</label>
                                <textarea wire:model.defer="state.note" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
