@extends('layouts.app')

@section('content')
    <form action="{{ route('quotes.store') }}" class="card col-5" method="POST">
        @csrf
        <div>
            <div class="card-header">
                <div class="card-title">
                    {{ __('Create quote') }}
                </div>
            </div>
            <div class="card-body">
                <x-inputs.text id="quote" name="quote" label="Quote" extra="required" />
                <x-inputs.text id="quotee_name" name="quotee_name" label="Name of quote author" extra="required" />
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
