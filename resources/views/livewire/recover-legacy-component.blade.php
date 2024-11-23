<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Management Access" category="Legacy" sub-category="Recoveries" page="Recover Legacy"
                :category-link="route('legacy')" :sub-category-link="route('legacies.recover')" :page-link="route('legacies.recover')" />

            <x-form :is-disabled="is_null($pass_key)" title="Recover Legacy" :enable-modaling="true" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="pass_key" label="PASS-KEY" :is-required="true" :is-live="true"
                    placeholder="Enter the PASS-KEY here" />

            </x-form>

            <x-modal title="Recover Legacy" :description="__(
                'Are you sure you need to perform <b>RECOVERING</b> for your legacy account!',
            )" submit-action="recoverLegacy"
                submit-text="Submit Recovering" />

        </div>
    </div>
</div>
