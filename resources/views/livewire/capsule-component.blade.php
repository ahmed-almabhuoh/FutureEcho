<div class="col-md-10 content">

    <div class="card   my-2 p-4" style="text-align: left;">

        <h3>{{ __('New Capsule') }}</h3>
        <small>
            {{ __('Add new capsule and share it with contributors to make a beatiful unversiries') }}
        </small>

        <div class="row">
            <div class="container my-5">

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


                <form wire:submit.prevent="addCapsule">

                    <div class="mb-3">
                        <label for="title" class="form-label"> {{ __('Capsule Title') }} </label>
                        <input type="title"
                            class="form-control @error('title')
                        is-invalid
                    @enderror"
                            placeholder="{{ __('Enter the legacy titleF') }}" wire:model="title">
                        @error('title')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">{{ __('Create Capsule') }}</button>
                    <button type="button" class="btn btn-secondary" wire:click="cancel">{{ __('Cancel') }}</button>
                </form>
            </div>
        </div>

    </div>

    <div class="card   my-2 p-4" style="text-align: left;">

        <h3>{{ __('Capsules') }}</h3>
        {{-- <small>
            {{ __('Add new capsule and share it with contributors to make a beatiful unversiries') }}
        </small> --}}

        <div class="row">
            <div class="container my-5">

                Capsules tables should be here

            </div>
        </div>

    </div>
</div>
