<template>
    <user-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Giỏ hàng
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="orders.length > 0">
                    <bolt-card
                        v-for="order in orders"
                        :key="order.id"
                        class="mt-5"
                    >
                        <template #title>
                            {{ order.vendor.name }}
                        </template>

                        <template #actions>
                            <button
                                type="button"
                                class="inline-flex items-center px-1 py-1 border border-transparent text-xs font-medium rounded text-red-600 bg-red-100 hover:bg-red-200 focus:outline-none"
                                aria-label="xóa"
                                @click="confirmOrderDeletion(order)"
                            >
                                <svg
                                    class="w-3.5 h-3.5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <div class="-mx-4 -my-5 sm:-mx-6 overflow-hidden overflow-x-auto relative">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="w-auto px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            />
                                            <th
                                                scope="col"
                                                class="w-1/6 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Số lượng
                                            </th>
                                            <th
                                                scope="col"
                                                class="w-1/6 px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Đơn giá
                                            </th>
                                            <th
                                                scope="col"
                                                class="w-1/6 px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Thành tiền
                                            </th>
                                            <th
                                                scope="col"
                                                class="w-auto px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                <span class="sr-only">Thao tác</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <tr
                                            v-for="product in order.products"
                                            :key="product.id"
                                            class="bg-white"
                                        >
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-14 w-12">
                                                        <img
                                                            class="h-14 rounded"
                                                            :src="product.image"
                                                            :alt="product.name"
                                                        >
                                                    </div>
                                                    <div class="ml-4 max-w-md">
                                                        <div class="text-sm font-medium text-gray-900 truncate ...">
                                                            <a
                                                                :href="product.url"
                                                                class="hover:underline"
                                                                target="_blank"
                                                            >
                                                                {{ product.name }}
                                                            </a>
                                                        </div>
                                                        <div
                                                            v-if="product.options"
                                                            class="text-sm text-gray-700"
                                                        >
                                                            <ul class="list-none">
                                                                <li
                                                                    v-for="(option, index) in product.options"
                                                                    :key="option.label"
                                                                    class="inline"
                                                                    :class="{'ml-1': index > 0}"
                                                                >
                                                                    {{ option.label }}: {{ option.value }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div
                                                            class="flex text-sm text-gray-500 whitespace-normal cursor-pointer hover:text-gray-900"
                                                            @click="showUpdateProductModal(product)"
                                                        >
                                                            <svg
                                                                class="w-3.5 h-3.5 flex-shrink-0 mt-1 mr-1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20"
                                                                fill="currentColor"
                                                            >
                                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                    clip-rule="evenodd"
                                                                />
                                                            </svg>
                                                            <p>
                                                                {{ product.note ?? 'Ghi chú sản phẩm' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                <bolt-input
                                                    type="number"
                                                    class="w-16 text-center no-spinners"
                                                    inputmode="numeric"
                                                    :value="product.quantity"
                                                    @input="updateProductQuantity(product, $event.target.value)"
                                                />
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                <div class="text-sm text-gray-500">
                                                    {{ currencyFilter(product.price, order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ currencyFilter(product.price * order.currency_rate) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                <div class="text-sm text-gray-500">
                                                    {{ currencyFilter(product.subtotal, order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ currencyFilter(product.subtotal * order.currency_rate) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-1 py-1 border border-transparent text-xs font-medium rounded text-red-600 bg-red-100 hover:bg-red-200 focus:outline-none"
                                                    aria-label="xóa"
                                                    @click="confirmProductDeletion(product)"
                                                >
                                                    <svg
                                                        class="w-3.5 h-3.5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        <template #footer>
                            <div class="flex justify-end">
                                <bolt-secondary-button @click="confirmOrderConfirmation(order)">
                                    Tạo đơn hàng
                                </bolt-secondary-button>
                            </div>
                        </template>
                    </bolt-card>
                </div>

                <div
                    v-else
                    class="sm:max-w-md sm:w-full sm:p-6 mx-auto"
                >
                    <div class="mx-auto flex items-center justify-center">
                        <inline-svg
                            src="/svg/empty_cart.svg"
                            fill="none"
                            aria-label="giỏ hàng trống"
                            class="h-60 w-auto"
                        />
                    </div>

                    <div class="mt-3 text-center sm:mt-5">
                        <p class="text-gray-500">
                            Bạn chưa có sản phẩm nào trong giỏ hàng, vui lòng thêm sản phẩm để tiến hành tạo đơn đặt hàng.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update product information -->
        <bolt-dialog-modal
            max-width="lg"
            :show="productBeingUpdated"
            @close="productBeingUpdated = null"
        >
            <template #title>
                Cập nhật thông tin sản phẩm
            </template>

            <template #content>
                <bolt-label
                    for="content"
                    value="Ghi chú"
                />
                <bolt-textarea
                    id="content"
                    v-model="updateProductInformationForm.note"
                    class="block w-full"
                />
            </template>

            <template #footer>
                <bolt-secondary-button @click="productBeingUpdated = null">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    :class="{ 'opacity-25': updateProductInformationForm.processing }"
                    :disabled="updateProductInformationForm.processing"
                    @click="updateProduct"
                >
                    Xác nhận
                </bolt-primary-button>
            </template>
        </bolt-dialog-modal>

        <!-- Confirm single product deletion -->
        <bolt-confirmation-modal
            max-width="lg"
            :show="productBeingDeleted"
            @close="productBeingDeleted = null"
        >
            <template #title>
                Xóa sản phẩm
            </template>

            <template #content>
                Bạn có chắc chắn xóa sản phẩm này khỏi giỏ hàng?
            </template>

            <template #footer>
                <bolt-secondary-button @click="productBeingDeleted = null">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-danger-button
                    class="ml-2"
                    :class="{ 'opacity-25': deleteProductForm.processing }"
                    :disabled="deleteProductForm.processing"
                    @click="deleteProduct"
                >
                    Xác nhận
                </bolt-danger-button>
            </template>
        </bolt-confirmation-modal>

        <!-- Confirm bulk product deletion (aka delete draft order) -->
        <bolt-confirmation-modal
            max-width="lg"
            :show="orderBeingDeleted"
            @close="orderBeingDeleted = null"
        >
            <template #title>
                Xóa sản phẩm
            </template>

            <template #content>
                Bạn có chắc chắn xóa toàn bộ sản phẩm khỏi giỏ hàng?
            </template>

            <template #footer>
                <bolt-secondary-button @click="orderBeingDeleted = null">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-danger-button
                    class="ml-2"
                    :class="{ 'opacity-25': deleteOrderForm.processing }"
                    :disabled="deleteOrderForm.processing"
                    @click="deleteOrder"
                >
                    Xác nhận
                </bolt-danger-button>
            </template>
        </bolt-confirmation-modal>

        <!-- Confirm order creation -->
        <bolt-dialog-modal
            max-width="lg"
            :show="orderBeingConfirmed"
            @close="orderBeingConfirmed = null; confirmOrderForm.reset(); confirmOrderForm.clearErrors()"
        >
            <template #title>
                Tạo đơn hàng
            </template>

            <template #content>
                <p class="text-gray-500">
                    Vui lòng nhập thông tin yêu cầu để tạo đơn hàng
                </p>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mt-2 sm:col-span-1">
                        <bolt-label
                            for="shipping_name"
                            value="Họ và Tên"
                        />
                        <bolt-input
                            v-model="confirmOrderForm.shipping_name"
                            type="text"
                            class="block w-full"
                        />
                        <bolt-input-error
                            class="mt-2"
                            :message="confirmOrderForm.errors.shipping_name"
                        />
                    </div>
                    <div class="mt-2 sm:col-span-1">
                        <bolt-label
                            for="shipping_phone"
                            value="Điện thoại"
                        />
                        <bolt-input
                            v-model="confirmOrderForm.shipping_phone"
                            type="text"
                            class="block w-full"
                        />
                        <bolt-input-error
                            class="mt-2"
                            :message="confirmOrderForm.errors.shipping_phone"
                        />
                    </div>
                    <div class="mt-2 sm:col-span-2">
                        <bolt-label
                            for="shipping_address"
                            value="Địa chỉ"
                        />
                        <bolt-textarea
                            v-model="confirmOrderForm.shipping_address"
                            class="block w-full"
                        />
                        <bolt-input-error
                            class="mt-2"
                            :message="confirmOrderForm.errors.shipping_address"
                        />
                    </div>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="orderBeingConfirmed = null; confirmOrderForm.reset(); confirmOrderForm.clearErrors()">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    :class="{ 'opacity-25': confirmOrderForm.processing }"
                    :disabled="confirmOrderForm.processing"
                    @click="confirmOrder"
                >
                    Xác nhận
                </bolt-primary-button>
            </template>
        </bolt-dialog-modal>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
    import BoltCard from "@/Components/Card";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltTextarea from "@/Components/Textarea";
    import BoltDialogModal from "@/Components/DialogModal";
    import BoltConfirmationModal from "@/Components/ConfirmationModal";
    import BoltDangerButton from "@/Components/DangerButton";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {
            UserLayout, BoltCard, BoltLabel, BoltInput, BoltInputError, BoltTextarea, BoltDialogModal, BoltConfirmationModal, BoltDangerButton, BoltSecondaryButton, BoltPrimaryButton},
        props: ['orders'],
        data() {
            return {
                updateProductQuantityForm: this.$inertia.form(),
                updateProductInformationForm: this.$inertia.form({
                    note: null,
                }),
                deleteProductForm: this.$inertia.form(),
                deleteOrderForm: this.$inertia.form(),
                confirmOrderForm: this.$inertia.form({
                    shipping_name: this.$page.props.auth.user.name,
                    shipping_phone: this.$page.props.auth.user.phone,
                    shipping_address: this.$page.props.auth.user.address ?? null,
                }),
                productBeingDeleted: null,
                productBeingUpdated: null,
                orderBeingDeleted: null,
                orderBeingConfirmed: null,
            };
        },
        methods: {
            currencyFilter,
            dateFilter,
            updateProductQuantity(product, value) {
                this.updateProductQuantityForm.transform((data) => ({
                    ...data,
                    quantity: value,
                })).put(route('user.cart.products.update', product), {
                    preserveScroll: true,
                });
            },
            showUpdateProductModal(product) {
                this.productBeingUpdated = product;
                this.updateProductInformationForm.note = product.note;
            },
            updateProduct() {
                return this.updateProductInformationForm.put(route('user.cart.products.update', this.productBeingUpdated), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.productBeingUpdated = null;
                        this.updateProductInformationForm.reset();
                    },
                });
            },
            confirmProductDeletion(product) {
                return this.productBeingDeleted = product;
            },
            deleteProduct() {
                return this.deleteProductForm.delete(route('user.cart.products.destroy', this.productBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.productBeingDeleted = null),
                });
            },
            confirmOrderConfirmation(order) {
                return this.orderBeingConfirmed = order;
            },
            confirmOrder() {
                return this.confirmOrderForm.post(route('user.cart.orders.confirm', this.orderBeingConfirmed), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.orderBeingConfirmed = null),
                });
            },
            confirmOrderDeletion(order) {
                return this.orderBeingDeleted = order;
            },
            deleteOrder() {
                return this.deleteProductForm.delete(route('user.cart.orders.destroy', this.orderBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.orderBeingDeleted = null),
                });
            },
        },
    };
</script>

