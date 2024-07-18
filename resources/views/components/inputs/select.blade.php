@props(['id', 'name', 'label', 'options' => [], 'selected' => null, 'extra' => null, 'placeholder' => null])

<div class="row align-items-center mb-3">
    <div class="col-sm-4">
        <label class="fw-bold form-label w-100 mb-1" for="{{ $name }}">{{ __($label) }}</label>
    </div>
    <div class="col-sm">
        <select id="{{ $id }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror" {{ $extra }}>
            <option value="" disabled selected>{{ __($placeholder ?? 'Select an option') }}</option>
            @foreach($options as $value => $optionLabel)
                <option value="{{ $value }}" @if($selected == $value) selected @endif>{{ __($optionLabel) }}</option>
            @endforeach
        </select>
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
