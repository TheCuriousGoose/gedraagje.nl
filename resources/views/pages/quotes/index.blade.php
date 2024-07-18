@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('Quotes') }}
            </div>
            @can('quotes.create')
                <div class="ms-auto">
                    <a href="{{ route('quotes.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>
                        {{__('Create')}}
                    </a>
                </div>
            @endcan
        </div>
        <div class="table-body">
            <x-ajax-table id="quotesTable" :ajaxRoute="route('quotes.ajax-search')" :ajaxTable="$quotesTable" />
        </div>
    </div>
@endsection
