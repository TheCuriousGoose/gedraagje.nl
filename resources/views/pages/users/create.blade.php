@extends('layouts.app')

@section('breadcrumb-icon', 'fa-user')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="card col-6">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Create User') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="name" name="name" label="Name" :value="old('name')" extra="required" />
                <x-inputs.text id="email" name="email" label="Email" :value="old('email')" extra="required"
                    placeholder="" />
                <x-inputs.select id="role" name="role" label="Role" :options="$roles" :selected="old('role')"
                    extra="required" placeholder="Select a role" />
                <x-inputs.select id="locale" name="locale" label="Language" :options="array_flip(config('app.available_locales'))" :selected="old('locale')"
                    placeholder="Select user language" extra="required" />
                <x-inputs.password id="password" name="password" label="Password" extra="required" />
                <x-inputs.password id="password_confirmation" name="password_confirmation" label="Confirm Password"
                    extra="required" />
                <x-inputs.checkbox id="active" name="active" label="User active" :checked="old('active', true)"
                    description="Enable or disable this account" />
            </div>
            <div class="card-footer d-flex justify-content-end gap-1">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save me-2"></i>
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
@endsection
