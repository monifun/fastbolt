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
                    <div class="col-span-3 lg:col-span-2">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <div class="overflow-x-auto relative">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            />
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Qty
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Price
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Subtotal
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Fees
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
                                            v-for="product in order.products"
                                            class="hover:bg-gray-100"
                                        >
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img
                                                            class="h-10 w-10 rounded-full"
                                                            :src="product.image"
                                                            :alt="product.name"
                                                        >
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
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
                                            <td class="px-6 py-4 text-center tabular-nums whitespace-nowrap">
                                                {{ product.quantity }}
                                            </td>
                                            <td class="px-6 py-4 text-right tabular-nums whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ currencyFilter(product.price, order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ currencyFilter(product.price * order.currency_rate) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right tabular-nums whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ currencyFilter(product.subtotal, order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ currencyFilter(product.subtotal * order.currency_rate) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right tabular-nums whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ currencyFilter(product.charge_total, order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ currencyFilter(product.charge_total * order.currency_rate) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <inertia-link
                                                    :href="route('admin.products.edit', product)"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Edit
                                                </inertia-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <bolt-card class="mt-6">
                            <template #title>
                                Discuss
                            </template>

                            <template #content>
                                content goes here
                            </template>
                        </bolt-card>
                    </div>

                    <div class="col-span-3 lg:col-span-1">
                        <div class="grid grid-cols-2 gap-6">
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

                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Customer details
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

                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Payment
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4">
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Subtotal
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(orderSubtotal * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Fees
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(orderChargeTotal * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Grandtotal
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(orderGrandTotal * order.currency_rate) }}
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
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltCard from "@/Components/Card";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {AdminLayout, BoltCard},
        props: ['order', 'orderStatuses'],
        data() {
            return {
                updateOrderStatusForm: this.$inertia.form({
                    status: this.order.status.value,
                }),
            };
        },
        computed: {
            orderSubtotal() {
                return this.order.products.reduce((total, product) => {
                    return total + product.price * product.quantity;
                }, 0);
            },
            orderChargeTotal() {
                return this.order.products.reduce((total, product) => {
                    return total + product.charge_total;
                }, 0);
            },
            orderGrandTotal() {
                return this.orderChargeTotal + this.orderSubtotal;
            },
        },
        methods: {
            currencyFilter,
            dateFilter,
            updateOrderStatus() {
                return this.updateOrderStatusForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
