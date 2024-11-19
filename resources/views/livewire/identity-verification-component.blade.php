<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Management Access" category="Identity" sub-category="Identity Verification"
                page="Uploading Identity" :category-link="route('identity.verification')" :sub-category-link="route('identity.verification')" :page-link="route('identity.verification')" />

            @if (auth()->user()->identity()->count() == 0)
                <x-notice description="By verifying your account, you data cannot be lost!" />
            @endif

            <x-form title="Identity Verification Request" submit-action="submitRequest" cancel-action="cancel"
                :classes="'col-xl-12'" :is-disabled="is_null($identity)">

                <x-alert />

                <x-file :is-image="true" label="Identity Image" name="identity" :is-required="true" :is-disabled="auth()->user()->identity()->count() != 0" />

                @if (!is_null($identity))
                    <x-image-preview path="{{ $identity->temporaryUrl() }}" />
                @endif

                @if (auth()->user()->identity()->count() != 0)
                    <x-notice
                        description="You request identity verification before, we will notify you after complete process from our side, thanks for your patient!" />
                @endif

            </x-form>

            @if (!is_null($uploadedIdentity) && $uploadedIdentity->status == 'pending')
                <livewire:identity-view-component :uploaded-identity="$uploadedIdentity" />
            @endif

        </div>
    </div>
</div>
