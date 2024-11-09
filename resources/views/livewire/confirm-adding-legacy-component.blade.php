<div>
    <form class="form" id="kt_login_forgot_form" style="margin-bottom: -30px;">
        <x-alert />
        <!--begin::Title-->
        <div class="pb-5 pb-lg-15">
            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('2-Step Veriification!') }}
            </h3>
            <p class="text-muted font-weight-bold font-size-h4">
                {{ __('2FA code is required, as additional security layer.') }} </p>
        </div>
        <!--end::Title-->
        <!--begin::Form group-->
        <div class="form-group">
            <input
                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('twoFA')
                is-invalid
            @enderror"
                type="number" placeholder="Enter the 2FA code here" name="twoFA" wire:model="twoFA"
                autocomplete="off" />
            @error('twoFA')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>
        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group d-flex flex-wrap">
            <button type="button" wire:click="confirm" id="kt_login_forgot_form_submit_button"
                class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"> {{ __('Confirm') }}
            </button>
            <a href="#" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">
                {{ __('Cancel') }} </a>
        </div>
        <!--end::Form group-->
    </form>
</div>
