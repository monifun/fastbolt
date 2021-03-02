<template>
    <bolt-authentication-card>
        <template #logo>
            <inertia-link href="/">
                <bolt-application-logo class="h-20 fill-current text-gray-500" />
            </inertia-link>
        </template>

        <bolt-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <bolt-label
                    for="email"
                    value="Email"
                />
                <bolt-input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <bolt-label
                    for="password"
                    value="Password"
                />
                <bolt-input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <bolt-label
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <bolt-input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <bolt-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </bolt-button>
            </div>
        </form>
    </bolt-authentication-card>
</template>

<script>
    import BoltApplicationLogo from '@/Components/ApplicationLogo';
    import BoltAuthenticationCard from '@/Components/AuthenticationCard';
    import BoltButton from '@/Components/PrimaryButton';
    import BoltInput from '@/Components/Input';
    import BoltLabel from '@/Components/Label';
    import BoltValidationErrors from '@/Components/ValidationErrors';

    export default {
        components: {
            BoltApplicationLogo,
            BoltAuthenticationCard,
            BoltButton,
            BoltInput,
            BoltLabel,
            BoltValidationErrors,
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                });
            },
        },
    };
</script>
