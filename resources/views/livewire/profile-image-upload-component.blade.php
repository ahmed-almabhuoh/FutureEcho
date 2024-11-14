<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label text-right">{{ $label ?? 'Profile Image' }}</label>
    <div class="col-lg-9 col-xl-6">
        <div class="image-input image-input-outline" style="background-image: url({{ $imagePreview }})">
            <div class="image-input-wrapper" style="background-image: url({{ $imagePreview }})">
            </div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="change">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" wire:model="image" accept=".png, .jpg, .jpeg" />
            </label>

            @if ($currentImage || $image)
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                    data-action="remove" wire:click="removeImage">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
            @endif

            <!-- Loading Spinner -->
            <div wire:loading wire:target="image" class="spinner spinner-track spinner-primary spinner-sm mr-15"></div>
        </div>
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
