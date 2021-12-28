<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>


    <link rel="stylesheet" href="/css/app.css">


    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://www.unpkg.com/browse/tailwindcss@2.0.0/dist/tailwind.min.css">
    <!-- Animate.style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    @stack('styles')

    <!-- Livewire styles -->
    <livewire:styles />
</head>

<body class="hold-transition sidebar-mini {{ setting('sidebar_collapse') ? 'sidebar-collapse' : '' }}" >
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
<script src="/js/app.js"></script>
<script src="/js/backend.js"></script>




<!-- Apexcharts scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



@stack('js')


@stack('before-livewire-scripts')
<!-- Livewire scripts -->
<livewire:scripts />
@stack('after-livewire-scripts')

<!-- Alpine JS Plugins -->
@stack('alpine-plugins')
<!-- Alpine JS scripts -->
<script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>

</body>
</html>
