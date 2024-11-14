<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Account Settings" category="Account" sub-category="Delete Account" page="Delete Account"
                :category-link="route('delete.account')" :sub-category-link="route('delete.account')" :page-link="route('delete.account')" />

            <x-form title="Delete Account" cancel-action="cancel" :classes="'col-xl-12'" :enable-modaling="true" :is-disabled="$signature != 'I ware about the when delete my account I cannot access to my content.'">

                <x-alert />

                <x-input name="signature" label="Signature/Agreement" :is-required="true" :is-live="true"
                    placeholder="Enter the agreement statement here" :description="'Type your agreement as: <code>I ware about the when delete my account I cannot access to my content.</code>'" />

            </x-form>

            <x-modal title="Delete Account" :description="'Are your sure to perform <b>DELETE ACCOUNT</b> action?! <br> You <b>CANNOT</b> access to your content after <b>30 DAYS</b> after delete proccess complete.'" submit-action="deleteAccount"
                submit-text="Submit Delete Account" />

        </div>
    </div>
</div>
