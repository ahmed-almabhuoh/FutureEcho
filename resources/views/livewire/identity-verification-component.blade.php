<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Management Access" category="Identity" sub-category="Identity Verification"
                page="Uploading Identity" :category-link="route('identity.verification')" :sub-category-link="route('identity.verification')" :page-link="route('identity.verification')" />

            @if (auth()->user()->identity()->count() == 0)
                <x-notice description="By verifying your account, you data cannot be lost!" />
            @endif

            <x-form title="Identity Verification Request" submit-action="submitRequest" cancel-action="cancel"
                :classes="'col-xl-12'">

                <x-alert />

                <x-file label="Identity Image" name="identity" :is-required="true" :is-disabled="auth()->user()->identity()->count() != 0" />

                @if (auth()->user()->identity()->count() != 0)
                    <x-notice
                        description="You request identity verification before, we will notify you after complete process from our side, thanks for your patient!" />
                @endif

            </x-form>

        </div>
    </div>
</div>
