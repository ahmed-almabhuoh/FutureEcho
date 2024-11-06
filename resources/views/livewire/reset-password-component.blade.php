<div class="container forgot-password-container">
    <div class="forgot-password-box">
        <h6> {{ __('Reset Password') }} </h6>
        <p> {{ __('Enter your new password and password confirmation') }} </p>
        <form>

            <div class="mb-3">
                <label for="password" class="form-label"> {{ __('New Password') }} </label>
                <input type="password"
                    class="form-control
                    @error('password')
                        is-invalid
                    @enderror
                "
                    id="password" placeholder="{{ __('Enter your new password') }}" wire:model="password">
                @error('password')
                    <span style="color: red;"> {{ __($message) }} </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label"> {{ __('Password Confirmation') }} </label>
                <input type="password"
                    class="form-control
                    @error('password_confirmation')
                        is-invalid
                    @enderror
                "
                    id="password_confirmation" placeholder="{{ __('Enter password confirmation') }}" wire:model="password_confirmation">
                @error('password_confirmation')
                    <span style="color: red;"> {{ __($message) }} </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" wire:click="cancel" class="btn btn-cancel"> {{ __('Cancel') }} </button>
                <button type="button" wire:click="resetPassword" class="btn btn-search"> {{ __('Reset') }} </button>
            </div>

        </form>
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
