<div class="form-group">
    <label for="{{ $id ?? $name }}">
        {{ __($label) }}

        @if (isset($isRequired) && $isRequired)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select @if (isset($isMulti) && $isMulti) multiple="multiple" @endif
        class="form-control @if (isset($isRequired) && $isRequired) @error(isset($model) ? (!is_null($model) ? $model . '.*' : $name . '.*') : $name . '.*')
            is-invalid
        @enderror
    @else
        @error($model ?? $name)
            is-invalid
        @enderror @endif"
        id="{{ $id ?? $name }}" wire:model="{{ $model ?? $name }}" name="{{ $name }}">

        @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ __($value) }}</option>
        @endforeach

    </select>

    @if (isset($isRequired) && $isRequired)
        @error(isset($model) ? (!is_null($model) ? $model . '.*' : $name . '.*') : $name . '.*')
            <small style="color: red;"> {{ __($message) }} </small>
        @enderror
    @else
        @error($model ?? $name)
            <small style="color: red;"> {{ __($message) }} </small>
        @enderror
    @endif


</div>
