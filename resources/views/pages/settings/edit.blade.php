@extends('layouts.app')

@section('breadcrumb-icon', 'fa-cog')

@section('content')
    <form action="{{ route('settings.update', $setting) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card col-5">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Edit setting') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="name" name="name" label="Name" :value="$setting->name" extra="required" />
                <x-inputs.text id="type" name="type" label="Type" :value="$setting->type" extra="required" />
                <x-inputs.text id="value" name="value" label="Value" :value="$setting->value" extra="required" />
            </div>
            <div class="card-footer d-flex justify-content-end gap-1">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fa fa-trash me-2"></i>
                    {{__('Delete')}}
                </button>
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save me-2"></i>
                    {{__('Save')}}
                </button>
            </div>
        </div>
    </form>
    <x-modals.delete :route="route('settings.destroy', $setting)" type="setting" />
@endsection
