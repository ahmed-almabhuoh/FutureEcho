<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="login-aside d-flex flex-column flex-row-auto">
        <!--begin::Aside Top-->
        <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
            <!--begin::Aside header-->
            <a href="#" class="login-logo text-center pt-lg-25 pb-10">
                <img src="{{ asset('version-1/assets/media/logos/logo-1.png') }}" class="max-h-70px" alt="" />
            </a>
            <!--end::Aside header-->
            <!--begin::Aside Title-->
            <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">User Experience
                &amp; Interface Design
                <br />Strategy SaaS Solutions
            </h3>
            <!--end::Aside Title-->
        </div>
        <!--end::Aside Top-->
        <!--begin::Aside Bottom-->
        <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
            style="background-position-y: calc(100% + 5rem); background-image: url({{ asset('version-1/assets/media/svg/illustrations/login-visual-5.svg') }})">
        </div>
        <!--end::Aside Bottom-->
    </div>
    <!--begin::Aside-->
    <!--begin::Content-->
    <div class="login-content flex-row-fluid d-flex flex-column p-10">
        <!--begin::Top-->
        <div class="text-right d-flex justify-content-center">
            <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                <span class="font-weight-bold text-muted font-size-h4"> {{ __('Having issues?') }} </span>
                <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2" id="kt_login_signup">
                    {{ __('Get Help') }}
                </a>
            </div>
        </div>
        <!--end::Top-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-row-fluid flex-center">
            <!--begin::Signin-->
            <div class="login-form">
                <!--begin::Form-->
                <x-alert />

                <form class="form" id="kt_login_singin_form">
                    <!--begin::Title-->
                    <div class="pb-5 pb-lg-15">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('Sign In') }} </h3>
                        <div class="text-muted font-weight-bold font-size-h4"> {{ __('New Here?') }}
                            <a href="{{ route('v1.signup') }}"
                                class="text-primary font-weight-bolder">{{ __('Create Account') }}</a>
                        </div>
                    </div>


                    <!--begin::Form group-->
                    <x-auth-input name="email" type="email" label="Email" :enable-link="true" :link-text="'Forget Email?'"
                        :link-route="route('forget.email')" />
                    <!--end::Form group-->

                    <x-auth-input name="password" label="Password" type="password" :enable-link="true" :link-text="'Forget Password?'"
                        :link-route="route('forget.password')" />

                    <div class="pb-lg-0 pb-5">
                        <button type="button" wire:click="login" id="kt_login_singin_form_submit_button"
                            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                            {{ __('Sign In') }}
                        </button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</div>
