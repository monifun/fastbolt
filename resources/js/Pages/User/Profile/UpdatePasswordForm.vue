<template>
    <bolt-form-section @submitted="updatePassword">
        <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="current_password"
                    value="Current Password"
                />
                <bolt-input
                    id="current_password"
                    ref="current_password"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />
                <bolt-input-error
                    :message="form.errors.current_password"
                    class="mt-2"
                />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="password"
                    value="New Password"
                />
                <bolt-input
                    id="password"
                    ref="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />
                <bolt-input-error
                    :message="form.errors.password"
                    class="mt-2"
                />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <bolt-input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />
                <bolt-input-error
                    :message="form.errors.password_confirmation"
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
    import BoltActionMessage from '@/Components/ActionMessage';
    import BoltPrimaryButton from '@/Components/PrimaryButton';
    import BoltFormSection from '@/Components/FormSection';
    import BoltInput from '@/Components/Input';
    import BoltInputError from '@/Components/InputError';
    import BoltLabel from '@/Components/Label';

    export default {
        components: {
            BoltActionMessage,
            BoltPrimaryButton,
            BoltFormSection,
            BoltInput,
            BoltInputError,
            BoltLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }),
            };
        },

        methods: {
            updatePassword() {
                this.form.put(route('user.password.update'), {
                    errorBag: 'updateUserPassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation');
                            this.$refs.password.focus();
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset('current_password');
                            this.$refs.current_password.focus();
                        }
                    },
                });
            },
        },
    };
</script>
