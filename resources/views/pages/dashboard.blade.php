@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Amount of quotes
                    </div>
                </div>
                <div class="card-body">
                    {{ $quoteCount }}
                </div>
            </div>
        </div>
        <div class=" col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Add to Gedraag je counter
                    </div>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('behave-yourself.add-one') }}">
                        Add 1 to counter
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
