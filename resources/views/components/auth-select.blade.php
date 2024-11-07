<div class="{{ isset($classes) ? $classes : 'col-xl-6' }}">
    <!--begin::Select-->
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder text-dark"> {{ __($label) }} </label>
        <select name="{{ $name }}" wire:model="{{ $model ?? $name }}" id="{{ $id ?? $name }}"
            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error($model ?? $name)
                is-invalid
            @enderror">

            <option value=""> {{ isset($defaultSelection) ? __($defaultSelection) : __('-- Select a Choice --') }}
            </option>

            @foreach ($options as $key => $value)
                <option value="{{ $key }}"> {{ __(ucfirst($value)) }} </option>
            @endforeach
        </select>

        @if (isset($description))
            <span class="form-text text-muted">{{ __($description) }}</span>
        @endif

        @error($model ?? $name)
            <small style="color: red;">{{ __($message) }}</small>
        @enderror
    </div>
    <!--end::Input-->
</div>
