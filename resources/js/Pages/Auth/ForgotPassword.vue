<template>
    <bolt-authentication-card>
        <template #logo>
            <inertia-link href="/">
                <bolt-application-logo class="h-20 fill-current text-gray-500" />
            </inertia-link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600"
        >
            {{ status }}
        </div>

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

            <div class="flex items-center justify-end mt-4">
                <bolt-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Email Password Reset Link
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
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'));
            },
        },
    };
</script>
