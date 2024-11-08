<form class="form" id="kt_login_forgot_form">
    <!--begin::Title-->
    <div class="pb-5 pb-lg-15">
        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"> {{ __('Well Done!') }} </h3>
        <p class="text-muted font-weight-bold font-size-h4">
            {{ __('We catch your email: ') }} <b class="text-dark">{{ $email }}</b> {{ __(', enjoy!') }}
        </p>
    </div>

    <!--begin::Form group-->
    <div class="form-group d-flex flex-wrap">
        <a href="{{ route('login') }}" id="kt_login_forgot_cancel"
            class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3"> {{ __('Back to login!') }}
        </a>
    </div>
    <!--end::Form group-->
</form>
