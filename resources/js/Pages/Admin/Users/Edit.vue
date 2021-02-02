<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Chỉnh sửa người dùng
            </h1>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Profile -->
            <bolt-form-section @submitted="updateUserProfile">
                <template #title>
                    Hồ sơ
                </template>

                <template #description>
                    Cập nhật thông tin cá nhân của người dùng.
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
                            v-model="userProfileForm.name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.name"
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
                            v-model="userProfileForm.email"
                            type="email"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.email"
                            class="mt-2"
                        />
                    </div>

                    <!-- Phone -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="phone"
                            value="Điện thoại"
                        />
                        <bolt-input
                            id="phone"
                            v-model="userProfileForm.phone"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userProfileForm.errors.phone"
                            class="mt-2"
                        />
                    </div>

                    <!-- Verify email -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input
                                    v-model="userProfileForm.email_verified"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    :checked="userProfileForm.email_verified"
                                >
                                <span class="ml-2">Xác nhận email</span>
                            </label>
                        </div>
                    </div>
                </template>

                <template #actions>
                    <bolt-action-message
                        :on="userProfileForm.recentlySuccessful"
                        class="mr-3"
                    >
                        Đã lưu.
                    </bolt-action-message>

                    <bolt-primary-button
                        :class="{ 'opacity-25': userProfileForm.processing }"
                        :disabled="userProfileForm.processing"
                    >
                        Lưu lại
                    </bolt-primary-button>
                </template>
            </bolt-form-section>

            <bolt-section-border />

            <!-- Password -->
            <bolt-form-section
                class="mt-10 sm:mt-0"
                @submitted="updateUserPassword"
            >
                <template #title>
                    Mật khẩu
                </template>

                <template #description>
                    Thay đổi thông tin mật khẩu đăng nhập của người dùng.
                </template>

                <template #form>
                    <!-- Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="password"
                            value="Mật khẩu"
                        />
                        <bolt-input
                            id="password"
                            v-model="userPasswordForm.password"
                            type="password"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userPasswordForm.errors.password"
                            class="mt-2"
                        />
                    </div>

                    <!-- Password confirmation -->
                    <div class="col-span-6 sm:col-span-4">
                        <bolt-label
                            for="password_confirmation"
                            value="Xác nhận mật khẩu"
                        />
                        <bolt-input
                            id="password_confirmation"
                            v-model="userPasswordForm.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="userPasswordForm.errors.password_confirmation"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #actions>
                    <bolt-action-message
                        :on="userPasswordForm.recentlySuccessful"
                        class="mr-3"
                    >
                        Đã lưu.
                    </bolt-action-message>

                    <bolt-primary-button
                        :class="{ 'opacity-25': userPasswordForm.processing }"
                        :disabled="userPasswordForm.processing"
                    >
                        Lưu lại
                    </bolt-primary-button>
                </template>
            </bolt-form-section>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltFormSection from "@/Components/FormSection";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltActionMessage from "@/Components/ActionMessage";
    import BoltSectionBorder from "@/Components/SectionBorder";

    export default {
        name: "UserEdit",
        components: {AdminLayout, BoltFormSection, BoltActionMessage, BoltLabel, BoltInput, BoltInputError, BoltPrimaryButton, BoltSectionBorder},
        props: ["user"],
        data() {
            return {
                userProfileForm: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                    phone: this.user.phone,
                    email_verified: !!this.user.email_verified_at,
                }),
                userPasswordForm: this.$inertia.form({
                    password: null,
                    password_confirmation: null,
                }),
            };
        },
        methods: {
            updateUserProfile() {
                this.userProfileForm.put(route("admin.users.update", this.user), {
                    preserveScroll: true,
                });
            },

            updateUserPassword() {
                this.userPasswordForm.put(route("admin.users.update", this.user), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
