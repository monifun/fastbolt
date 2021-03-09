<template>
    <user-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Tạo đơn hàng
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-5 gap-6">
                    <div class="col-span-5 lg:col-span-3">
                        <!-- Product form -->
                        <bolt-card>
                            <template #title>
                                Sản phẩm
                            </template>

                            <template #content>
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Market -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <bolt-label
                                            for="market"
                                            value="Thị trường"
                                        />
                                        <select
                                            id="market"
                                            v-model="newOrderForm.market_id"
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            :disabled="newOrderForm.products.length > 0"
                                            :class="{'bg-gray-100 cursor-not-allowed': newOrderForm.products.length > 0}"
                                        >
                                            <option
                                                v-for="market in markets"
                                                :key="market.id"
                                                :value="market.id"
                                            >
                                                {{ market.name }}
                                            </option>
                                        </select>
                                        <bolt-input-error
                                            :message="addProductForm.errors.market_id"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Name -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <bolt-label
                                            for="name"
                                            value="Tên sản phẩm"
                                        />
                                        <bolt-input
                                            id="name"
                                            v-model="addProductForm.name"
                                            type="text"
                                            class="block w-full"
                                            autocomplete="off"
                                        />
                                        <bolt-input-error
                                            :message="addProductForm.errors.name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <!-- Sale link -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <bolt-label
                                            for="url"
                                            value="Link bán"
                                        />
                                        <bolt-input
                                            id="url"
                                            v-model="addProductForm.url"
                                            type="text"
                                            autocomplete="off"
                                            class="block w-full"
                                        />
                                    </div>

                                    <!-- Image url -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <bolt-label
                                            for="image"
                                            value="Link ảnh"
                                        />
                                        <bolt-input
                                            id="image"
                                            v-model="addProductForm.image"
                                            type="text"
                                            autocomplete="off"
                                            class="block w-full"
                                        />
                                    </div>

                                    <!-- Options -->
                                    <div
                                        v-for="(option, index) in addProductForm.options"
                                        class="col-span-6"
                                    >
                                        <div class="grid grid-cols-6 gap-6 items-end">
                                            <div class="col-span-5 lg:col-span-4">
                                                <fieldset>
                                                    <legend class="block text-sm font-medium text-gray-700">
                                                        Thuộc tính
                                                    </legend>
                                                    <div class="mt-1 bg-white rounded-md shadow-sm -space-y-px">
                                                        <div class="flex -space-x-px">
                                                            <div class="w-1/2 flex-1 min-w-0">
                                                                <label
                                                                    :for="`option-label-${index}`"
                                                                    class="sr-only"
                                                                >
                                                                    Nhãn
                                                                </label>
                                                                <input
                                                                    :id="`option-label-${index}`"
                                                                    v-model="option.label"
                                                                    type="text"
                                                                    class="focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none rounded-bl-md rounded-tl-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                                                >
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <label
                                                                    :for="`option-value-${index}`"
                                                                    class="sr-only"
                                                                >
                                                                    Giá trị
                                                                </label>
                                                                <input
                                                                    :id="`option-value-${index}`"
                                                                    v-model="option.value"
                                                                    type="text"
                                                                    class="focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-none rounded-br-md rounded-tr-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-span-1 lg:col-span-2 pb-1">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                    @click="removeProductOption(index)"
                                                >
                                                    <!-- Heroicon name: solid/minus -->
                                                    <svg
                                                        class="h-5 w-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <div
                                            class="col-span-6"
                                        >
                                            <bolt-secondary-button @click="addProductOption">
                                                Thêm thuộc tính
                                            </bolt-secondary-button>
                                        </div>
                                    </div>

                                    <!-- Price and Quantity -->
                                    <div class="col-span-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                                <bolt-label
                                                    for="price"
                                                    :value="`Đơn giá (${productCurrency['currency_code']})`"
                                                />
                                                <bolt-input
                                                    id="price"
                                                    v-model="addProductForm.price"
                                                    type="number"
                                                    placeholder="0.00"
                                                    class="block w-full"
                                                    autocomplete="off"
                                                />
                                                <bolt-input-error
                                                    :message="addProductForm.errors.price"
                                                    class="mt-2"
                                                />
                                            </div>

                                            <div class="col-span-6 sm:col-span-2 lg:col-span-2">
                                                <bolt-label
                                                    for="quantity"
                                                    value="Số lượng"
                                                />
                                                <bolt-input
                                                    id="quantity"
                                                    v-model="addProductForm.quantity"
                                                    type="number"
                                                    min="1"
                                                    placeholder="0"
                                                    class="block w-full"
                                                    autocomplete="off"
                                                />
                                                <bolt-input-error
                                                    :message="addProductForm.errors.quantity"
                                                    class="mt-2"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Note -->
                                    <div class="col-span-6 lg:col-span-4">
                                        <bolt-label
                                            for="note"
                                            value="Ghi chú"
                                        />
                                        <bolt-input
                                            id="note"
                                            v-model="addProductForm.note"
                                            type="text"
                                            class="block w-full"
                                        />
                                    </div>
                                </div>
                            </template>

                            <template #footer>
                                <div class="text-right">
                                    <bolt-secondary-button @click="addProduct">
                                        Thêm vào giỏ hàng
                                    </bolt-secondary-button>
                                </div>
                            </template>
                        </bolt-card>
                    </div>
                    <div class="col-span-5 lg:col-span-2">
                        <!-- Shopping cart -->
                        <bolt-card>
                            <template #title>
                                Giỏ hàng
                            </template>

                            <template #actions>
                                <button
                                    v-if="newOrderForm.products.length > 0"
                                    class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    aria-label="Hủy giỏ hàng"
                                    @click="clearCart"
                                >
                                    <!-- Heroicon name: solid/plus -->
                                    <svg
                                        class="w-3 h-3"
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
                                <div class="-mx-4 -my-5 sm:-mx-6 max-h-96 overflow-y-scroll">
                                    <ul
                                        v-if="newOrderForm.products.length > 0"
                                        class="divide-y divide-gray-200"
                                    >
                                        <li
                                            v-for="(product, index) in newOrderForm.products.slice().reverse()"
                                            class="px-4 py-4 sm:px-6"
                                        >
                                            <div class="flex items-center justify-between">
                                                <div class="min-w-0 flex-1 flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <img
                                                            v-if="product.image"
                                                            class="h-12 w-12 rounded"
                                                            :src="product.image"
                                                            alt="image"
                                                        >
                                                        <div
                                                            v-else
                                                            class="w-12 h-12 rounded bg-gray-200"
                                                        />
                                                    </div>
                                                    <div class="min-w-0 flex-1 pl-2">
                                                        <div>
                                                            <!-- Name -->
                                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                                <a
                                                                    :href="product.url"
                                                                    class="hover:underline"
                                                                    target="_blank"
                                                                >
                                                                    {{ product.name }}
                                                                </a>
                                                            </p>

                                                            <!-- Options -->
                                                            <ul
                                                                v-if="product.options.length > 0"
                                                                class="mt-1 list-none text-sm text-gray-500"
                                                            >
                                                                <li
                                                                    v-for="(option, index) in product.options"
                                                                    class="inline"
                                                                    :class="{'ml-1': index > 0}"
                                                                >
                                                                    {{ option.label }}: {{ option.value }}
                                                                </li>
                                                            </ul>

                                                            <!-- Price and Quantity -->
                                                            <ul class="mt-1 list-none text-sm text-gray-700">
                                                                <li class="inline">
                                                                    Giá: <span class="font-semibold">{{ currencyFilter(product.price, 'CNY') }}</span>
                                                                </li>
                                                                <li class="inline ml-3">
                                                                    Số lượng: <span class="font-semibold">{{ product.quantity }}</span>
                                                                </li>
                                                            </ul>

                                                            <!-- Note -->
                                                            <p
                                                                v-if="product.note"
                                                                class="mt-1 flex items-center text-sm text-gray-500"
                                                            >
                                                                <svg
                                                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="currentColor"
                                                                >
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                                                    />
                                                                </svg>
                                                                <span class="truncate">{{ product.note }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button
                                                        type="button"
                                                        class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                        aria-label="Xóa khỏi giỏ"
                                                        @click="removeCartItem(index)"
                                                    >
                                                        <!-- Heroicon name: solid/plus -->
                                                        <svg
                                                            class="w-3 h-3"
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
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <p
                                        v-else
                                        class="px-4 py-5 sm:px-6"
                                    >
                                        Chưa có sản phẩm trong giỏ.
                                    </p>
                                </div>
                            </template>
                        </bolt-card>

                        <!-- Shipping address -->
                        <bolt-card class="mt-6">
                            <template #title>
                                Địa chỉ
                            </template>

                            <template #content>
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="col-span-2 lg:col-span-1">
                                        <bolt-label
                                            for="shipping_name"
                                            value="Họ và Tên"
                                        />
                                        <bolt-input
                                            id="shipping_name"
                                            v-model="newOrderForm.shipping_name"
                                            type="text"
                                            class="block w-full"
                                            :placeholder="$page.props.auth.user.name"
                                        />
                                        <bolt-input-error
                                            :message="newOrderForm.errors.shipping_name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-2 lg:col-span-1">
                                        <bolt-label
                                            for="shipping_phone"
                                            value="Điện thoại"
                                        />
                                        <bolt-input
                                            id="shipping_phone"
                                            v-model="newOrderForm.shipping_phone"
                                            type="text"
                                            class="block w-full"
                                            :placeholder="$page.props.auth.user.phone"
                                        />
                                        <bolt-input-error
                                            :message="newOrderForm.errors.shipping_phone"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-2">
                                        <bolt-label
                                            for="shipping_address"
                                            value="Địa chỉ"
                                        />
                                        <bolt-input
                                            id="shipping_address"
                                            v-model="newOrderForm.shipping_address"
                                            type="text"
                                            class="block w-full"
                                        />
                                        <bolt-input-error
                                            :message="newOrderForm.errors.shipping_address"
                                            class="mt-2"
                                        />
                                    </div>
                                </div>
                            </template>

                            <template #footer>
                                <div class="text-center">
                                    <bolt-primary-button
                                        class="w-full justify-center"
                                        :class="{'opacity-25 cursor-not-allowed': newOrderForm.products.length < 1}"
                                        :disabled="newOrderForm.products.length < 1"
                                        @click="placeOrder"
                                    >
                                        Tạo đơn hàng
                                    </bolt-primary-button>
                                </div>
                            </template>
                        </bolt-card>
                    </div>
                </div>
            </div>
        </div>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
    import BoltCard from "@/Components/Card";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltLabel from "@/Components/Label";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import currencyFilter from "@/Filters/currency";
    export default {
        name: "Create",
        components: {UserLayout, BoltCard, BoltInput, BoltInputError, BoltLabel, BoltPrimaryButton, BoltSecondaryButton},
        props: ['markets'],
        data() {
            return {
                addProductForm: {
                    name: null,
                    image: null,
                    url: null,
                    options: [],
                    price: null,
                    quantity: null,
                    note: null,
                    errors: {},
                },
                newOrderForm: this.$inertia.form({
                    market_id: this.markets[0].id,
                    shipping_name: null,
                    shipping_phone: null,
                    shipping_address: null,
                    products: [],
                }),
            };
        },
        computed: {
            productCurrency() {
                return this.markets.find(market => market.id === this.newOrderForm.market_id);
            },
        },
        methods: {
            currencyFilter,
            addProductOption() {
                this.addProductForm.options.push({...{value: null, label: null}});
            },
            removeProductOption(index) {
                this.addProductForm.options.splice(index, 1);
            },
            validateProduct() {
                if (this.addProductForm.name && this.addProductForm.price && this.addProductForm.quantity) {
                    return true;
                }

                if (!this.newOrderForm.market_id) {
                    this.addProductForm.errors.market_id = 'The market field is required.';
                }

                if (!this.addProductForm.name) {
                    this.addProductForm.errors.name = 'The name field is required.';
                }

                if(!this.addProductForm.price) {
                    this.addProductForm.errors.price = 'The price field is required.';
                }

                if(!this.addProductForm.quantity) {
                    this.addProductForm.errors.quantity = 'The quantity field is required.';
                }

                return false;
            },
            addProduct() {
                if(! this.validateProduct()) return;
                // remove null option
                this.addProductForm.options.forEach((option, index) => (option.label == null || option.value == null) && this.addProductForm.options.splice(index, 1));
                // push product to the order form
                this.newOrderForm.products.push({...this.addProductForm});
                // clean product form
                this.addProductForm.name = null;
                this.addProductForm.image = null;
                this.addProductForm.url = null;
                this.addProductForm.options = [];
                this.addProductForm.price = null;
                this.addProductForm.quantity = null;
                this.addProductForm.note = null;
                this.addProductForm.errors = {};
            },
            removeCartItem(index) {
                this.newOrderForm.products.splice(index, 1);
            },
            clearCart() {
                return this.newOrderForm.products = [];
            },
            placeOrder() {
                return this.newOrderForm.post(route('user.orders.store'));
            },
        },
    };
</script>

<style scoped>

</style>
