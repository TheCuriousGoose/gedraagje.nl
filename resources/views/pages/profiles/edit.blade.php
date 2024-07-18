@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-7">
            <form action="{{ route('profiles.update', $user) }}"method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{ __('Edit profile') }}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-3 border-end me-3">
                                <div class="avatar-wrapper">
                                    <img src="{{ $user->getOriginalImage() }}" alt="The avater display"
                                        class="rounded-circle profile-pic">
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input class="file-upload" type="file" name="avatar" accept="image/*" />
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback text-center">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <x-inputs.text id="name" name="name" :label="__('Name')" :value="$user->name"
                                    extra="required" />
                                <x-inputs.text id="email" name="email" :label="__('Email')" :value="$user->email"
                                    extra="required   " placeholder="" />
                                <x-inputs.password id="password" name="password" :label="__('Old password')" />
                                <x-inputs.password id="new_password" name="new_password" :label="__('New password')" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        document.querySelector('.profile-pic').setAttribute('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.querySelectorAll(".file-upload").forEach(function(input) {
                input.addEventListener('change', function() {
                    readURL(this);
                });
            });

            document.querySelectorAll(".upload-button").forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentNode.querySelector(".file-upload").click();
                });
            });

        })
    </script>
@endpush
