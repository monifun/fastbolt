<template>
    <user-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <!-- Profile -->
                    <div class="flex items-center">
                        <svg
                            class="h-16 w-16 fill-current text-gray-400 rounded-full bg-gray-200 p-0.5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        <div>
                            <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                                Xin chào, {{ $page.props.auth.user.name }}
                            </h1>
                            <dl class="mt-1 ml-3 flex flex-row flex-wrap">
                                <dt class="sr-only">
                                    Số dư ví
                                </dt>
                                <dd class="flex items-center text-sm text-gray-500 font-medium mr-6">
                                    <svg
                                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-indigo-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>
                                    {{ currencyFilter($page.props.auth.user.wallet_balance) }}
                                </dd>
                                <dt class="sr-only">
                                    Trạng thái email
                                </dt>
                                <dd class="flex items-center text-sm text-gray-500 font-medium mr-6">
                                    <svg
                                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                                        />
                                    </svg>
                                    Đã xác thực
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg leading-6 font-medium text-gray-900">
                    Tổng quan
                </h2>

                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Orders -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: outline/clipboard-list -->
                                    <svg
                                        class="h-6 w-6 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Đơn hàng
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ orders_count }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: outline/refresh -->
                                    <svg
                                        class="h-6 w-6 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Giao dịch
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ transactions_count }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipments -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: outline/truck -->
                                    <svg
                                        class="h-6 w-6 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            fill="#fff"
                                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Vận đơn
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ shipments_count }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: outline/chat-alt-2 -->
                                    <svg
                                        class="h-6 w-6 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Bình luận
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                0
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-lg leading-6 font-medium text-gray-900">
                    Đơn hàng gần đây
                </h2>
                <div class="mt-2 overflow-hidden shadow sm:rounded-lg">
                    <div class="relative">
                        <div class="overflow-hidden overflow-x-auto relative">
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
                                            Products
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
                                        v-for="order in recent_orders"
                                        :key="order.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('user.orders.show', order.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ order.id }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('user.orders.show', order.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                <div class="flex flex-shrink-0 -space-x-1">
                                                    <img
                                                        v-for="product in order.products.slice(0, 3)"
                                                        :key="product.id"
                                                        class="max-w-none h-6 w-6 rounded-full ring-2 ring-white"
                                                        :src="product.image"
                                                        :alt="product.name"
                                                    >
                                                </div>

                                                <span
                                                    v-if="order.products.length > 3"
                                                    class="flex-shrink-0 text-xs leading-5 font-medium"
                                                >
                                                    +{{ order.products.length - 3 }}
                                                </span>
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('user.orders.show', order.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ order.status.description }}
                                            </inertia-link>
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <inertia-link
                                                :href="route('user.orders.show', order.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(order.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Dashboard",
        components: {UserLayout},
        props: ['orders_count', 'transactions_count', 'shipments_count', 'recent_orders'],
        methods: {
            currencyFilter,
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
