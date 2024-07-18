@props(['id', 'name', 'label', 'value' => null, 'extra' => null, 'placeholder' => null])

<div class="row align-items-center mb-3">
    <div class="col-sm-4">
        <label for="{{ $id }}" class="fw-bold form-label">{{ __($label) }}</label>
    </div>
    <div class="col-sm">
        <input type="password" id="{{ $id }}" name="{{ $name }}" value="{{ $value ?? '' }}"
            class="form-control" {{ $extra }} placeholder="{{ $placeholder ?? '' }}">
    </div>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
