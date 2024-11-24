<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <!-- Page Header -->
            <x-index index="Account Settings" category="Settings" sub-category="General Settings" page="General Settings"
                :category-link="route('settings.general')" :sub-category-link="route('settings.general')" :page-link="route('settings.general')" />

            <!-- Form for General Settings -->
            <x-form title="General Settings" submit-action="updateSettings" cancel-action="cancel" :classes="'col-xl-12'">

                <!-- Alert Message -->
                <x-alert />

                <!-- Form Fields -->
                <div class="row">
                    <!-- Full Name Input -->
                    <x-input name="name" label="Full Name" :is-required="true" classes="col-xl-6"
                        placeholder="Enter your name here" wire:model.defer="name" :read-only="auth()->user()?->identity?->status == 'verified'" />

                    <!-- Email Input (Read-Only) -->
                    <x-input name="email" label="E-mail Address" :is-required="true" classes="col-xl-6"
                        placeholder="Enter your email here" :read-only="true" wire:model.defer="email" />
                </div>

                <div class="row">
                    <!-- Phone Number Input -->
                    <x-input name="phone" label="Phone Number" :is-required="false" classes="col-xl-12"
                        placeholder="Enter your phone number here" wire:model.defer="phone" />
                </div>

                <!-- Profile Image Upload Component -->
                <center>
                    <x-profile-image-upload label="Profile Image" inputName="image" :currentImage="$currentImage" />
                </center>

                <!-- Submit and Cancel Buttons -->
                <div class="form-group row mt-4">
                    <div class="col-lg-12 text-center">
                        <button type="button" class="btn btn-primary" wire:click="updateSettings">
                            {{ __('Save Changes') }} </button>
                    </div>
                </div>

            </x-form>
        </div>
    </div>
</div>
