<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit order
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- General -->
                <bolt-form-section @submitted="updateOrderGeneral">
                    <template #title>
                        Thông tin chung
                    </template>

                    <template #description>
                        Thay đổi thông tin đơn hàng.
                    </template>

                    <template #form>
                        <!-- Exchange rate -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="currency_rate"
                                value="Tỉ giá"
                            />
                            <bolt-input
                                id="currency_rate"
                                v-model="orderGeneralForm.currency_rate"
                                type="number"
                                class="mt-1 block w-full"
                                min="1"
                                step="any"
                            />
                            <bolt-input-error
                                :message="orderGeneralForm.errors.currency_rate"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="orderGeneralForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Đã lưu.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': orderGeneralForm.processing }"
                            :disabled="orderGeneralForm.processing"
                        >
                            Lưu lại
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <bolt-section-border />

                <!-- Customer -->
                <bolt-form-section @submitted="updateOrderShipping">
                    <template #title>
                        Khách hàng
                    </template>

                    <template #description>
                        Thay đổi thông tin khách hàng và địa chỉ nhận hàng.
                    </template>

                    <template #form>
                        <!-- Shipping Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_name"
                                value="Họ và tên"
                            />
                            <bolt-input
                                id="shipping_name"
                                v-model="orderShippingForm.shipping_name"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_name"
                                class="mt-2"
                            />
                        </div>

                        <!-- Shipping Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_phone"
                                value="Số điện thoại"
                            />
                            <bolt-input
                                id="shipping_phone"
                                v-model="orderShippingForm.shipping_phone"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_phone"
                                class="mt-2"
                            />
                        </div>

                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_address"
                                value="Địa chỉ"
                            />
                            <bolt-input
                                id="shipping_address"
                                v-model="orderShippingForm.shipping_address"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_address"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="orderShippingForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Đã lưu.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': orderShippingForm.processing }"
                            :disabled="orderShippingForm.processing"
                        >
                            Lưu lại
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <bolt-section-border />

                <!-- Tax and Fee -->
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <bolt-section-title>
                        <template #title>
                            Thuế và Phí
                        </template>

                        <template #description>
                            Quản lý các loại thuế và phí
                        </template>
                    </bolt-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        Tên
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        Loại
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        Phương thức
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        Đánh vào
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        Giá trị
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="relative px-6 py-3"
                                                    >
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr
                                                    v-for="tax in order.taxes"
                                                    :key="tax.id"
                                                >
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ tax.name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ tax.type }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ tax.method }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ tax.target }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ tax.value }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a
                                                            href="#"
                                                            class="text-indigo-600 hover:text-indigo-900"
                                                        >Edit</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltFormSection from "@/Components/FormSection";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltSectionBorder from "@/Components/SectionBorder";
    import BoltActionMessage from "@/Components/ActionMessage";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltSectionTitle from "@/Components/SectionTitle";

    export default {
        name: "Edit",
        components: {AdminLayout, BoltFormSection, BoltLabel, BoltInput, BoltInputError, BoltSectionBorder, BoltActionMessage, BoltPrimaryButton, BoltSectionTitle},
        props: ['order', 'fees'],
        data() {
            return {
                orderGeneralForm: this.$inertia.form({
                    currency_rate: this.order.currency_rate,
                }),

                orderShippingForm: this.$inertia.form({
                    shipping_name: this.order.shipping_name,
                    shipping_phone: this.order.shipping_phone,
                    shipping_address: this.order.shipping_address,
                }),
            };
        },
        methods: {
            updateOrderGeneral() {
                return this.orderGeneralForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
            updateOrderShipping() {
                return this.orderShippingForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
