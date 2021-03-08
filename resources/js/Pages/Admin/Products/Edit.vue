<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Cập nhật sản phẩm
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.products.show', product)"
                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <svg
                            class="-ml-0.5 mr-2 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path
                                fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Chi tiết
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Details -->
                <bolt-form-section @submitted="updateProductDetails">
                    <template #title>
                        Thông tin
                    </template>

                    <template #description>
                        Cập nhật thông tin chi tiết sản phẩm.
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 lg:col-span-4">
                            <bolt-label
                                for="name"
                                value="Tên"
                            />
                            <bolt-input
                                id="name"
                                v-model="productDetailsForm.name"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="productDetailsForm.errors.name"
                                class="mt-2"
                            />
                        </div>

                        <!-- Image -->
                        <div class="col-span-6 lg:col-span-4">
                            <bolt-label
                                for="image"
                                value="Link ảnh"
                            />
                            <bolt-input
                                id="image"
                                v-model="productDetailsForm.image"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="productDetailsForm.errors.image"
                                class="mt-2"
                            />
                        </div>

                        <!-- Url -->
                        <div class="col-span-6 lg:col-span-4">
                            <bolt-label
                                for="url"
                                value="Link bán"
                            />
                            <bolt-input
                                id="url"
                                v-model="productDetailsForm.url"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="productDetailsForm.errors.url"
                                class="mt-2"
                            />
                        </div>

                        <div class="col-span-6 lg:col-span-4">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Price -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="price"
                                        value="Đơn giá"
                                    />

                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">
                                                {{ product.order.currency_code }}
                                            </span>
                                        </div>
                                        <bolt-input
                                            id="price"
                                            v-model="productDetailsForm.price"
                                            type="number"
                                            min="1"
                                            step="any"
                                            class="mt-1 pl-11 block w-full"
                                        />
                                    </div>
                                    <bolt-input-error
                                        :message="productDetailsForm.errors.price"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Số lượng -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="quantity"
                                        value="Số lượng"
                                    />
                                    <bolt-input
                                        id="quantity"
                                        v-model="productDetailsForm.quantity"
                                        type="number"
                                        min="1"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="productDetailsForm.errors.quantity"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="productDetailsForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Đã lưu.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': productDetailsForm.processing }"
                            :disabled="productDetailsForm.processing"
                        >
                            Lưu lại
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <bolt-section-border />

                <!-- Tax and Fee -->
                <bolt-form-section
                    class="mt-10 sm:mt-0"
                    @submitted="createProductCharge"
                >
                    <template #title>
                        Chi phí
                    </template>

                    <template #description>
                        Thêm thuế hoặc phụ phí cho sản phẩm.
                    </template>

                    <template #form>
                        <div class="col-span-6 lg:col-span-4">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Type -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="charge_id"
                                        value="Loại hình"
                                    />
                                    <select
                                        id="charge_id"
                                        v-model="productChargeForm.charge_id"
                                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        @change="populateChargeFields"
                                    >
                                        <option
                                            value="null"
                                            disabled
                                        >
                                            Vui lòng chọn
                                        </option>
                                        <option
                                            v-for="charge in charges"
                                            :key="charge.id"
                                            :value="charge.id"
                                        >
                                            {{ charge.name }}
                                        </option>
                                    </select>
                                    <bolt-input-error
                                        :message="productChargeForm.errors.type"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Value -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="tax_value"
                                        value="Giá trị"
                                    />
                                    <bolt-input
                                        id="tax_value"
                                        v-model="productChargeForm.value"
                                        type="number"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="productChargeForm.errors.value"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-span-6 lg:col-span-4">
                            <bolt-label
                                for="tax_description"
                                value="Mô tả"
                            />
                            <bolt-input
                                id="tax_description"
                                v-model="productChargeForm.description"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="productChargeForm.errors.description"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="productChargeForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Đã lưu.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': productChargeForm.processing }"
                            :disabled="productChargeForm.processing"
                        >
                            Lưu lại
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <!-- Manage Taxes -->
                <div v-if="product.charges.length > 0">
                    <bolt-section-border />

                    <bolt-action-section>
                        <template #title>
                            Quản lý chi phí
                        </template>

                        <template #description>
                            Quản lý các chi phí đã áp dụng cho sản phẩm.
                        </template>

                        <template #content>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="align-middle inline-block min-w-full">
                                        <div class="shadow overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Loại
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Tên
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Áp dụng
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Giá trị
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Thành tiền
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="relative px-2 py-3"
                                                        >
                                                            <span class="sr-only">Thao tác</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr v-for="charge in product.charges">
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ chargeTypes[charge.type] }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ charge.name }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ charge.target }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                                            <span v-if="charge.method === 'percent'">{{ charge.value }}%</span>
                                                            <span v-else>{{ currencyFilter(charge.value, product.order.currency_code) }}</span>
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                                            {{ currencyFilter(calculateTaxRow(product, charge), product.order.currency_code) }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                            <inertia-link
                                                                method="delete"
                                                                :href="route('admin.products.charges.destroy', [product, charge])"
                                                                class="text-indigo-600 hover:text-indigo-900"
                                                            >
                                                                Xóa
                                                            </inertia-link>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </bolt-action-section>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltActionSection from "@/Components/ActionSection";
    import BoltFormSection from "@/Components/FormSection";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltSectionBorder from "@/Components/SectionBorder";
    import BoltActionMessage from "@/Components/ActionMessage";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import currencyFilter from "@/Filters/currency";
    export default {
        name: "Edit",
        components: {AdminLayout, BoltActionSection, BoltFormSection, BoltLabel, BoltInput, BoltInputError, BoltSectionBorder, BoltActionMessage, BoltPrimaryButton},
        props: ['product', 'charges', 'chargeTypes'],
        data() {
            return {
                productDetailsForm: this.$inertia.form({
                    name: this.product.name,
                    options: this.product.options,
                    image: this.product.image,
                    url: this.product.url,
                    quantity: this.product.quantity,
                    price: this.product.price,
                    note: this.product.note,
                }),
                productChargeForm: this.$inertia.form({
                    charge_id: null,
                    value: null,
                    description: null,
                }),
            };
        },
        methods: {
            currencyFilter,
            updateProductDetails() {
                return this.productDetailsForm.put(route('admin.products.update', this.product), {
                    preserveScroll: true,
                });
            },
            populateChargeFields() {
                let charge = this.charges.find(charge => charge.id === this.productChargeForm.charge_id);

                return this.productChargeForm = {...this.productChargeForm, value: charge.value, description: charge.description};
            },
            createProductCharge() {
                return this.productChargeForm.post(route('admin.products.charges.store', this.product), {
                    preserveScroll: true,
                });
            },
            calculateTaxRow(product, charge) {
                let price = 0;
                if (charge.method === 'fixed') {
                    switch (charge.target) {
                        case 'quantity':
                            price = product.quantity * charge.value;
                            break;
                        case 'price':
                            price = product.price + charge.value;
                            break;
                        case 'subtotal':
                            price = product.subtotal + charge.value;
                            break;
                    }
                } else {
                    switch (charge.target) {
                        case 'quantity':
                            price = product.quantity * charge.value / 100;
                            break;
                        case 'price':
                            price = product.price * charge.value / 100;
                            break;
                        case 'subtotal':
                            price = product.subtotal * charge.value / 100;
                            break;
                    }
                }

                return price.toFixed(2);
            },
        },
    };
</script>

<style scoped>

</style>
