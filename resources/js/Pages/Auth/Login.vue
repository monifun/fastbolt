<template>
    <bolt-authentication-card>
        <template #logo>
            <inertia-link href="/">
                <bolt-application-logo class="h-20 fill-current text-gray-500" />
            </inertia-link>
        </template>

        <bolt-validation-errors class="mb-4" />

        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600"
        >
            {{ status }}
        </div>

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
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <bolt-checkbox
                        v-model:checked="form.remember"
                        name="remember"
                    />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Forgot your password?
                </inertia-link>

                <bolt-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
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
    import BoltCheckbox from '@/Components/Checkbox';
    import BoltLabel from '@/Components/Label';
    import BoltValidationErrors from '@/Components/ValidationErrors';

    export default {
        components: {
            BoltApplicationLogo,
            BoltAuthenticationCard,
            BoltButton,
            BoltInput,
            BoltCheckbox,
            BoltLabel,
            BoltValidationErrors,
        },

        props: {
            canResetPassword: Boolean,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false,
                }),
            };
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : '',
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    });
            },
        },
    };
</script>
