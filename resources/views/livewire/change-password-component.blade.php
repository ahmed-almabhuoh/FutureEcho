<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">

            <x-index index="Account Settings" category="Password" sub-category="Change Password" page="Change Password"
                :category-link="route('change.password')" :sub-category-link="route('change.password')" :page-link="route('change.password')" />

            <x-form title="Change Password" submit-action="changePassword" cancel-action="cancel" :classes="'col-xl-12'">

                <x-alert />

                <x-input name="old_password" label="Current Password" :is-required="true" type="password"
                    placeholder="Enter the current password here" />

                <x-input name="password" label="New Password" :is-required="true" type="password"
                    placeholder="Enter the new password here" />

                <x-input name="password_confirmation" label="Password Confirmation" :is-required="true" type="password"
                    placeholder="Enter the password confirmation here" />

            </x-form>

        </div>
    </div>
</div>
