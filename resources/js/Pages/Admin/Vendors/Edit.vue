<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Vendors
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="createVendor">
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                        <!-- Input -->
                        <div class="p-6 bg-white">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Market -->
                                <div class="block">
                                    <bolt-label
                                        for="market"
                                        value="Market"
                                    />
                                    <select
                                        id="market"
                                        v-model="vendorForm.market_id"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    >
                                        <option
                                            value="null"
                                            disabled
                                        >
                                            Please select one
                                        </option>
                                        <option
                                            v-for="market in markets"
                                            :key="market.id"
                                            :value="market.id"
                                        >
                                            {{ market.name }}
                                        </option>
                                    </select>
                                    <bolt-input-error
                                        :message="vendorForm.errors.market_id"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Identity -->
                                <div class="block">
                                    <bolt-label
                                        for="identity"
                                        value="Identity"
                                    />
                                    <bolt-input
                                        id="identity"
                                        v-model="vendorForm.identity"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="vendorForm.errors.identity"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Name -->
                                <div class="block">
                                    <bolt-label
                                        for="name"
                                        value="Name"
                                    />
                                    <bolt-input
                                        id="name"
                                        v-model="vendorForm.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="vendorForm.errors.name"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <bolt-action-message
                                :on="vendorForm.recentlySuccessful"
                                class="mr-3"
                            >
                                Đã lưu.
                            </bolt-action-message>
                            <bolt-primary-button
                                :class="{ 'opacity-25': vendorForm.processing }"
                                :disabled="vendorForm.processing"
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
        props: ['vendor', 'markets'],
        data() {
            return {
                vendorForm: this.$inertia.form({
                    market_id: this.vendor.market_id,
                    identity: this.vendor.identity,
                    name: this.vendor.name,
                }),
            };
        },
        methods: {
            createVendor() {
                this.vendorForm.put(route('admin.vendors.update', this.vendor), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
