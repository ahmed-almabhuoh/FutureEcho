<div class="login-box">
    <div class="left-section">
        <h2>{{ __('FUTURE ECHO') }}</h2>
        <p>{{ __('Welcome') }}</p>
        <!-- You can add the logo image here -->
        <img class="logo-img" src="{{ 'http://127.0.0.1:8000' . Storage::url($websiteSettings->logo) }}"
            alt="Future Echo Logo">
    </div>
    <div class="right-section">
        <h5>{{ __('Welcome back!') }}</h5>
        <p>{{ __('Log in to access your account and continue where you left off.') }}</p>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email"
                    class="form-control
                    @error('email')
                        is-invalid
                    @enderror"
                    id="email" placeholder="{{ __('Enter your email') }}" wire:model="email">
                @error('email')
                    <small style="color: red;">{{ __($message) }}</small>
                @enderror
                <a href="#">{{ __('Cannot access to my email?') }}</a>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input type="password"
                    class="form-control @error('password')
                    is-invalid
                @enderror"
                    id="password" placeholder="{{ __('Enter your password') }}" wire:model="password">
                @error('password')
                    <small style="color: red;">{{ __($message) }}</small>
                @enderror
                <a href="{{ route('users.forget-password') }}">{{ __('Forget password?') }}</a>
            </div>

            <button type="button" wire:click="login" class="btn btn-primary w-100">{{ __('Login') }}</button>

            <p class="mt-3 text-center">
                <a href="{{ route('users.reg') }}">{{ __('I do not have an account!') }}</a>
            </p>

        </form>

    </div>
</div>

@push('styles')
    <style>
        body {
            background-color: #f5f7f9;
            /* Adjust to match the image background */
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 95%;
            display: flex;
            background-color: #f0f3f5;
            /* Light section background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .left-section {
            background-color: #4b6a8a;
            /* Matching blue */
            padding: 20px;
            color: #ffffff;
            text-align: center;
            width: 50%;
        }

        .right-section {
            padding: 30px;
            width: 50%;
            background-color: #ffffff;
        }

        .right-section a {
            color: #4b6a8a;
            text-decoration: none;
        }

        .right-section a:hover {
            text-decoration: underline;
        }

        .logo-img {
            width: 100%;
            height: 80%;
        }
    </style>
@endpush
