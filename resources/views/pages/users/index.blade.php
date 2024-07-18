@extends('layouts.app')

@section('breadcrumb-icon', 'fa-users')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title justify-content-between">
                {{ __('Users') }}
            </div>

            @can('users.create')
                <div class="ms-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>
                        {{ __('Create') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="table-body">
            <x-ajax-table id="usersTable" :ajaxRoute="route('users.ajax-search')" :ajaxTable="$userTable" />
        </div>
    </div>
@endsection
