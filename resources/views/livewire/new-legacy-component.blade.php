<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Management Access" category="Legacy" sub-category="New Legacy" page="Add New Legacy"
                :category-link="route('legacy')" :sub-category-link="route('legacies.new')" :page-link="route('legacies.new')" />

            <x-notice description="Be careful, you cannot delete accepted legacy!" />

            <x-form title="New Legacy" submit-action="newLegacy" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="email" label="Legacy E-mail Address" :is-required="true"
                    placeholder="Enter the new legacy email address here" />

            </x-form>

        </div>
    </div>
</div>
