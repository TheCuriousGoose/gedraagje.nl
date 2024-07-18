@extends('layouts.app')

@section('breadcrumb-icon', 'fa-cog')

@section('content')
    <form action="{{ route('settings.store') }}" method="POST">
        @method('POST')
        @csrf
        <div class="card col-5">
            <div class="card-header">
                <div class="card-title">
                    {{ __('Edit setting') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="name" name="name" label="Name" extra="required" />
                <x-inputs.text id="type" name="type" label="Type" extra="required" />
                <x-inputs.text id="value" name="value" label="Value" extra="required" />
            </div>
            <div class="card-footer d-flex justify-content-end ">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save me-2"></i>
                    {{__('Save')}}
                </button>
            </div>
        </div>
    </form>
@endsection
