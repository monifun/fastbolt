<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Dashboard
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Statistics -->
                <div>
                    <bolt-section-title>
                        <template #title>
                            Last 30 days
                        </template>
                    </bolt-section-title>
                    <dl class="mt-2 grid grid-cols-1 sm:rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
                        <div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">
                                    Users
                                </dt>
                                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ last30DaysUsersCount }}
                                        <span class="ml-2 text-sm font-medium text-gray-500">
                                            in total of {{ totalUsersCount }} users
                                        </span>
                                    </div>
                                </dd>
                            </div>
                        </div>

                        <div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">
                                    Orders
                                </dt>
                                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ last30DaysOrdersCount }}
                                        <span class="ml-2 text-sm font-medium text-gray-500">
                                            in total of {{ totalOrdersCount }} orders
                                        </span>
                                    </div>
                                </dd>
                            </div>
                        </div>

                        <div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">
                                    Products
                                </dt>
                                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ totalProductsCount }}
                                        <span class="ml-2 text-sm font-medium text-gray-500">
                                            in total of {{ last30DaysProductsCount }} products
                                        </span>
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </dl>
                </div>

                <div class="mt-8">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-1 flex flex-col">
                            <bolt-card class="flex-1">
                                <template #title>
                                    Top markets
                                </template>
                                <template #content>
                                    <ul class="divide-y divide-gray-200 -mx-4 sm:-mx-6 -my-5">
                                        <li v-for="(market, index) in topMarkets">
                                            <a
                                                href="#"
                                                class="block hover:bg-gray-50"
                                            >
                                                <div class="flex items-center px-4 py-4 sm:px-6">
                                                    <div class="min-w-0 flex-1 flex items-center">
                                                        <div
                                                            class="flex items-center justify-center rounded-full p-1 h-10 w-10 bg-gray-300 text-white"
                                                            :class="{'bg-indigo-600': index === 0, 'bg-indigo-500': index === 1 , 'bg-indigo-400': index === 2}"
                                                        >
                                                            {{ index + 1 }}
                                                        </div>
                                                        <div class="min-w-0 flex-1 px-4">
                                                            <div>
                                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                                    {{ market.name }}
                                                                </p>
                                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                    với {{ market.orders_count }} đơn hàng được tạo.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </bolt-card>
                        </div>

                        <div class="col-span-3 sm:col-span-2 flex flex-col">
                            <!-- Recent orders -->
                            <bolt-card class="flex-1">
                                <template #title>
                                    Recent orders
                                </template>
                                <template #content>
                                    <div class="relative -mx-4 -my-5 sm:-mx-6">
                                        <div
                                            v-if="recentOrders.length > 0"
                                            class="overflow-hidden overflow-x-auto overflow-y-scroll relative"
                                        >
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                        >
                                                            ID
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                        >
                                                            User
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                        >
                                                            Status
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                        >
                                                            Created
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr
                                                        v-for="order in recentOrders"
                                                        :key="order.id"
                                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                                    >
                                                        <td class="whitespace-nowrap">
                                                            <inertia-link
                                                                :href="route('admin.orders.show', order.id)"
                                                                class="px-6 py-4 flex items-center"
                                                            >
                                                                {{ order.id }}
                                                            </inertia-link>
                                                        </td>
                                                        <td class="whitespace-nowrap">
                                                            <inertia-link
                                                                :href="route('admin.orders.show', order.id)"
                                                                class="px-6 py-4 flex items-center"
                                                            >
                                                                {{ order.user.name }}
                                                            </inertia-link>
                                                        </td>
                                                        <td class="whitespace-nowrap">
                                                            <inertia-link
                                                                :href="route('admin.orders.show', order.id)"
                                                                class="px-6 py-4 flex items-center"
                                                            >
                                                                {{ order.status.description }}
                                                            </inertia-link>
                                                        </td>
                                                        <td class="text-right whitespace-nowrap">
                                                            <inertia-link
                                                                :href="route('admin.orders.show', order.id)"
                                                                class="px-6 py-4 flex items-center justify-end"
                                                            >
                                                                {{ dateFilter(order.created_at) }}
                                                            </inertia-link>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div
                                            v-else
                                            class="p-4 bg-white"
                                        >
                                            No records to display
                                        </div>
                                    </div>
                                </template>
                            </bolt-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltSectionTitle from "@/Components/SectionTitle";
    import BoltCard from "@/Components/Card";
    import dateFilter from "@/Filters/date";

    export default {
        name: "Dashboard",
        components: {AdminLayout, BoltSectionTitle, BoltCard},
        props: ['last30DaysUsersCount', 'totalUsersCount', 'last30DaysOrdersCount', 'totalOrdersCount', 'recentOrders', 'totalProductsCount', 'last30DaysProductsCount', 'topMarkets'],
        methods: {
            dateFilter,
        },
    };
</script>
