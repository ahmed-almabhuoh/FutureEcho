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
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">1</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title"> {{ __('Account Settings') }} </h3>
                                <div class="wizard-desc"> {{ __('Setup Your Account Details') }} </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 1 Nav-->
                    <!--begin::Wizard Step 2 Nav-->
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">2</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title"> {{ __('Address Details') }} </h3>
                                <div class="wizard-desc"> {{ __('Setup Residence Address') }} </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 2 Nav-->
                    <!--begin::Wizard Step 3 Nav-->
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">3</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">{{ __('Make Payment') }}</h3>
                                <div class="wizard-desc">{{ __('Use Credit or Debit Cards') }}</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 3 Nav-->
                    <!--begin::Wizard Step 4 Nav-->
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span class="wizard-number">4</span>
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
                        <!--begin::Title-->

                        <!--begin::Form Group-->
                        <x-auth-input label="First Name" name="fname" :activate-old="true" />
                        <!--end::Form Group-->

                        <!--begin::Form Group-->
                        <x-auth-input label="Last Name" name="lname" :activate-old="true" />
                        <!--end::Form Group-->

                        <!--begin::Form Group-->
                        <x-auth-input label="Phone" name="phone" placeholder="+61412345678" :activate-old="true" />
                        <!--end::Form Group-->

                        <x-auth-input label="Email" name="email" type="email" :activate-old="true" />

                    </div>
                    <!--end: Wizard Step 1-->
                    <!--begin: Wizard Step 2-->
                    <div class="pb-5" data-wizard-type="step-content">
                        <!--begin::Title-->
                        <div class="pt-lg-0 pt-5 pb-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                {{ __('Address Details') }} </h3>
                            <div class="text-muted font-weight-bold font-size-h4">
                                {{ __('Have a Different Address ?') }}
                                <a href="#" class="text-primary font-weight-bolder"> {{ __('Add Address') }} </a>
                            </div>
                        </div>
                        <!--begin::Title-->

                        <!--begin::Row-->
                        <div class="row">

                            <x-auth-input label="Address Line 1" name="address1" classes="col-xl-6" />

                            <x-auth-input label="Address Line 2" name="address2" classes="col-xl-6" />

                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row">

                            <x-auth-input label="Postcode" name="postcode" classes="col-xl-6" :activate-old="true" />

                            <x-auth-input label="City" name="city" classes="col-xl-6" :activate-old="true" />

                        </div>
                        <!--end::Row-->

                        <!--begin::Row-->
                        <div class="row">

                            <x-auth-input label="State" name="state" classes="col-xl-6" :activate-old="true"
                                description="Please enter your State." />

                            <x-auth-select label="Country" name="country" classes="col-xl-6" :options="['palestine' => 'Palestine']"
                                :default-selection="'-- Select your country --'" />

                        </div>
                        <!--end::Row-->
                    </div>

                    <!--end: Wizard Step 2-->

                    <!--begin: Wizard Step 3-->
                    <div class="pb-5" data-wizard-type="step-content">

                        <div class="pt-lg-0 pt-5 pb-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                {{ __('Support Channels') }} </h3>
                            <div class="text-muted font-weight-bold font-size-h4">
                                {{ __('Specify Your Support Channels') }}
                            </div>
                        </div>

                        <x-auth-select label="Country" name="delivery" classes="col-xl-12" :options="['palestine' => 'Palestine']"
                            :default-selection="'-- Select your country --'" />

                        <x-auth-select label="Country" name="packaging" classes="col-xl-12" :options="['palestine' => 'Palestine']"
                            :default-selection="'-- Select your country --'" />


                        <x-auth-select label="Country" name="preferreddelivery" classes="col-xl-12"
                            :options="['palestine' => 'Palestine']" :default-selection="'-- Select your country --'" />

                        <!--end::Form Group-->
                    </div>
                    <!--end: Wizard Step 3-->
                    <!--begin: Wizard Step 4-->
                    <div class="pb-5" data-wizard-type="step-content">
                        <!--begin::Title-->
                        <div class="pt-lg-0 pt-5 pb-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Complete</h3>
                            <div class="text-muted font-weight-bold font-size-h4">Complete Your Signup And
                                Become A Member!</div>
                        </div>
                        <!--end::Title-->
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Accoun Settings:</h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>Nick Stone</div>
                            <div>+12233434-34</div>
                            <div>nick.stone@gmail.com</div>
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Address Details:</h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>Address Line 1</div>
                            <div>Address Line 2</div>
                            <div>Melbourne 3000, VIC, Australia</div>
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Support Channels:</h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>Overnight Delivery with Regular Packaging</div>
                            <div>Preferred Morning (8:00AM - 11:00AM) Delivery</div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end: Wizard Step 4-->
                    <!--begin: Wizard Actions-->
                    <div class="d-flex justify-content-between pt-3">
                        <div class="mr-2">
                            <button type="button"
                                class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3"
                                data-wizard-type="action-prev">
                                <span class="svg-icon svg-icon-md mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                </span>Previous</button>
                        </div>
                        <div>
                            <button class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3"
                                data-wizard-type="action-submit" type="submit"
                                id="kt_login_signup_form_submit_button">Submit
                                <span class="svg-icon svg-icon-md ml-2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                </span></button>
                            <button type="button"
                                class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3"
                                data-wizard-type="action-next">Next Step
                                <span class="svg-icon svg-icon-md ml-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                </span></button>
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
