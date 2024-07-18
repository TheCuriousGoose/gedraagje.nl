@extends('layouts.web.app')

@section('content')
    <nav class="navbar">
        <div class="container">
            <a href="/" class="navbar-brand">
                {{ config('app.name') }}
            </a>
            <p>Gedraag je counter: {{ $behaveYourSelfCount }}</p>
        </div>
    </nav>
    <div class="mt-5 pt-5 d-flex flex-column justify-content-center align-items-center">
        <h1>De geweldige quotes van Cas!</h1>

        <div class="bg-dark border border-dark-subtle mt-5 rounded-3 p-3">
            <blockquote class="fs-4">
                {{ $quote->quote }}
                <footer>- {{ ucwords($quote->quotee_name) }}</footer>
            </blockquote>
        </div>

    </div>
@endsection
