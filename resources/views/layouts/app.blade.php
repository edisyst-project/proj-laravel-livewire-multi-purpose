<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

    <!-- Livewire styles -->
    <livewire:styles />
    <!-- Toastr styles -->
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <!-- Tempus Dominus styles -->
    <link href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')
    <!-- END Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{ $slot }}
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @include('layouts.partials.aside')
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.partials.footer')
    <!-- /.main-footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

<!-- Livewire scripts -->
<livewire:scripts />
<!-- Toastr scripts -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- Tempus Dominus scripts -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
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

<script>
    $(document).ready(function () {
        $('#appointmentDate').datetimepicker({
            format: 'L'
        });

        $('#appointmentTime').datetimepicker({
            format: 'LT'
        });

        $("#appointmentDate").on("change.datetimepicker", function (e) {
            // $('#appointmentDate').datetimepicker('minDate', e.date);
            let date = $(this).data('appointment-date');
            // console.log(date);
            eval(date).set('state.date', $('#appointmentDateInput').val());
        });

        $("#appointmentTime").on("change.datetimepicker", function (e) {
            let time = $(this).data('appointment-time');
            eval(time).set('state.time', $('#appointmentTimeInput').val());
        });

        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }

        window.addEventListener('hide-form', event => {
            $('#form').modal('hide');
            toastr.success(event.detail.message, 'Success !!!');
        })
    })
</script>

<script>
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })
    window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
    })
    window.addEventListener('show-delete-modal', event => {
        $('#confirmDeleteModal').modal('show');
    })
    window.addEventListener('hide-delete-modal', event => {
        $('#confirmDeleteModal').modal('hide');
        toastr.success(event.detail.message, 'Success !!!');
    })
</script>

</body>
</html>
