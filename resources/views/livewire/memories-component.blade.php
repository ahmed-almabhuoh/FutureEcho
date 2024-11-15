<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{ __('Memories') }}
                            <span class="d-block text-muted pt-2 font-size-sm">
                                {{ __('Great things happen soon!') }}
                            </span>
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Capsule') }}</th>
                                <th>{{ __('Timeline') }}</th>
                                <th>{{ __('Media Downloads') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($memories->isEmpty())
                                <tr>
                                    <td colspan="3">
                                        <center>{{ __('No data found!') }}</center>
                                    </td>
                                </tr>
                            @endif

                            @foreach ($memories as $memory)
                                <tr>
                                    <td>{{ $memory->message }}</td>
                                    <td>{{ $memory->capsule->title ?? 'No Capsule' }}</td>
                                    <td>{{ getTimeline(App\Models\TimeLine::where('memory_id', $memory->id)->first()->id) }}
                                    </td>

                                    <td>
                                        @foreach ($memory->medias as $mediaPath)
                                            {{-- <a href="{{ route('memory.media', ['path' => basename($mediaPath)]) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-light-primary font-weight-bold my-2">
                                                {{ __('Download Media') }} {{ $loop->iteration }}
                                            </a> --}}

                                            <a href="{{ route('memory.media', ['path' => basename($mediaPath)]) }}"
                                                class="btn btn-outline-success my-2">
                                                <span class="svg-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000) "
                                                                x="11" y="1" width="2" height="14"
                                                                rx="1" />
                                                            <path
                                                                d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999) " />
                                                        </g>
                                                    </svg>
                                                </span>
                                                {{ __('Download Media') }} {{ $loop->iteration }}
                                            </a>
                                            <br>
                                        @endforeach
                                    </td>

                                    <td nowrap="nowrap">

                                        <a href="{{ route('memories.timeline') }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Timeline">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                                            fill="#000000" opacity="0.3" />
                                                        <path
                                                            d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                        <a href="{{ route('memories.receivers', $memory->id) }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z"
                                                            fill="#000000" />
                                                        <path
                                                            d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z"
                                                            fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </a>

                                        <button type="button"
                                            wire:click="setToBeDeleted('{{ Crypt::encrypt($memory->id) }}')"
                                            data-toggle="modal" data-target="#exampleModalCenter"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                        <path
                                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                            fill="#000000" opacity="0.3" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $memories->links() }}
                    </div>

                    <x-modal title="Delete Memory" description="Are you sure you want to delete this memory?"
                        submit-action="delete" submit-text="Delete" />
                </div>
            </div>
        </div>
    </div>
</div>
