<div wire:ignore class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ __($title) }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {{ __($description) }}
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="{{ isset($closeAction) ? $closeAction : 'close' }}"
                    class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                    {{ isset($closeText) ? __($closeText) : __('Close') }} </button>
                <button type="button" wire:click="{{ $submitAction }}"
                    class="btn btn-primary font-weight-bold">{{ isset($submitText) ? __($submitText) : __('Submit') }}</button>
            </div>
        </div>
    </div>
</div>
