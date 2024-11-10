<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Capsule & CM" category="Capsules" sub-category="Capsuels" page="Capsule List" :category-link="route('capsules.index')"
                :sub-category-link="route('capsules.index')" :page-link="route('capsules.index')" />


            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{ __('Capsules') }}
                            <span class="d-block text-muted pt-2 font-size-sm">
                                {{ __('Make a huge memory storage with contributing on your capsules!') }}
                            </span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('capsules.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            {{ __('New Capsule') }}
                        </a>
                        <!--end::Button-->
                    </div>
                </div>


                <div class="card-body">
                    <x-alert />
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th> {{ __('Title') }} </th>
                                <th> {{ __('Created At') }} </th>
                                <th> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($capsules as $capsule)
                                <tr>
                                    <td>{{ $capsule->title }}</td>
                                    <td> {{ Carbon\Carbon::parse($capsule->created_at)->diffForHumans() }} </td>
                                    <td nowrap="nowrap">

                                        <button type="button"
                                            wire:click="setToBeDeleted('{{ Crypt::encrypt($capsule->id) }}')"
                                            data-toggle="modal" data-target="#exampleModalCenter"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                            fill="#000000" fill-rule="nonzero"></path>
                                                        <path
                                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <x-modal title="Delete Capsule" description="Are you sure you need to delete your legacy?!"
                        submit-action="delete" submit-text="Delete" />

                    <!--end: Datatable-->
                </div>
            </div>
        </div>
    </div>
</div>
