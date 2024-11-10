<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Capsule & CM" category="Capsules" sub-category="New Capsule" page="New Capsule"
                :category-link="route('capsules.create')" :sub-category-link="route('capsules.create')" :page-link="route('capsules.create')" />

            <x-form title="New Capsule" submit-action="newCapsule" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="title" label="Capsule Title" :is-required="true"
                    placeholder="Enter capsule title here" />

            </x-form>

        </div>
    </div>
</div>
