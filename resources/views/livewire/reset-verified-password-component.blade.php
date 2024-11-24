<form class="form" id="kt_login_forgot_form">
    <!--begin::Title-->
    <div class="pb-5 pb-lg-15">
        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('Forgotten Credentials?') }} </h3>
        <p class="text-muted font-weight-bold font-size-h4">
            {{ __('Upload your identity to restore your credentials.') }} </p>
    </div>
    <!--end::Title-->
    <!--begin::Form group-->

    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input
            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('name')
            is-invalid
        @enderror"
            type="text" placeholder="{{ __('Enter your name as it\'s typed in your identity') }}" name="name"
            wire:model="name" autocomplete="off" />
        @error('name')
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label> {{ __('Upload Identity') }} </label>
        <div></div>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('identity')
            is-invalid
        @enderror"
                id="identity" name="identity" wire:model="identity">
            <label class="custom-file-label" for="identity"> {{ __('Choose file') }} </label>
        </div>
        @error('identity')
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>

    <!--end::Form group-->
    <!--begin::Form group-->
    <div class="form-group d-flex flex-wrap">
        <button type="button" wire:click="submit" id="kt_login_forgot_form_submit_button"
            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"> {{ __('Submit') }} </button>
        <a href="{{ route('login') }}" id="kt_login_forgot_cancel"
            class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3"> {{ __('Back to Login?') }}
        </a>
    </div>
    <!--end::Form group-->
</form>
