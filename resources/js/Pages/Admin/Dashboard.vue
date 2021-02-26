<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h1>
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

                <!-- Recent orders -->
                <div class="mt-8">
                    <bolt-section-title>
                        <template #title>
                            Recent orders
                        </template>
                    </bolt-section-title>
                </div>

                <div class="mt-2 overflow-hidden shadow sm:rounded-lg">
                    <div class="relative">
                        <div
                            v-if="recentOrders.length > 0"
                            class="overflow-hidden overflow-x-auto relative"
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
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltSectionTitle from "@/Components/SectionTitle";
    import dateFilter from "@/Filters/date";

    export default {
        name: "Dashboard",
        components: {AdminLayout, BoltSectionTitle},
        props: ['last30DaysUsersCount', 'totalUsersCount', 'last30DaysOrdersCount', 'totalOrdersCount', 'recentOrders', 'totalProductsCount', 'last30DaysProductsCount'],
        methods: {
            dateFilter,
        },
    };
</script>
