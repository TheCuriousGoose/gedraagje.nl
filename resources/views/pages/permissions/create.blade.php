@extends('layouts.app')

@section('content')
    <form action="{{ route('permissions.store') }}" class="card col-5" method="POST">
        @csrf
        <div>
            <div class="card-header">
                <div class="card-title">
                    {{ __('Edit permission') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="name" name="name" label="Name" extra="required" />
                <x-inputs.select id="guard_name" name="guard_name" label="Guard name" :options="$guards" extra="required" />
            </div>
            <div class="card-footer d-flex justify-content-end gap-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i>
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
@endsection
