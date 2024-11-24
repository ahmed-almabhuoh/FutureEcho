<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <x-index index="Management Access - AM" category="Memories" sub-category="Receivers" page="Add Receivers"
                :category-link="route('memories')" :sub-category-link="route('memories.receivers', $memory->id)" :page-link="route('memories.receivers', $memory->id)" />

            <x-notice description="All receivers will be notified when the timeline is coming!" />

            <x-form title="Receivers" submit-action="addReceivers" cancel-action="cancel" :classes="'col-xl-12'">
                <x-alert />

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12"> {{ __('Receivers') }} </label>

                    <select id="js-example-basic-hide-search-multi" wire:ingore
                        class="js-states form-control select2-hidden-accessible" style="width: 50%;" multiple="">
                        <optgroup label="{{ __('Users') }}">
                            @foreach ($users as $user)
                                <option value="{{ $user->email }}">{{ $user->name }}</option>
                            @endforeach
                        </optgroup>
                    </select>

                </div>
            </x-form>
        </div>
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#js-example-basic-hide-search-multi').select2();

        // Initialize select2 when the page loads
        document.addEventListener('livewire:load', function() {
            $('#js-example-basic-hide-search-multi').select2();
        });

        // Reinitialize select2 when Livewire updates the DOM
        // Livewire.on('select2Updated', () => {
        //     alert($('#js-example-basic-hide-search-multi').select2());
        //     $('#js-example-basic-hide-search-multi').select2();
        // });

        // Disable search field during opening and closing to enhance UX
        $('#js-example-basic-hide-search-multi').on('select2:opening select2:closing', function(event) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('disabled', true);
            Livewire.dispatch('select2Updated', {
                receivers: $('#js-example-basic-hide-search-multi').select2('data')
            });
        });
    </script>
@endpush
