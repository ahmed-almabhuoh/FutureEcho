<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
    <!--begin::Aside-->
    <div class="login-aside d-flex flex-column flex-row-auto">
        <!--begin::Aside Top-->
        <div class="d-flex flex-column-auto flex-column pt-15 px-30">
            <!--begin::Aside header-->
            <a href="#" class="login-logo py-6">
                <img src="{{ asset('version-1/assets/media/logos/logo-1.png') }}" class="max-h-70px" alt="" />
            </a>
            <!--end::Aside header-->
            <!--begin: Wizard Nav-->
            <div class="wizard-nav pt-5 pt-lg-30">
                <!--begin::Wizard Steps-->
                <div class="wizard-steps">

                    <!--begin::Wizard Step 1 Nav-->
                    <div class="wizard-step" data-wizard-type="step"
                        @if ($personalInfo) data-wizard-state="current" @endif>
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">1</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title"> {{ __('Personal Info') }} </h3>
                                <div class="wizard-desc"> {{ __('Add your information to your account!') }} </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 1 Nav-->

                    <!--begin::Wizard Step 2 Nav-->
                    <div class="wizard-step" @if ($accountSettings) data-wizard-state="current" @endif>
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">2</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title"> {{ __('Account Settings') }} </h3>
                                <div class="wizard-desc"> {{ __('Establish your account configs') }} </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 2 Nav-->

                    <!--begin::Wizard Step 4 Nav-->
                    <div class="wizard-step" @if ($personalInfo == false && $accountSettings == false) data-wizard-state="current" @endif>
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">3</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title"> {{ __('Completed!') }} </h3>
                                <div class="wizard-desc"> {{ __('Review and Submit') }} </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 4 Nav-->

                </div>
                <!--end::Wizard Steps-->
            </div>
            <!--end: Wizard Nav-->
        </div>
        <!--end::Aside Top-->
        <!--begin::Aside Bottom-->
        <div class="aside-img-wizard d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center pt-2 pt-lg-5"
            style="background-position-y: calc(100% + 3rem); background-image: url({{ asset('version-1/assets/media/svg/illustrations/features.svg') }})">
        </div>
        <!--end::Aside Bottom-->
    </div>
    <!--begin::Aside-->
    <!--begin::Content-->
    <div class="login-content flex-column-fluid d-flex flex-column p-10">
        <!--begin::Top-->
        <div class="text-right d-flex justify-content-center">
            <div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                <span class="font-weight-bold text-muted font-size-h4"> {{ __('Having issues?') }} </span>
                <a href="javascript:;" class="font-weight-bolder text-primary font-size-h4 ml-2" id="kt_login_signup">
                    {{ __('Get Help') }} </a>
            </div>
        </div>
        <!--end::Top-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-row-fluid flex-center">
            <!--begin::Signin-->
            <div class="login-form login-form-signup">
                <!--begin::Form-->
                <form class="form" method="POST" action="{{ route('v1.registration') }}" novalidate="novalidate"
                    id="kt_login_signup_form">
                    @csrf
                    <!--begin: Wizard Step 1-->
                    @if ($personalInfo)
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Title-->
                            <div class="pb-10 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark display5"> {{ __('Create Account') }} </h3>
                                <div class="text-muted font-weight-bold font-size-h4">
                                    {{ __('Already have an Account ?') }}
                                    <a href="{{ route('login') }}" class="text-primary font-weight-bolder">
                                        {{ __('Sign In') }} </a>
                                </div>
                            </div>

                            <x-auth-input label="Full Name" name="name" :activate-old="true" />

                            <x-auth-input label="Phone" name="phone" placeholder="+61412345678" :activate-old="true" />

                            <x-auth-input label="Email" name="email" type="email" :activate-old="true" />

                        </div>
                    @endif
                    <!--end: Wizard Step 1-->

                    <!--begin: Wizard Step 2-->
                    @if ($accountSettings)
                        <div class="pb-5">
                            <!--begin::Title-->
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                    {{ __('Account Settings') }} </h3>
                                <div class="text-muted font-weight-bold font-size-h4">
                                    {{ __('Establish your accuont configs?') }}
                                    {{-- <a href="#" class="text-primary font-weight-bolder"> {{ __('Add Address') }}
                                    </a> --}}
                                </div>
                            </div>
                            <!--begin::Title-->

                            <!--begin::Row-->
                            <div class="row">
                                <x-auth-select label="Timezone" name="timezone" classes="col-xl-12" :options="config('timezones')"
                                    :default-selection="'-- Select your timezone --'" />
                            </div>
                        </div>
                    @endif

                    <!--begin: Wizard Step 4-->
                    @if ($personalInfo == false && $accountSettings == false)
                        <div class="pb-5">
                            <div class="pt-lg-0 pt-5 pb-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                    {{ __('Complete Registration') }}</h3>
                                <div class="text-muted font-weight-bold font-size-h4">
                                    {{ __('Complete Your Signup And Become A Member!') }} </div>
                            </div>

                            <h4 class="font-weight-bolder mb-3"> {{ __('Personal Ifno') }} </h4>
                            <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                                <div>{{ $name }}</div>
                                <div> {{ $phone }} </div>
                                <div> {{ $email }} </div>
                            </div>

                            <h4 class="font-weight-bolder mb-3">{{ __('Account Settings') }}</h4>
                            <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                                <div>{{ __('Timezone:') . ' ' . $timezone }} </div>
                            </div>

                        </div>
                    @endif
                    <!--end: Wizard Step 4-->

                    <!--begin: Wizard Actions-->
                    <div class="d-flex justify-content-between pt-3">
                        @if ($accountSettings)
                            <div class="mr-2">
                                <button type="button" wire:click="previous"
                                    class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3">
                                    <span class="svg-icon svg-icon-md mr-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)"
                                                    x="14" y="7" width="2" height="10" rx="1" />
                                                <path
                                                    d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>{{ __('Previous') }}
                                </button>
                            </div>
                        @endif

                        <div>
                            @if ($accountSettings == false && $personalInfo == false)
                                <button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3"
                                    type="button" wire:click="reg">
                                    {{ __('Submit') }}
                                    <span class="svg-icon svg-icon-md ml-2">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                    x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                            @endif

                            @if ($personalInfo == true || $accountSettings == true)
                                <button type="button" wire:click="nextStep"
                                    class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3">
                                    {{ __('Next Step') }}
                                    <span class="svg-icon svg-icon-md ml-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                    x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                            @endif

                        </div>
                    </div>
                    <!--end: Wizard Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</div>
