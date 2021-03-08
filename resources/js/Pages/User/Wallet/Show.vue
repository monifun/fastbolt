<template>
    <user-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Ví điện tử
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Overview -->
                <bolt-section-title>
                    <template #title>
                        Tổng quan
                    </template>
                </bolt-section-title>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: outline/scale -->
                                    <svg
                                        class="h-6 w-6 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Số dư
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ currencyFilter(wallet.balance) }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent activity -->
                <bolt-section-title class="mt-8">
                    <template #title>
                        Giao dịch gần đây
                    </template>
                </bolt-section-title>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Loại
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Số tiền
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thời gian
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="transaction in transactions.data"
                                    :key="transaction.id"
                                    class="bg-white"
                                >
                                    <td class="max-w-0 px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ transaction.type.description }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500 tabular-nums">
                                        <span class="text-gray-900 font-medium">
                                            {{ currencyFilter(transaction.amount) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500 tabular-nums">
                                        {{ dateFilter(transaction.created_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="transactions.from"
                            :to="transactions.to"
                            :total="transactions.total"
                            :prev-page-url="transactions.prev_page_url"
                            :next-page-url="transactions.next_page_url"
                        />
                    </div>
                </div>
            </div>
        </div>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
    import BoltSectionTitle from "@/Components/SectionTitle";
    import BoltPaginationSimple from "@/Components/PaginationSimple";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";

    export default {
        name: "Show",
        components: {UserLayout, BoltSectionTitle, BoltPaginationSimple},
        props: ['wallet', 'transactions'],
        methods: {
            currencyFilter,
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
