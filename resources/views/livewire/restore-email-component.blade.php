<div class="container forgot-password-container">
    <div class="forgot-password-box">
        <h6> {{ __($headerTitle) }} </h6>
        <p> {{ __($headerDescription) }} </p>

        @if ($isValidPassword)
            <button type="button" wire:click="cancel" class="btn btn-search"> {{ __('Back to login') }} </button>
        @endif

        @if (!$isValidPassword)
            <form>

                @if ($isValidName)
                    <div class="mb-3">
                        <label for="password" class="form-label"> {{ __('Password') }} </label>
                        <input type="password"
                            class="form-control
                    @error('password')
                        is-invalid
                    @enderror
                "
                            id="password" placeholder="{{ __('Enter your password') }}" wire:model="password">
                        @error('password')
                            <span style="color: red;"> {{ __($message) }} </span>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="name" class="form-label"> {{ __('Name') }} </label>
                        <input type="text"
                            class="form-control
                    @error('name')
                        is-invalid
                    @enderror
                "
                            id="name" placeholder="{{ __('Enter your name') }}" wire:model="name">
                        @error('name')
                            <span style="color: red;"> {{ __($message) }} </span>
                        @enderror
                    </div>
                @endif


                <div class="d-flex justify-content-between">
                    {{-- <button type="button" wire:click="loginWithPassword" class="btn btn-cancel">
                        {{ __('Login with password?') }} </button> --}}
                    <button type="button" wire:click="cancel" class="btn btn-cancel"> {{ __('Cancel') }} </button>
                    <button type="button"
                        @if (!$isValidName) wire:click="continue" @else wire:click="checkViaPassword" @endif
                        class="btn btn-search"> {{ __('Continue') }} </button>
                </div>

            </form>
        @endif

    </div>
</div>

@push('styles')
    <style>
        body {
            background-color: #f5f7f9;
            /* Adjust to match the image background */
        }

        .forgot-password-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .forgot-password-box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }

        .forgot-password-box h6 {
            font-weight: bold;
            background-color: #d3d7dc;
            /* Light grey header background */
            padding: 10px;
            /* border-radius: 5px; */
            margin-right: -30px;
            margin-left: -30px;
            margin-top: -30px;
            margin-bottom: 20px;
        }

        .forgot-password-box .btn-cancel {
            background-color: transparent;
            border: 1px solid #002d62;
            /* Dark blue border */
            color: #002d62;
        }

        .forgot-password-box .btn-cancel:hover {
            background-color: #002d62;
            color: #ffffff;
        }

        .forgot-password-box .btn-search {
            background-color: #5a7da1;
            /* Light blue button */
            color: #ffffff;
        }

        .forgot-password-box .btn-search:hover {
            background-color: #486a8c;
            /* Darker blue on hover */
        }
    </style>
@endpush
