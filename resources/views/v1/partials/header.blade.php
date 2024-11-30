<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Aside Toggle-->
            <button class="btn btn-icon aside-toggle ml-n3 mr-10" id="kt_aside_desktop_toggle">
                <span class="svg-icon svg-icon-xxl svg-icon-dark-75">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Align-left.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" opacity="0.3" x="4" y="5" width="16" height="2"
                                rx="1" />
                            <rect fill="#000000" opacity="0.3" x="4" y="13" width="16" height="2"
                                rx="1" />
                            <path
                                d="M5,9 L13,9 C13.5522847,9 14,9.44771525 14,10 C14,10.5522847 13.5522847,11 13,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L13,17 C13.5522847,17 14,17.4477153 14,18 C14,18.5522847 13.5522847,19 13,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z"
                                fill="#000000" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Aside Toggle-->
            <!--begin::Logo-->
            <a href="index.html">
                <img alt="Logo" src="{{ Storage::url($websiteSettings->logo) }}" class="logo-sticky max-h-35px" />
            </a>
            <!--end::Logo-->
            <!--begin::Desktop Search-->
            <div class="quick-search quick-search-inline ml-20 w-300px" id="kt_quick_search_inline">
                <!--begin::Form-->
                <form method="get" class="quick-search-form">
                    <div class="input-group rounded bg-light">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </div>
                        <input type="text" class="form-control h-45px" placeholder="Search..." />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
                <!--begin::Search Toggle-->
                <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
                <!--end::Search Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up">
                    <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350"
                        data-mobile-height="200"></div>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Desktop Search-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">

            <!--begin::Create-->
            <div class="dropdown">

                <!--begin::Toggle-->
                <div class="topbar-item mr-4" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn font-weight-bolder btn-sm btn-light-success px-5">
                        <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                            @if (auth()->user()->image)
                                <img src="{{ Storage::url(auth()->user()->image) }}" style="width: 25px; height: 25px;"
                                    alt="{{ auth()->user()->name }}">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                            @endif
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-md">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">
                        <li class="navi-item">
                            <a href="{{ route('memories') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-drop"></i>
                                </span>
                                <span class="navi-text">{{ __('New Memory') }}</span>


                                @php
                                    $memories_count = App\Models\Memory::withoutGlobalScopes()
                                        ->with(['capsule', 'user'])
                                        ->where(function ($query) {
                                            $query
                                                ->where('user_id', auth()->id())
                                                ->orWhereHas('capsule', function ($subQuery) {
                                                    $subQuery->where('user_id', auth()->id());
                                                })
                                                ->orWhereHas('capsule.contributors', function ($subQuery) {
                                                    $subQuery->where('user_id', auth()->id());
                                                });
                                        })
                                        ->count();
                                @endphp

                                @if ($memories_count && $memories_count > 0)
                                    <span class="navi-link-badge">
                                        <span
                                            class="label label-light-danger label-rounded font-weight-bold">{{ $memories_count }}</span>
                                    </span>
                                @endif

                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="{{ route('contributors') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-list-3"></i>
                                </span>
                                <span class="navi-text"> {{ __('Contributors') }} </span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="{{ route('legacies.new') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-rocket-1"></i>
                                </span>
                                <span class="navi-text">{{ __('Legacy') }}</span>
                                <span class="navi-link-badge">
                                    <span
                                        class="label label-light-primary label-inline font-weight-bold">{{ __('new') }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="{{ route('capsules.create') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-bell-2"></i>
                                </span>
                                <span class="navi-text">{{ __('Groups') }}</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="{{ route('settings.general') }}" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-gear"></i>
                                </span>
                                <span class="navi-text">{{ __('Settings') }}</span>
                            </a>
                        </li>
                        <li class="navi-separator my-3"></li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-magnifier-tool"></i>
                                </span>
                                <span class="navi-text"> {{ __('Help') }} </span>
                            </a>
                        </li>
                        {{-- <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-bell-2"></i>
                                </span>
                                <span class="navi-text">Privacy</span>
                                <span class="navi-link-badge">
                                    <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                </span>
                            </a>
                        </li> --}}
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Create-->

            <!--begin::Notifications-->
            {{-- <div class="topbar-item">
                <div class="btn btn-icon btn-sm btn-primary font-weight-bolder p-0"
                    id="kt_quick_notifications_toggle">3</div>
            </div> --}}
            <!--end::Notifications-->

        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
