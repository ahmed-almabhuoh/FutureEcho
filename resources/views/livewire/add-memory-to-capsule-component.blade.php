<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Content Managment" category="Capsules" sub-category="Capsules" page="Memories To Capsules"
                :category-link="route('capsules.index')" :sub-category-link="route('capsules.index')" :page-link="route('memories.to.capsules')" />

            @if (count($memories))
                <x-form title="Memory To Capsule" submit-action="addMemory" cancel-action="cancel" :classes="'col-xl-12'">

                    <x-alert />

                    <x-select name="memory_ids" label="Memories" :options="$memories" :is-multi="true" />


                </x-form>
            @else
                <x-form title="New Memory" submit-action="newMemory" cancel-action="cancel" :classes="'col-xl-12'">

                    <x-alert />

                    <x-input name="title" label="Memory Title" :is-required="true"
                        placeholder="Enter the memory title here" />

                    <x-file name="medias" label="Memory Media\s" :is-image="false" :is-multi="true" />

                </x-form>
            @endif

        </div>
    </div>
</div>
