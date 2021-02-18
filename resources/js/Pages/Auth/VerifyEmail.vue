<template>
    <bolt-authentication-card>
        <template #logo>
            <inertia-link href="/">
                <bolt-application-logo />
            </inertia-link>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <bolt-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </bolt-button>

                <inertia-link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</inertia-link>
            </div>
        </form>
    </bolt-authentication-card>
</template>

<script>
    import BoltApplicationLogo from '@/Components/ApplicationMark'
    import BoltAuthenticationCard from '@/Components/AuthenticationCard'
    import BoltButton from '@/Components/Button'

    export default {
        components: {
            BoltApplicationLogo,
            BoltAuthenticationCard,
            BoltButton,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
