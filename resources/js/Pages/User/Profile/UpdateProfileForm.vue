<template>
    <bolt-form-section @submitted="updateProfileInformation">
        <template #title>
            Thông tin
        </template>

        <template #description>
            Cập nhật thông tin cá nhân và địa chỉ email của bạn.
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="name"
                    value="Họ và Tên"
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

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="phone"
                    value="Điện thoại"
                />
                <bolt-input
                    id="phone"
                    v-model="form.phone"
                    type="number"
                    class="mt-1 block w-full"
                    autocomplete="phone"
                />
                <bolt-input-error
                    :message="form.errors.phone"
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

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
                <bolt-label
                    for="address"
                    value="Địa chỉ"
                />
                <bolt-textarea
                    id="address"
                    v-model="form.address"
                    class="mt-1 block w-full"
                />
                <bolt-input-error
                    :message="form.errors.address"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <bolt-action-message
                :on="form.recentlySuccessful"
                class="mr-3"
            >
                Đã lưu.
            </bolt-action-message>

            <bolt-primary-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Lưu lại
            </bolt-primary-button>
        </template>
    </bolt-form-section>
</template>

<script>
    import BoltPrimaryButton from '@/Components/PrimaryButton';
    import BoltFormSection from '@/Components/FormSection';
    import BoltLabel from '@/Components/Label';
    import BoltInput from '@/Components/Input';
    import BoltTextarea from "@/Components/Textarea";
    import BoltInputError from '@/Components/InputError';
    import BoltActionMessage from '@/Components/ActionMessage';

    export default {
        components: {
            BoltActionMessage,
            BoltPrimaryButton,
            BoltFormSection,
            BoltLabel,
            BoltInput,
            BoltTextarea,
            BoltInputError,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                    phone: this.user.phone,
                    address: this.user.address,
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
