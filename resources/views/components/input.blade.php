<div class="form-group {{ isset($classes) ? $classes : '' }}">
    <label>{{ __($label) }}
        @if (isset($isRequired) && $isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type ?? 'name' }}" name="{{ $name }}" id="{{ $id ?? $name }}"
        wire:model="{{ $model ?? $name }}"
        class="form-control @error($model ?? $name)
            is-invalid
        @enderror"
        placeholder="{{ isset($placeholder) ? __($placeholder) : __('Enter the ') . $name }}" />

    @error($model ?? $name)
        <small style="color: red;">{{ __($message) }}</small>
    @enderror

    @if (isset($description))
        <span class="form-text text-muted"> {{ __($description) }} </span>
    @endif
</div>
