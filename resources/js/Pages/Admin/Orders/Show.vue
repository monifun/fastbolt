<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Order #{{ order.id }}
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.orders.edit', order.id)"
                        class="inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Edit
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-6">
                    <!-- Products -->
                    <div class="col-span-3 lg:col-span-2">
                        <div class="col-span-3 lg:col-span-2">
                            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                    <h2 class="text-lg leading-6 font-medium text-gray-900">
                                        Products
                                    </h2>
                                </div>
                                <div class="overflow-hidden overflow-x-auto relative">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                />
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Qty
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Price
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Subtotal
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Fees
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Total
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr
                                                v-for="product in order.products"
                                                :key="product.id"
                                                class="bg-white"
                                            >
                                                <td class="px-6 py-4 whitespace-nowrap">
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
                                                                class="text-sm text-gray-900"
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
                                                                v-if="product.note"
                                                                class="text-sm text-gray-500 whitespace-normal"
                                                            >
                                                                {{ product.note }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                    {{ product.quantity }}
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
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                    <div class="text-sm text-gray-500">
                                                        {{ currencyFilter(product.charge_total, order.currency_code) }}
                                                    </div>
                                                    <div class="text-sm text-gray-900">
                                                        {{ currencyFilter(product.charge_total * order.currency_rate) }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                    <div class="text-sm text-gray-500">
                                                        {{ currencyFilter(product.grand_total, order.currency_code) }}
                                                    </div>
                                                    <div class="text-sm text-gray-900">
                                                        {{ currencyFilter(product.grand_total * order.currency_rate) }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 tabular-nums">
                                                    <inertia-link
                                                        :href="route('admin.products.edit', product.id)"
                                                        class="hover:text-indigo-600 transition ease-in-out duration-150"
                                                    >
                                                        Edit
                                                    </inertia-link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-3 lg:col-span-1">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- General -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        General
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="col-span-2">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Status
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    <select
                                                        id="orderStatus"
                                                        v-model="updateOrderStatusForm.status"
                                                        class="appearance-none block w-full p-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                        @change="updateOrderStatus"
                                                    >
                                                        <option
                                                            v-for="(value, key) in orderStatuses"
                                                            :key="key"
                                                            :value="key"
                                                        >
                                                            {{ value }}
                                                        </option>
                                                    </select>
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Order ID
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.id }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Exchange rate
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.currency_rate }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Market
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.vendor.market.name }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Vendor
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.vendor.name }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Created at
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ dateFilter(order.created_at) }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Last update
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ dateFilter(order.updated_at) }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Customer -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Customer
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Name
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_name }}
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Phone
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_phone }}
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Address
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_address }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Payment -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Payment
                                    </template>

                                    <template #actions>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                                            @click="openPaymentModal"
                                        >
                                            add payment
                                        </button>
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4">
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Total product price
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.product_price_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Total product fees
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.product_charge_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Order fees
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.charge_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Order total
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.grand_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Total paid
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.total_paid) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Total due
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.total_due) }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Shipment -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Shipment
                                    </template>

                                    <template #actions>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                                            @click="openNewShipmentModal"
                                        >
                                            add shipment
                                        </button>
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4">
                                            <div v-for="shipment in order.shipments" class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    {{ shipment.id }}
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ shipment.status.description }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <bolt-dialog-model
            :show="addNewPayment"
            :closeable="false"
            @close="addNewPayment = false"
        >
            <template #title>
                Add new payment
            </template>

            <template #content>
                <p>Use user's wallet to pay for this order, current wallet balance is: {{ currencyFilter(order.user.wallet_balance) }}</p>
                <div class="mt-3">
                    <bolt-label
                        for="paymentAmount"
                        :value="'Amount to pay ' + currencyFilter(order.total_due)"
                    />
                    <bolt-input
                        id="paymentAmount"
                        v-model="createPaymentForm.amount"
                        type="number"
                        class="mt-1 block w-full"
                        :placeholder="currencyFilter(order.total_due)"
                        min="1"
                    />
                    <bolt-input-error
                        :message="createPaymentForm.errors.amount"
                        class="mt-2"
                    />
                    <p
                        v-if="createPaymentForm.amount > 0"
                        class="mt-2 text-sm text-gray-500"
                    >
                        You entered: {{ currencyFilter(createPaymentForm.amount) }}
                    </p>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="addNewPayment = false">
                    Cancel
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="createOrderPayment"
                >
                    Save
                </bolt-primary-button>
            </template>
        </bolt-dialog-model>

        <bolt-dialog-model
            :show="addNewShipment"
            :closeable="false"
            @close="addNewShipment = false"
        >
            <template #title>
                Add new shipment
            </template>

            <template #content>
                <!-- Product list -->
                <ul
                    class="block divide-y divide-gray-200"
                    :class="{'max-h-64 overflow-y-scroll': !expandProductInShipment}"
                >
                    <li
                        v-for="product in createShipmentForm.products"
                        :key="product.id"
                        class="py-4"
                    >
                        <div class="flex items-center">
                            <div class="flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="flex items-center">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="product.image"
                                        alt="Product image"
                                    >
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ product.name }}
                                        </p>
                                        <ul class="list-none text-sm text-gray-500">
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
                                </div>
                                <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-4 sm:flex sm:justify-end">
                                    <bolt-input
                                        v-model="product.quantity"
                                        type="text"
                                        class="block w-full sm:w-1/3 text-center"
                                        :placeholder="product.quantity"
                                    />
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- Expand/Collapse product list -->
                <div class="relative">
                    <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                    >
                        <div class="w-full border-t border-gray-300" />
                    </div>
                    <div class="relative flex justify-center">
                        <button
                            type="button"
                            class="inline-flex items-center shadow-sm px-2 py-1 border border-gray-300 text-xs leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
                            @click="toggleProductInShipment"
                        >
                            <span>
                                {{ expandProductInShipment ? 'Thu gọn' : 'Mở rộng' }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Shipment form -->
                <div class="mt-5 grid grid-cols-6 gap-4">
                    <!-- Carrier -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="carrier"
                            value="Carrier"
                        />
                        <bolt-input
                            id="carrier"
                            v-model="createShipmentForm.carrier_name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.carrier_name"
                            class="mt-2"
                        />
                    </div>

                    <!-- Tracking -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="tracking"
                            value="Tracking number"
                        />
                        <bolt-input
                            id="tracking"
                            v-model="createShipmentForm.tracking_number"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.tracking_number"
                            class="mt-2"
                        />
                    </div>

                    <!-- Status -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="shipment_status"
                            value="Status"
                        />
                        <select
                            id="shipment_status"
                            v-model="createShipmentForm.status"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                        >
                            <option
                                v-for="(value, key) in shipmentStatuses"
                                :key="key"
                                :value="key"
                            >
                                {{ value }}
                            </option>
                        </select>
                        <bolt-input-error
                            :message="createShipmentForm.errors.tracking_number"
                            class="mt-2"
                        />
                    </div>

                    <!-- Price -->
                    <div class="col-span-6">
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-2">
                                <bolt-label
                                    for="price"
                                    value="Price"
                                />
                                <bolt-input
                                    id="price"
                                    v-model="createShipmentForm.price"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.price"
                                    class="mt-2"
                                />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <bolt-label
                                    for="shipment_currency_code"
                                    value="Loại tiền"
                                />
                                <select
                                    id="shipment_currency_code"
                                    v-model="createShipmentForm.currency_code"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                >
                                    <option :value="order.currency_code">
                                        {{ order.currency_code }}
                                    </option>
                                    <option value="VND">
                                        VND
                                    </option>
                                </select>
                                <bolt-input-error
                                    :message="createShipmentForm.errors.currency_code"
                                    class="mt-2"
                                />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <bolt-label
                                    for="shipment_currency_rate"
                                    value="Tỷ giá"
                                />
                                <bolt-input
                                    id="shipment_currency_rate"
                                    v-model="createShipmentForm.currency_rate"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.currency_rate"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Dimension -->
                    <div class="col-span-6">
                        <div class="grid grid-cols-8 gap-4">
                            <!-- Weight -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="weight"
                                    value="Trọng lượng (gr)"
                                />
                                <bolt-input
                                    id="weight"
                                    v-model="createShipmentForm.weight"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.weight"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Length -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="length"
                                    value="Chiều dài (cm)"
                                />
                                <bolt-input
                                    id="length"
                                    v-model="createShipmentForm.length"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.length"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Width -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="width"
                                    value="Chiều rộng (cm)"
                                />
                                <bolt-input
                                    id="width"
                                    v-model="createShipmentForm.width"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.width"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Height -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="height"
                                    value="Chiều cao (cm)"
                                />
                                <bolt-input
                                    id="height"
                                    v-model="createShipmentForm.height"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.height"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-span-6">
                        <bolt-label
                            for="note"
                            value="Note"
                        />
                        <bolt-input
                            id="note"
                            v-model="createShipmentForm.note"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.note"
                            class="mt-2"
                        />
                    </div>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="addNewShipment = false">
                    Cancel
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="createNewShipment"
                >
                    Save
                </bolt-primary-button>
            </template>
        </bolt-dialog-model>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltCard from "@/Components/Card";
    import BoltDialogModel from "@/Components/DialogModal";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltLabel from "@/Components/Label";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {AdminLayout, BoltCard, BoltDialogModel, BoltInput, BoltInputError, BoltLabel, BoltPrimaryButton, BoltSecondaryButton},
        props: ['order', 'orderStatuses', 'shipmentStatuses'],
        data() {
            return {
                updateOrderStatusForm: this.$inertia.form({
                    status: this.order.status.value,
                }),
                addNewPayment: false,
                createPaymentForm: this.$inertia.form({
                    type: 'payment',
                    status: 'completed',
                    amount: null,
                }),
                addNewShipment: false,
                createShipmentForm: this.$inertia.form({
                    status: 'pending',
                    carrier_name: null,
                    tracking_number: null,
                    weight: null,
                    length: null,
                    width: null,
                    height: null,
                    price: null,
                    currency_code: this.order.currency_code,
                    currency_rate: this.order.currency_rate,
                    note: null,
                    products: this.order.products,
                }),
                expandProductInShipment: false,
            };
        },
        methods: {
            currencyFilter,
            dateFilter,
            updateOrderStatus() {
                return this.updateOrderStatusForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
            openPaymentModal() {
                return this.addNewPayment = true;
            },
            createOrderPayment() {
                return this.createPaymentForm.post(route('admin.orders.transactions.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.createPaymentForm.reset();
                        this.addNewPayment = false;
                    },
                });
            },
            openNewShipmentModal() {
                return this.addNewShipment = true;
            },
            createNewShipment() {
                return this.createShipmentForm.post(route('admin.orders.shipments.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.createShipmentForm.reset();
                        this.addNewShipment = false;
                    },
                });
            },
            toggleProductInShipment() {
                return this.expandProductInShipment =! this.expandProductInShipment;
            },
        },
    };
</script>
