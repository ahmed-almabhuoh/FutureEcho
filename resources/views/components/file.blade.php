<div class="form-group {{ isset($classes) ? $classes : 'col-lx-12' }}">
    <label> {{ __($label) }} </label>
    @if (isset($isRequired) && $isRequired)
        <span class="text-danger">*</span>
    @endif

    <div></div>
    <div class="custom-file">
        <input type="file" @if (isset($isDisabled) && $isDisabled) disabled @endif
            class="custom-file-input
            @error($model ?? $name)
                is-invalid
            @enderror
        "
            id="{{ $name ?? $id }}" name="{{ $name }}" wire:model="{{ $model ?? $name }}">
        <label class="custom-file-label" for="{{ $id ?? $name }}">
            {{ isset($fileLabel) ? __($fileLabel) : 'Choose file' }}
        </label>

        @error($model ?? $name)
            <small style="color: red;">{{ __($message) }}</small>
        @enderror
    </div>
</div>
