<div>

    @this

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
                    <form wire:submit.prevent="createAppointment" autocomplete="off">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add new Appointment</h3>
                            </div>
                            <div class="card-body">

                                <!-- Client select + Status select -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Client:</label>
                                            <select wire:model.defer="state.client_id"
                                                    class="form-control select2  @error('client_id') is-invalid @enderror"
                                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option value="">---Select client---</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Team Members</label>
                                            <x-inputs.select2 wire:model="state.members" fake="here" id="members" placeholder="Select members">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </x-inputs.select2>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Others</label>
                                            <x-inputs.select2 wire:model="state.others" id="others" placeholder="Select others">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </x-inputs.select2>
                                        </div>
                                    </div>


                                </div>

                                <!-- COMPONENT Time Picker -->
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label>Appointment Start Time:</label>--}}
{{--                                        <div class="input-group date" data-target-input="nearest">--}}
{{--                                            <x-timepicker wire:model.defer="state.start_time" id="appointmentStartTime"></x-timepicker>--}}
{{--                                            <div class="input-group-append" data-target="#appointmentStartTime" data-toggle="datetimepicker">--}}
{{--                                                <div class="input-group-text"><i class="far fa-clock"></i></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label>Appointment End Time:</label>--}}
{{--                                        <div class="input-group date" data-target-input="nearest">--}}
{{--                                            <x-timepicker wire:model.defer="state.end_time" id="appointmentEndTime"></x-timepicker>--}}
{{--                                            <div class="input-group-append" data-target="#appointmentEndTime" data-toggle="datetimepicker">--}}
{{--                                                <div class="input-group-text"><i class="far fa-clock"></i></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <!-- Date -->
                                <div class="form-group">
                                    <label>Appointment Date:</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <x-datepicker wire:model.defer="state.date" id="appointmentDate" :error="'date'"></x-datepicker>
                                        <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Appointment Date:</label>--}}
{{--                                    <div wire:ignore class="input-group date" id="appointmentDate" data-target-input="nearest" data-appointment-date="@this">--}}
{{--                                        <input type="text" class="form-control datetimepicker-input" data-target="#appointmentDate" id="appointmentDateInput">--}}
{{--                                        <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">--}}
{{--                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <!-- Time Picker -->
                                <div class="form-group">
                                    <label>Appointment Time:</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <x-timepicker wire:model.defer="state.time" id="appointmentTime" :error="'time'"></x-timepicker>
                                        <div class="input-group-append" data-target="#appointmentTime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        @error('time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Textarea Note -->
                                <div class="form-group" wire:ignore>
                                    <label>Note:</label>
                                    <textarea  id="appointmentNote" data-appointment-note="@this" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <select wire:model.defer="state.status"
                                                    class="form-control select2  @error('status') is-invalid @enderror"
                                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option value="">---Select status---</option>
                                                <option value="SCHEDULED">Scheduled</option>
                                                <option value="CLOSED">Closed</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                                <button type="submit" id="appointmentSave" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save</button>
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
</div>


@push('js')


    <!-- CK Editor scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#appointmentNote' ) )
            .then( editor => {
                console.log( editor );
                editor.model.document.on('change:data', () =>{
                    // let note = $('#appointmentNote').data('appointment-note');
                    // // console.log($('#appointmentNote').val())
                    // // eval(note).set('state.note', $('#appointmentNote').val());
                    // eval(note).set('state.note', editor.getData());
                    document.querySelector('#appointmentSave').addEventListener('click', () => {
                        let note = $('#appointmentNote').data('appointment-note');
                        eval(note).set('state.note', editor.getData());
                    });
                });
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endpush
