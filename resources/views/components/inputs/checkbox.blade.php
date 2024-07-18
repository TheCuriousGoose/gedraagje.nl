@props(['id', 'name', 'label', 'description' => null, 'value' => null, 'extra' => null, 'checked' => null])

<div class="row align-items-center">
    <div class="col-sm-4 row-gap-0 d-flex flex-column ">
        <label class="fw-bold form-label w-100 mb-0 lh-sm" for="{{ $id }}">{{ __($label) }}</label>
        @if ($description)
            <small class="text-muted mt-0 lh-sm">{{ __($description) }}</small>
        @endif
    </div>
    <div class="col-sm">
        <div class="form-check d-flex justify-content-end">
            <input type="checkbox"  id="{{ $id }}" name="{{ $name }}" @checked($checked)
                class="form-check-input @error($name) is-invalid @enderror" {{ $extra }} >
        </div>
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
