<template>
    <bolt-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
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
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <bolt-input-error
                    :message="form.errors.name"
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
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                />
                <bolt-input-error
                    :message="form.errors.email"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <bolt-action-message
                :on="form.recentlySuccessful"
                class="mr-3"
            >
                Saved.
            </bolt-action-message>

            <bolt-primary-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </bolt-primary-button>
        </template>
    </bolt-form-section>
</template>

<script>
    import BoltPrimaryButton from '@/Components/PrimaryButton';
    import BoltFormSection from '@/Components/FormSection';
    import BoltInput from '@/Components/Input';
    import BoltInputError from '@/Components/InputError';
    import BoltLabel from '@/Components/Label';
    import BoltActionMessage from '@/Components/ActionMessage';

    export default {
        components: {
            BoltActionMessage,
            BoltPrimaryButton,
            BoltFormSection,
            BoltInput,
            BoltInputError,
            BoltLabel,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                }),
            };
        },

        methods: {
            updateProfileInformation() {
                this.form.put(route('user.profile.update'), {
                    errorBag: 'updateUserProfile',
                    preserveScroll: true,
                });
            },
        },
    };
</script>
