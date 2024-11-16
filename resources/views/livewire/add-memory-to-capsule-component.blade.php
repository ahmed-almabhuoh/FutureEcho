<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Content Managment" category="Capsules" sub-category="Capsules" page="Memories To Capsules"
                :category-link="route('capsules.index')" :sub-category-link="route('capsules.index')" :page-link="route('memories.to.capsules')" />

            <x-form title="Memory To Capsule" submit-action="addMemory" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-select name="memory_ids" label="Memories" :options="$memories" :is-multi="true" />


            </x-form>

        </div>
    </div>
</div>
