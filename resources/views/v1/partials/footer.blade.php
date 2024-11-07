<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">{{ now()->year }}©</span>
            <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">
                {{ __(env('APP_NAME')) }} </a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark order-1 order-md-2">
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pr-3 pl-0">{{ __('About') }}</a>
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link px-3">{{ __('Team') }}</a>
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-3 pr-0">{{ __('Contact') }}</a>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
