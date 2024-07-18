@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('Permissions') }}
            </div>
            @can('permissions.create')
                <div class="ms-auto">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>
                        {{__('Create')}}
                    </a>
                </div>
            @endcan
        </div>
        <div class="table-body">
            <x-ajax-table id="permissionsTable" :ajaxRoute="route('permissions.ajax-search')" :ajaxTable="$permissionsTable" />
        </div>
    </div>
@endsection
