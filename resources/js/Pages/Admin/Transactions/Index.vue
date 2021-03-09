<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Giao dịch
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <div class="relative">
                        <div class="overflow-hidden overflow-x-auto relative">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            ID
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Người dùng
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Hình thức
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Số tiền
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Thời gian
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="transaction in transactions.data"
                                        :key="transaction.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.transactions.show', transaction.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ transaction.id }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.transactions.show', transaction.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ transaction.wallet.ownable.name }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.transactions.show', transaction.id)"
                                                class="px-6 py-4 flex items-center justify-center"
                                            >
                                                {{ transaction.type.description }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.transactions.show', transaction.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ currencyFilter(transaction.amount) }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.transactions.show', transaction.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(transaction.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltPaginationSimple from "@/Components/PaginationSimple";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Index",
        components: {AdminLayout, BoltPaginationSimple},
        props: ['transactions'],
        methods: {
            currencyFilter,
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
