<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Edit user
                    </h1>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Profile -->
            <bolt-form-section @submitted="updateUserProfile">
                <template #title>
                    Profile Information
                </template>

                <template #description>
                    Update user profile information and email address.
                </template>

                <template #form>
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="name"
                            value="Name"
                        />
                        <bolt-input
                            id="name"
                            v-model="userProfileForm.name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.name"
                            class="mt-2"
                        />
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="email"
                            value="Email"
                        />
                        <bolt-input
                            id="email"
                            v-model="userProfileForm.email"
                            type="email"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.email"
                            class="mt-2"
                        />
                    </div>

                    <!-- Phone -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="phone"
                            value="Phone"
                        />
                        <bolt-input
                            id="phone"
                            v-model="userProfileForm.phone"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.phone"
                            class="mt-2"
                        />
                    </div>

                    <!-- Verify email -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input
                                    v-model="userProfileForm.email_verified"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    :checked="userProfileForm.email_verified"
                                >
                                <span class="ml-2">Email verified</span>
                            </label>
                        </div>
                    </div>
                </template>

                <template #actions>
                    <bolt-action-message
                        :on="userProfileForm.recentlySuccessful"
                        class="mr-3"
                    >
                        Saved.
                    </bolt-action-message>

                    <bolt-primary-button
                        :class="{ 'opacity-25': userProfileForm.processing }"
                        :disabled="userProfileForm.processing"
                    >
                        Save
                    </bolt-primary-button>
                </template>
            </bolt-form-section>

            <bolt-section-border />

            <!-- Password -->
            <bolt-form-section
                class="mt-10 sm:mt-0"
                @submitted="updateUserPassword"
            >
                <template #title>
                    Update Password
                </template>

                <template #description>
                    Ensure using a long, random password to stay secure.
                </template>

                <template #form>
                    <!-- Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="password"
                            value="Password"
                        />
                        <bolt-input
                            id="password"
                            v-model="userPasswordForm.password"
                            type="password"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userPasswordForm.errors.password"
                            class="mt-2"
                        />
                    </div>

                    <!-- Password confirmation -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="password_confirmation"
                            value="Password confirmation"
                        />
                        <bolt-input
                            id="password_confirmation"
                            v-model="userPasswordForm.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userPasswordForm.errors.password_confirmation"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #actions>
                    <bolt-action-message
                        :on="userPasswordForm.recentlySuccessful"
                        class="mr-3"
                    >
                        Saved.
                    </bolt-action-message>

                    <bolt-primary-button
                        :class="{ 'opacity-25': userPasswordForm.processing }"
                        :disabled="userPasswordForm.processing"
                    >
                        Save
                    </bolt-primary-button>
                </template>
            </bolt-form-section>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltFormSection from "@/Components/FormSection";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltActionMessage from "@/Components/ActionMessage";
    import BoltSectionBorder from "@/Components/SectionBorder";

    export default {
        name: "UserEdit",
        components: {AdminLayout, BoltFormSection, BoltActionMessage, BoltLabel, BoltInput, BoltInputError, BoltPrimaryButton, BoltSectionBorder},
        props: ["user"],
        data() {
            return {
                userProfileForm: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                    phone: this.user.phone,
                    email_verified: !!this.user.email_verified_at,
                }),
                userPasswordForm: this.$inertia.form({
                    password: null,
                    password_confirmation: null,
                }),
            };
        },
        methods: {
            updateUserProfile() {
                this.userProfileForm.put(route("admin.users.update", this.user), {
                    preserveScroll: true,
                });
            },

            updateUserPassword() {
                this.userPasswordForm.put(route("admin.users.update", this.user), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
