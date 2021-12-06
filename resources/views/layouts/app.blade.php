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

<script>
    $(document).ready(function () {
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
