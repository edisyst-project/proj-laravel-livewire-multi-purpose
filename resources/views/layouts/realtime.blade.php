<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live Count</title>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://www.unpkg.com/browse/tailwindcss@2.0.0/dist/tailwind.min.css">
    <!-- Animate.style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <livewire:styles />
</head>



<body>
    {{ $slot }}


    <!-- Apexcharts scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @stack('js')

    <!-- Livewire scripts -->
    <livewire:scripts />
</body>



</html>
