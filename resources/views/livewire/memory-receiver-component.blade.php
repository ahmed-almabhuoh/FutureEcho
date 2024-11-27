<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <x-index index="Management Access - AM" category="Memories" sub-category="Receivers" page="Add Receivers"
                :category-link="route('memories')" :sub-category-link="route('memories.receivers', $memory->id)" :page-link="route('memories.receivers', $memory->id)" />

            <x-notice description="All receivers will be notified when the timeline is coming!" />

            <x-form title="Receivers" submit-action="addReceivers" cancel-action="cancel" :classes="'col-xl-12'">
                <x-alert />

                <div class="form-group row" wire:ignore>

                    <label class="col-form-label text-right col-lg-3 col-sm-12"> {{ __('Receivers') }} </label>
                    <select name="receivers" id="receivers" class="form-control" multiple style="width: 50%;">
                        @foreach ($users as $user)
                            <option value="{{ $user->email }}" @if (in_array($user->email, $emails)) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
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
        $('#receivers').select2();

        // Initialize select2 when the page loads
        // document.addEventListener('livewire:load', function() {
        //     $('#js-example-basic-hide-search-multi').select2();
        // });

        // Reinitialize select2 when Livewire updates the DOM
        // Livewire.on('select2Updated', () => {
        //     alert($('#js-example-basic-hide-search-multi').select2());
        //     $('#js-example-basic-hide-search-multi').select2();
        // });

        // Disable search field during opening and closing to enhance UX
        // $('#receivers').on('select2:opening select2:closing', function(event) {
        $('#receivers').on('select2:closing', function(event) {
            var $searchfield = $(this).parent().find('.select2-search__field');
            $searchfield.prop('disabled', true);
            // console.log($('#receivers').select2('data').length);
            // Livewire.dispatch('select2Updated', $('#js-example-basic-hide-search-multi').select2('data'));

            // console.log($('#js-example-basic-hide-search-multi').select2('data'));
            if ($('#receivers').select2('data').length >= 1) {
                Livewire.dispatch('select2Updated', {
                    'receivers': $('#receivers').select2('data')
                });
            }

            // console.log(json_encode($('#js-example-basic-hide-search-multi').select2('data')));
        });
    </script>
@endpush
