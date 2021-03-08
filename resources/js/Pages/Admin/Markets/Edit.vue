<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Cập nhật thị trường
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="updateMarket">
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                        <!-- Input -->
                        <div class="p-6 bg-white">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div class="block">
                                    <bolt-label
                                        for="name"
                                        value="Tên"
                                    />
                                    <bolt-input
                                        id="name"
                                        v-model="marketForm.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="marketForm.errors.name"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Website -->
                                <div class="block">
                                    <bolt-label
                                        for="website"
                                        value="Website"
                                    />
                                    <bolt-input
                                        id="website"
                                        v-model="marketForm.website"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="marketForm.errors.website"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Currency -->
                                <div class="block">
                                    <bolt-label
                                        for="currency_code"
                                        value="Loại tiền"
                                    />
                                    <bolt-input
                                        id="currency_code"
                                        v-model="marketForm.currency_code"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="marketForm.errors.currency_code"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Description -->
                                <div class="block">
                                    <bolt-label
                                        for="description"
                                        value="Description"
                                    />
                                    <bolt-input
                                        id="description"
                                        v-model="marketForm.description"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="marketForm.errors.description"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <bolt-action-message
                                :on="marketForm.recentlySuccessful"
                                class="mr-3"
                            >
                                Đã lưu.
                            </bolt-action-message>
                            <bolt-primary-button
                                :class="{ 'opacity-25': marketForm.processing }"
                                :disabled="marketForm.processing"
                            >
                                Lưu lại
                            </bolt-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltActionMessage from "@/Components/ActionMessage";
    export default {
        name: "Edit",
        components: {AdminLayout, BoltLabel, BoltInput, BoltInputError, BoltPrimaryButton, BoltActionMessage},
        props: ['market'],
        data() {
            return {
                marketForm: this.$inertia.form({
                    name: this.market.name,
                    website: this.market.website,
                    currency_code: this.market.currency_code,
                    description: this.market.description,
                }),
            };
        },
        methods: {
            updateMarket() {
                this.marketForm.put(route('admin.markets.update', this.market), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>

<style scoped>

</style>
