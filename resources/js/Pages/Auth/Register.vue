<template>
    <bolt-authentication-card>
        <template #logo>
            <a href="/">
                <bolt-application-logo class="h-20 fill-current text-gray-500" />
            </a>
        </template>

        <bolt-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <bolt-label
                    for="name"
                    value="Name"
                />
                <bolt-input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>

            <div class="mt-4">
                <bolt-label
                    for="phone"
                    value="Phone"
                />
                <bolt-input
                    id="phone"
                    v-model="form.phone"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="phone"
                />
            </div>

            <div class="mt-4">
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
                <inertia-link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Already registered?
                </inertia-link>

                <bolt-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
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

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    phone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                });
            },
        },
    };
</script>
