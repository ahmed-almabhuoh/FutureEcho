<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <x-index index="Management Access - AM" category="Memories" sub-category="Receivers" page="Add Receivers"
                :category-link="route('memories')" :sub-category-link="route('memories.receivers', $memory->id)" :page-link="route('memories.receivers', $memory->id)" />

            <x-notice description="All receivers will be notified when the timeline is coming!" />

            <x-form title="Receivers" submit-action="addReceivers" cancel-action="cancel" :classes="'col-xl-12'">
                <x-alert />

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Receivers</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <select id="kt_select2_3_modal" name="receivers[]" multiple="multiple" wire:model="receivers"
                            class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" data-name="{{ $user->name }}">
                                    {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            // Initialize Tom Select for multi-select with search by email
            const selectElement = document.getElementById('kt_select2_3_modal');

            new TomSelect(selectElement, {
                placeholder: 'Select receivers by email',
                valueField: 'value', // The value (user id) that will be selected
                labelField: 'label', // The name (user name) that will be displayed
                searchField: ['email', 'name'], // Searchable fields (email and name)
                plugins: ['remove_button'], // Enable remove button for selected items
                create: false, // Disable creating new options
                maxItems: null, // No limit on the number of selected items
                render: {
                    option: function(data, escape) {
                        return `<div>${escape(data.email)} (${escape(data.name)})</div>`;
                    },
                    item: function(data, escape) {
                        return `<div class="d-flex justify-content-between">
                                    <span>${escape(data.name)}</span>
                                    <span>${escape(data.email)}</span>
                                </div>`;
                    }
                }
            });

            // Sync with Livewire model
            selectElement.addEventListener('change', function() {
                @this.set('receivers', Array.from(this.selectedOptions).map(option => option.value));
            });
        });
    </script>
@endpush
