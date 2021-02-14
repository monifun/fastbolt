<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Order details
            </h1>
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
                                                SL
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Đơn giá
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Tiền hàng
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                            >
                                                Phụ phí
                                            </th>
                                            <th
                                                scope="col"
                                                class="relative px-6 py-3"
                                            >
                                                <span class="sr-only">Sửa</span>
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
                                                                    v-for="option in product.options"
                                                                    :key="option.label"
                                                                    class="inline"
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
                                                    {{ product.price | currency(order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ product.price * order.currency_rate | currency() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right tabular-nums whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ product.subtotal | currency(order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ product.subtotal * order.currency_rate | currency() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right tabular-nums whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ product.charge_total | currency(order.currency_code) }}
                                                </div>
                                                <div class="text-sm text-gray-900">
                                                    {{ product.charge_total * order.currency_rate | currency() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a
                                                    :href="route('admin.products.edit', product)"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Sửa
                                                </a>
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
                                                    {{ new Date(order.created_at) | date }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Last update
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ new Date(order.updated_at) | date }}
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
                                                    Tiền hàng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ orderSubtotal * order.currency_rate | currency }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Phụ phí
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ orderChargeTotal * order.currency_rate | currency }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tổng cộng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ orderGrandTotal * order.currency_rate | currency }}
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
            updateOrderStatus() {
                return this.updateOrderStatusForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
        },
    };
</script>
