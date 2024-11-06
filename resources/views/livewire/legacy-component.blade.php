<div class="col-md-10 content">

    <div class="card" style="text-align: left;">

        <div class="row">
            <div class="container my-5">

                <h3 class="my-2">{{ __('Add legacy to your account') }}</h3>


                @if (session()->has('message'))
                    <div
                        class="alert @if (session()->has('status')) @if (session('status') == 500)
                    alert-danger
                    @else
                    alert-success @endif
                @endif ">
                        {{ session('message') }}
                    </div>
                @endif


                <form wire:submit.prevent="addLegacy"
                    wire:confirm="Are you sure you need to add this legacy to your account?">

                    <div class="mb-3">
                        <label for="email" class="form-label"> {{ __('Legacy\'s Email') }} </label>
                        <input type="email"
                            class="form-control @error('email')
                        is-invalid
                    @enderror"
                            placeholder="{{ __('Enter the legacy\'s emal address') }}" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror
                    </div>

                    <!-- File upload input -->
                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('Invitation Status') }}</label>
                        <select name="status" id="status" disabled
                            class="form-control @error('status')
                            is-invalid
                        @enderror">
                            <option value="0" disabled>{{ __('-- Select an Choice --') }}</option>
                            @foreach ($statusArray as $statusIndex)
                                <option value="{{ $statusIndex }}" @if ($statusIndex == 'pending') selected @endif
                                    disabled>
                                    {{ ucfirst(__($statusIndex)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror

                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">{{ __('Add Legacy') }}</button>
                    <button type="button" class="btn btn-secondary" wire:click="cancel">{{ __('Cancel') }}</button>
                </form>
            </div>
        </div>

    </div>




    <div class="card my-2">
        <div class="row" style="text-align: left;">
            <div class="container my-5">
                <h3>
                    {{ __('Account Legacy') }}
                </h3>

                <small>
                    {{ __('Your account legacy') }}
                </small>

                Table will be here

            </div>
        </div>
    </div>

</div>
