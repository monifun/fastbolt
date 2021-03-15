<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Vận chuyển
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
                                            Đơn hàng
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Trạng thái
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
                                        v-for="shipment in shipments.data"
                                        :key="shipment.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.shipments.show', shipment.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ shipment.id }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.shipments.show', shipment.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ shipment.order_id }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.shipments.show', shipment.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ shipment.status.description }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.shipments.show', shipment.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(shipment.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="shipments.from"
                            :to="shipments.to"
                            :total="shipments.total"
                            :prev-page-url="shipments.prev_page_url"
                            :next-page-url="shipments.next_page_url"
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
    import dateFilter from "@/Filters/date";
    export default {
        name: "Index",
        components: {AdminLayout, BoltPaginationSimple},
        props: ['shipments'],
        methods: {
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
