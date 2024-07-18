@extends('layouts.app')

@section('content')
    <form action="{{ route('permissions.update', $permission) }}" class="card col-5" method="POST">
        @method('PUT')
        @csrf
        <div>
            <div class="card-header">
                <div class="card-title">
                    {{ __('Edit permission') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="name" name="name" label="Name" :value="$permission->name" extra="required" />
                <x-inputs.select id="guard" name="guard_name" label="Guard name" :options="$guards" :selected="$permission->guard_name"
                    extra="required" />
            </div>
            <div class="card-footer d-flex justify-content-end gap-1">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fa fa-trash me-2"></i>
                    {{ __('Delete') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i>
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
    <x-modals.delete :route="route('permissions.destroy', $permission)" type="permission" />
@endsection
