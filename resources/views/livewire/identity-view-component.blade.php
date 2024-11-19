<div class="row">
    <div class="col-12">
        <div class="card card-custom" data-card="true" id="kt_card_1">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ __('Uploaded Identity') }}</h3>
                </div>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle"
                        data-toggle="tooltip" data-placement="top" title="Toggle Card">
                        <i class="ki ki-arrow-down icon-nm"></i>
                    </a>
                    <a href="#" wire:click="reload" class="btn btn-icon btn-sm btn-hover-light-primary mr-1"
                        data-card-tool="reload" data-toggle="tooltip" data-placement="top" title="Reload Card">
                        <i class="ki ki-reload icon-nm"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary" data-card-tool="remove"
                        data-toggle="tooltip" data-placement="top" title="Remove Card">
                        <i class="ki ki-close icon-nm"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <center>
                    <div class="symbol symbol-100 symbol-lg-200">
                        <img alt="{{ auth()->user()->name }}" src="{{ Storage::url($uploadedIdentity->file) }}">
                    </div>
                </center>

            </div>
        </div>
    </div>
</div>
