<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Content Managment" category="Memories" sub-category="Timeline" page="Memory Timeline"
                :category-link="route('memories')" :sub-category-link="route('memories.timeline')" :page-link="route('memories.timeline')" />

            <x-form title="Memory Timeline" submit-action="newTimeline" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-select name="memory" label="Memory" :options="$memories" :is-live="true" />

                <x-input name="from" label="From Date" :is-required="true" type="date" />

                <x-input name="to" label="To Date" :is-required="true" type="date" />

            </x-form>

        </div>
    </div>
</div>
