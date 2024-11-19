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
                        <select class="form-control" id="kt_select2_3_modal" multiple="multiple">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ in_array($user->id, $receivers) ? 'selected' : '' }}
                                    data-name="{{ $user->name }}">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        function initializeSelect2() {
            const selectElement = $('#kt_select2_3_modal');

            // Initialize Select2
            selectElement.select2({
                placeholder: 'Select receivers by email',
                templateResult: formatEmail, // Format dropdown items
                templateSelection: formatName // Format selected items
            });

            // Sync selected values with Livewire
            selectElement.on('change', function() {
                @this.set('receivers', $(this).val());
            });
        }

        // Display email in dropdown items
        function formatEmail(option) {
            if (!option.id) {
                return option.text;
            }
            const name = $(option.element).data('name');
            return $(`<span>${option.text} (${name})</span>`);
        }

        // Display name for selected items
        function formatName(option) {
            if (!option.id) {
                return option.text;
            }
            const name = $(option.element).data('name');
            return name || option.text;
        }

        document.addEventListener('livewire:load', function() {
            initializeSelect2();
        });

        document.addEventListener('livewire:updated', function() {
            initializeSelect2();
        });
    </script>
@endpush
