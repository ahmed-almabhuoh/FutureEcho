<form class="form" id="kt_login_forgot_form">
    <!--begin::Title-->
    <div class="pb-5 pb-lg-15">
        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('Well done!') }} </h3>
        <p class="text-muted font-weight-bold font-size-h4"> {{ __('Enter your new password') }} </p>
    </div>
    <!--end::Title-->
    <!--begin::Form group-->
    <div class="form-group">
        <input
            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('password')
            is-invalid
        @enderror"
            type="password" placeholder="Enter new password" name="password"
            wire:model="password" autocomplete="off" />
        @error('password')
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <input
            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('password_confirmation')
            is-invalid
        @enderror"
            type="password" placeholder="Enter password confirmation" name="password_confirmation"
            wire:model="password_confirmation" autocomplete="off" />
        @error('password_confirmation')
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>
    <!--end::Form group-->
    <!--begin::Form group-->
    <div class="form-group d-flex flex-wrap">
        <button type="button" wire:click="resetPassword" id="kt_login_forgot_form_submit_button"
            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"> {{ __('Reset Password') }} </button>
    </div>
    <!--end::Form group-->
</form>
