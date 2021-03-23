<template>
    <bolt-authentication-card>
        <template #logo>
            <a href="/">
                <bolt-application-logo class="h-20 fill-current text-gray-500" />
            </a>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <bolt-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
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
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="flex justify-end mt-4">
                <bolt-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
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
            BoltAuthenticationCard,
            BoltApplicationLogo,
            BoltButton,
            BoltInput,
            BoltLabel,
            BoltValidationErrors,
        },

        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                });
            },
        },
    };
</script>
