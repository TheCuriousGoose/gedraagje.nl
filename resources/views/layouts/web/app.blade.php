<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De Quotes van Cas</title>
    <script src="{{ asset('js/jquery.js') }}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="min-vh-100">
    @yield('content')
</body>
<footer>
    <script src="{{ asset('js/jquery.js') }}"></script>
    @stack('scripts')
</footer>

</html>
