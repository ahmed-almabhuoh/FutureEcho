<div class="col-md-10 content">

    <div class="card my-2 p-2" style="text-align: left;">

        <h3 class="my-2">{{ __('Contributors') }}</h3>

        <div class="row">
            <div class="container my-2">

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

                <form wire:submit.prevent="addContributor"
                    wire:confirm="{{ __('Are you sure you need to add this contribotur to your capsule?') }}">

                    <div class="mb-3">
                        <label for="capsule" class="form-label"> {{ __('Capsule') }} </label>
                        <input type="text" readonly value="{{ $capsule->title }}"
                            class="form-control @error('title')
                        is-invalid
                    @enderror"
                            placeholder="{{ __('Enter the legacy\'s emal address') }}" wire:model="title">
                        @error('title')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"> {{ __('Contributor Email') }} </label>
                        <input type="email"
                            class="form-control @error('email')
                        is-invalid
                    @enderror"
                            placeholder="{{ __('Enter the contributor email') }}" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="permission" class="form-label">{{ __('Permission') }}</label>
                        <select name="permission" id="permission" wire:model="permission"
                            class="form-control @error('permission')
                            is-invalid
                        @enderror">
                            <option value="0" disabled>{{ __('-- Select a permission --') }}</option>

                            @foreach (App\Models\Contributor::Permissions as $contributorPermission)
                                <option value="{{ $contributorPermission }}">
                                    {{ $contributorPermission == 'r' ? __('Read') : __('Write') }}</option>
                            @endforeach

                        </select>
                        @error('permission')
                            <span class="text-danger">{{ __($message) }}</span>
                        @enderror

                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">{{ __('Add Contributor') }}</button>
                    <button type="button" class="btn btn-secondary" wire:click="cancel">{{ __('Cancel') }}</button>
                </form>
            </div>
        </div>

    </div>

</div>
