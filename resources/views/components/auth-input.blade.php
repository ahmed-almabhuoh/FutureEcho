@if (isset($classes))
    <div class="{{ $classes }}">
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark"> {{ __($label) }} </label>
            <input type="{{ $type ?? 'text' }}"
                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error($model ?? $name)
                is-invalid
            @enderror"
                name="{{ $name }}" wire:model={{ $model ?? $name }} id="{{ $id ?? $name }}"
                placeholder="{{ isset($placeholder) ? __($placeholder) : __('Enter the ') . __($name) }}"
                @if (isset($activateOld) && $activateOld) value="{{ old($name) }}"
                @else
                value="{{ isset($value) ? $value : null }}" @endif />

            @if (isset($enableLink) && $enableLink)
                <a href="{{ $linkRoute }}"
                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"> {{ __($linkText) }}
                </a>
            @endif

            @if (isset($description))
                <span class="form-text text-muted">{{ __($description) }}</span>
            @endif

            @error($model ?? $name)
                <small style="color: red;">{{ __($message) }}</small>
            @enderror
        </div>
    </div>
@else
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder text-dark"> {{ __($label) }} </label>
        <input type="{{ $type ?? 'text' }}"
            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error($model ?? $name)
        is-invalid
    @enderror"
            name="{{ $name }}" wire:model={{ $model ?? $name }} id="{{ $id ?? $name }}"
            placeholder="{{ isset($placeholder) ? __($placeholder) : __('Enter the ') . __($name) }}"
            @if (isset($activateOld) && $activateOld) value="{{ old($name) }}"
                @else
                value="{{ isset($value) ? $value : null }}" @endif />


        @if (isset($enableLink) && $enableLink)
            <a href="{{ $linkRoute }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                {{ __($linkText) }}
            </a>
        @endif

        @if (isset($description))
            <span class="form-text text-muted">{{ __($description) }}</span>
        @endif

        @error($model ?? $name)
            <small style="color: red;">{{ __($message) }}</small>
        @enderror

    </div>
@endif
