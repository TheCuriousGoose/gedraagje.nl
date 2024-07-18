<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <script src="{{asset('js/jquery.js')}}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'node_modules/bootstrap-table/dist/bootstrap-table.min.css'])
</head>

<body>
    <main class="d-flex flex-nowrap" id="top">
        @include('layouts.sidebar')
        <div class="content w-100 mx-5">
            @include('layouts.topbar')

            <div class="my-3">
                <x-alerts />
            </div>

            <section class="my-3">
                @yield('content')
            </section>
        </div>
    </main>
</body>
<footer>
    <script src="{{ asset('js/jquery.js') }}"></script>
    @stack('scripts')
</footer>

</html>
