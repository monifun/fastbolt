<template>
    <bolt-authentication-card>
        <template #logo>
            <inertia-link href="/">
                <bolt-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </inertia-link>
        </template>

        <bolt-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <bolt-label for="name" value="Name" />
                <bolt-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <bolt-label for="email" value="Email" />
                <bolt-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <bolt-label for="password" value="Password" />
                <bolt-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <bolt-label for="password_confirmation" value="Confirm Password" />
                <bolt-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </inertia-link>

                <bolt-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </bolt-button>
            </div>
        </form>
    </bolt-authentication-card>
</template>

<script>
    import BoltApplicationLogo from '@/Components/ApplicationMark'
    import BoltAuthenticationCard from '@/Components/AuthenticationCard'
    import BoltButton from '@/Components/PrimaryButton'
    import BoltCheckbox from "@/Components/Checkbox";
    import BoltInput from '@/Components/Input'
    import BoltLabel from '@/Components/Label'
    import BoltValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BoltApplicationLogo,
            BoltAuthenticationCard,
            BoltButton,
            BoltCheckbox,
            BoltInput,
            BoltLabel,
            BoltValidationErrors,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
