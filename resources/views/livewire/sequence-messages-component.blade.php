<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Content Management" category="Memories" sub-category="Messages" page="Message Sequencing"
                :category-link="route('memories')" :sub-category-link="route('memories')" :page-link="route('memories.seq.msgs', $memory->id)" />

            <x-notice description="Message that appears within a period time before the memory." />

            <x-form title="New Message" submit-action="newMessage" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="message" label="Sequence Message" :is-required="true"
                    placeholder="Enter the message here" />

                <x-input name="before" label="Before Memory Date" placeholder="E.G, 15, 20, 30" :is-required="true"
                    type="number" />


                <div class="card-body">
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Before/DAYs') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($msgs->isEmpty())
                                <tr>
                                    <td colspan="4">
                                        <center>{{ __('No data found!') }}</center>
                                    </td>
                                </tr>
                            @endif

                            @foreach ($msgs as $msg)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $msg->message }}</td>
                                    <td>
                                        {{ $msg->before . __(' Days') }}
                                    </td>

                                    <td nowrap="nowrap">

                                        <button type="button"
                                            wire:click="setToBeDeleted('{{ Crypt::encrypt($msg->id) }}')"
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

                    <x-modal title="Delete Message" description="Are you sure you want to delete this message?"
                        submit-action="delete" submit-text="Delete" />
                </div>

            </x-form>

        </div>
    </div>
</div>
