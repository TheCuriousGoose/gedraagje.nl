@extends('layouts.app')

@section('content')
    <form action="{{ route('roles.store') }}" method="POST" class="row">
        @csrf
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create role') }}
                    </div>
                </div>
                <div class="card-body">
                    <x-inputs.text id="name" name="name" label="Name" :value="old('name')" extra="required" />
                    <x-inputs.select id="guard_name" name="guard_name" label="Guard name" :options="$guards" extra="required" />
                </div>
                <div class="card-footer d-flex justify-content-end gap-1">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-2"></i>
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Role Permissions') }}
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($permissions as $groupName => $permissions)
                        <div class="permission-group">
                            @unless ($loop->first)
                                <hr>
                            @endunless
                            <div class="fw-bold fs-5 d-inline-flex justify-content-between w-100">
                                {{ __(ucwords($groupName)) }}
                                <div class="ms-auto fs-6">
                                    <input type="checkbox" class="form-check-input" data-bs-toggle="tooltip"
                                        title="{{ __('Select all in :groupName', ['groupName' => $groupName]) }}"
                                        onclick="selectAllCheckboxes(this)">
                                </div>
                            </div>
                            <div class="fw-normal" id="{{ $groupName }}">
                                @foreach ($permissions as $permission)
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 row-gap-0 d-flex flex-column ">
                                            <label class="form-label w-100 mb-0 lh-sm"
                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-check d-flex justify-content-end">
                                                <input type="checkbox" id="{{ $permission->name }}"
                                                    value="{{ $permission->name }}" name="permissions[]"
                                                    class="form-check-input @error('permissions[]') is-invalid @enderror">
                                            </div>
                                            @error('permissions[]')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function selectAllCheckboxes(checkbox) {
            checkbox.closest('.permission-group').querySelectorAll('input[type="checkbox"]').forEach(
                input => {
                    input.checked = checkbox.checked;
                });
        }
    </script>
@endpush
