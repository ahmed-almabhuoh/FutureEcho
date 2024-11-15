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
                                        <button type="button"
                                            wire:click="setToBeDeleted('{{ Crypt::encrypt($memory->id) }}')"
                                            data-toggle="modal" data-target="#exampleModalCenter"
                                            class="btn btn-sm btn-clean btn-icon" title="Delete">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
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
