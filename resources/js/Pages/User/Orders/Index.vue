<template>
    <user-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <bolt-section-title>
                    <template #title>
                        Orders
                    </template>
                </bolt-section-title>
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Products
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="order in orders.data"
                                    :key="order.id"
                                    class="bg-white"
                                >
                                    <td class="max-w-0 px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <inertia-link
                                            :href="route('user.orders.show', order.id)"
                                            class="hover:text-indigo-600 transition ease-in-out duration-150"
                                        >
                                            {{ order.id }}
                                        </inertia-link>
                                    </td>
                                    <td class="max-w-0 px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center space-x-2">
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
                                        </div>
                                    </td>
                                    <td class="max-w-0 px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ order.status.description }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500 tabular-nums">
                                        {{ dateFilter(order.created_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="orders.from"
                            :to="orders.to"
                            :total="orders.total"
                            :prev-page-url="orders.prev_page_url"
                            :next-page-url="orders.next_page_url"
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
    import dateFilter from "@/Filters/date";
    export default {
        name: "Index",
        components: {UserLayout, BoltSectionTitle, BoltPaginationSimple},
        props: ['orders'],
        methods: {
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
