<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Orders
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-ml-4 -mt-4 px-4 sm:px-0 flex justify-between items-center flex-wrap sm:flex-no-wrap">
                    <div class="ml-4 my-4 w-full max-w-md">
                        <bolt-search-filter
                            v-model="form.search"
                            @reset="reset"
                        />
                    </div>
                </div>

                <div class="overflow-hidden shadow sm:rounded-lg">
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
                                            Market
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
                                        v-for="order in orders.data"
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
                                                {{ order.vendor.market.name }}
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
                                        <td class="whitespace-nowrap tabular-nums">
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
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltSearchFilter from "@/Components/SearchFilter";
    import BoltPaginationSimple from "@/Components/PaginationSimple";
    import dateFilter from "@/Filters/date";
    import throttle from "lodash/throttle";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";

    export default {
        name: "Index",
        components: {AdminLayout, BoltSearchFilter, BoltPaginationSimple},
        props: ['orders', 'filters'],
        data() {
            return {
                form: {
                    search: this.filters.search,
                },
            };
        },
        watch: {
            form: {
                handler: throttle(function () {
                    let query = pickBy(this.form);
                    this.$inertia.replace(route('admin.orders.index', Object.keys(query).length ? query : {}));
                }, 500),
                deep: true,
            },
        },
        methods: {
            dateFilter,
            reset() {
                this.form = mapValues(this.form, () => null);
            },
        },
    };
</script>
