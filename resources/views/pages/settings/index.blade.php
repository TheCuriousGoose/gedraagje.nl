@extends('layouts.app')

@section('breadcrumb-icon', 'fa-cog')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('Settings') }}
            </div>
            <div class="ms-auto">
                <a class="btn btn-primary" href="{{ route('settings.create') }}">
                    <i class="fa fa-plus me-2"></i>
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="table-body">
            <x-ajax-table id="settingsTable" :ajaxRoute="route('settings.ajax-search')" :ajaxTable="$settingsTable" />
        </div>
    </div>
@endsection
