<div>
    {{-- Be like water. --}}

    <x-form title="New Legacy" submit-action="newLegacy" cancel-action="cancel" :classes="'col-xl-12'">

        <x-alert />

        <x-input name="email" label="Legacy E-mail Address" :is-required="true"
            placeholder="Enter the new legacy email address here" />

    </x-form>

</div>
