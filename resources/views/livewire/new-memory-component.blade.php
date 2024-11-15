<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            {{-- @foreach ($memories as $memory)
                @foreach ($memory->medias as $media)
                    <a href="{{ route('memory.media', ['path' => basename($media)]) }}" target="_blank">Download Media</a>
                @endforeach
            @endforeach --}}



            <x-index index="Content Managment" category="Memories" sub-category="New Memory" page="Add New Memory"
                :category-link="route('memories')" :sub-category-link="route('add.memory')" :page-link="route('add.memory')" />

            <x-form title="New Memory" submit-action="newMemory" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="title" label="Memory Title" :is-required="true"
                    placeholder="Enter the memory title here" />

                <x-select name="capsule_id" label="Capsule" :options="$capsules" />

                <x-file name="medias" label="Memory Media\s" :is-image="false" :is-multi="true" />

            </x-form>

        </div>
    </div>
</div>
