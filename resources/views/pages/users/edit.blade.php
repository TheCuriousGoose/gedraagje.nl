@extends('layouts.app')

@section('breadcrumb-icon', 'fa-user')

@section('content')
    <div class="row">
        <form action="{{ route('users.update', $user) }}" method="POST" class="col-6">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit user') }}
                    </div>
                </div>
                <div class="card-body">
                    <x-inputs.text id="name" name="name" label="Name" :value="$user->name" extra="required" />
                    <x-inputs.text id="email" name="email" label="Email" :value="$user->email" extra="required"
                        placeholder="" />
                    <x-inputs.select id="role" name="role" label="Role" :options="$roles" :selected="$user->roles->first()?->id"
                        extra="required" placeholder="Select a role" />
                    <x-inputs.select id="locale" name="locale" label="Language" :options="array_flip(config('app.available_locales'))" :selected="$user->locale"
                        placeholder="Select user language" extra="required" />
                    <x-inputs.checkbox id="active" name="active" label="User active" :checked="$user->active"
                        description="Enable or disable this account" />
                </div>
                <div class="card-footer d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fa fa-trash me-2"></i>
                        {{ __('Delete') }}
                    </button>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save me-2"></i>
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
        <form action="{{ route('users.update-password', $user) }}" method="POST" class="col-4">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit password') }}
                    </div>
                </div>
                <div class="card-body">
                    <x-inputs.password id="password" name="password" label="Password" extra="required" />
                    <x-inputs.password id="password_confirmation" name="password_confirmation" label="Password confirmation" extra="required" />
                </div>
                <div class="card-footer d-flex justify-content-end ">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save me-2"></i>
                        {{__('Save')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <x-modals.delete :route="route('users.destroy', $user)" type="user" />
@endsection
