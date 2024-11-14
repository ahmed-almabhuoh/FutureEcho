<div class="form-group {{ isset($classes) ? $classes : '' }}">
    <label>{{ __($label) }}
        @if (isset($isRequired) && $isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type ?? 'name' }}" name="{{ $name }}" id="{{ $id ?? $name }}"
        @if (isset($isLive) && $isLive) wire:model.live="{{ $model ?? $name }}"
    @else
    wire:model="{{ $model ?? $name }}" @endif
        class="form-control @error($model ?? $name)
            is-invalid
        @enderror"
        placeholder="{{ isset($placeholder) ? __($placeholder) : __('Enter the ') . $name }}" />

    @error($model ?? $name)
        <small style="color: red;">{{ __($message) }}</small>
    @enderror

    @if (isset($description))
        <span class="form-text text-muted"> {!! __($description) !!} </span>
    @endif
</div>
