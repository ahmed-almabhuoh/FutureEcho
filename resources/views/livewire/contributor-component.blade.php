<div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">

                <x-index index="Management Access" category="Contributors" sub-category="Contributors"
                    page="Show Contributors" :category-link="route('contributors')" :sub-category-link="route('contributors')" :page-link="route('contributors')" />

                {{-- <x-notice description="Be careful, you cannot delete accepted legacy!" /> --}}

                <x-form title="New Contributor" submit-action="newContributor" cancel-action="cancel" :classes="'col-xl-12'">

                    <x-alert />

                    <div class="row" style="margin: 0 5px;">
                        <x-input name="email" label="Contributor Email" :is-required="true" classes="col-xl-6"
                            placeholder="Enter the contributor email" />

                        <x-select label="Permission" classes="col-xl-6" :is-required="true" name="permission"
                            :options="$permissions" />
                    </div>

                    <x-select label="Capsules" :is-required="true" name="capsule_ids" :options="$capsules"
                        :is-multi="true" />

                </x-form>

            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">

                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">
                                {{ __('Contributors') }}
                                <span class="d-block text-muted pt-2 font-size-sm">
                                    {{ __('Contributors can access to your capsules and its content!') }}
                                </span>
                            </h3>
                        </div>
                    </div>


                    <div class="card-body">

                        <!--begin: Datatable-->
                        <table class="table table-bordered table-checkable" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th> {{ __('Image') }} </th>
                                    <th> {{ __('Name') }} </th>
                                    <th> {{ __('Email') }} </th>
                                    <th> {{ __('Capsule') }} </th>
                                    <th> {{ __('Permission') }} </th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (!count($contributors))
                                    <tr>
                                        <td colspan="6" nowrap="nowrap">
                                            <center>
                                                {{ __('No data found!') }}
                                            </center>
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($contributors as $contributor)
                                    <tr>
                                        <td>
                                            @if ($contributor->user->image)
                                                <div class="symbol symbol-50 symbol-lg-120">
                                                    <img alt="{{ $contributor->user->name }}"
                                                        src="{{ Storage::url($contributor->user->image) }}">
                                                </div>
                                            @endif
                                        </td>
                                        <td> {{ $contributor->user->name }} </td>
                                        <td> {{ $contributor->user->email }} </td>
                                        <td> {{ $contributor->capsule->title }} </td>

                                        <td>
                                            @foreach ($contributor->capsule->contributorPermission as $contributorLoopPermission)
                                                @if (
                                                    $contributorLoopPermission->contributor_id == $contributor->user_id &&
                                                        $contributorLoopPermission->capsule_id == $contributor->capsule_id)
                                                    @if ($contributorLoopPermission->permission == 'w')
                                                        R/W
                                                    @else
                                                        R
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>

                                        <td nowrap="nowrap">

                                            <button type="button"
                                                wire:click="setToBeDeleted('{{ Crypt::encrypt($contributor->user->id) }}', '{{ Crypt::encrypt($contributor->capsule->id) }}')"
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

</div>
