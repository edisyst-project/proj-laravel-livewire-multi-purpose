<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multi-Purpose Proj</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

    <!-- Toastr styles -->
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <!-- Tempus Dominus styles -->
    <link href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>
    <!-- iCheck styles (AdminLTE) -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- LoadAwesome styles -->
{{--    <link href="{{ asset('css/loadawesome.css') }}" rel="stylesheet"/>--}}

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://www.unpkg.com/browse/tailwindcss@2.0.0/dist/tailwind.min.css">
    <!-- Animate.style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        .custom-error .select2-selection {
            border: none;
        }
    </style>


    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">


    @stack('styles')

    <!-- Livewire styles -->
    <livewire:styles />

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

<!-- Toastr scripts -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- Tempus Dominus scripts -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Alpine JS scripts -->
<script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>

<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<!-- Apexcharts scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<script>
    $(document).ready(function () {
        // $('#appointmentDate').datetimepicker({
        //     format: 'L'
        // });
        //
        // $('#appointmentTime').datetimepicker({
        //     format: 'LT'
        // });
        //
        // $("#appointmentDate").on("change.datetimepicker", function (e) {
        //     // $('#appointmentDate').datetimepicker('minDate', e.date);
        //     let date = $(this).data('appointment-date');
        //     // console.log(date);
        //     eval(date).set('state.date', $('#appointmentDateInput').val());
        // });
        //
        // $("#appointmentTime").on("change.datetimepicker", function (e) {
        //     let time = $(this).data('appointment-time');
        //     eval(time).set('state.time', $('#appointmentTimeInput').val());
        // });

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
    window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success !!!');
    })
    window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success !!!');
    })
</script>

@stack('js')

<!-- Livewire scripts -->
<livewire:scripts />


</body>
</html>
