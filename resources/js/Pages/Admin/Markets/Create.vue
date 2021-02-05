<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Create new market
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="createMarket">
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

                                <!-- Description -->
                                <div class="block">
                                    <bolt-label
                                        for="description"
                                        value="Chú thích"
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
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
    export default {
        name: "Create",
        components: {AdminLayout, BoltLabel, BoltInput, BoltInputError, BoltPrimaryButton},
        data() {
            return {
                marketForm: this.$inertia.form({
                    name: null,
                    website: null,
                    description: null,
                }),
            };
        },
        methods: {
            createMarket() {
                this.marketForm.post(route('admin.markets.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.marketForm.reset();
                    },
                });
            },
        },
    };
</script>
