<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Vendors
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.vendors.create')"
                        class="inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Create
                    </inertia-link>
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
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            ID
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Identity
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Market
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Created
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="vendor in vendors.data"
                                        :key="vendor.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.vendors.show', vendor.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ vendor.id }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.vendors.show', vendor.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ vendor.identity }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.vendors.show', vendor.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ vendor.name }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.vendors.show', vendor.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ vendor.market.name }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.vendors.show', vendor.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(vendor.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="vendors.from"
                            :to="vendors.to"
                            :total="vendors.total"
                            :prev-page-url="vendors.prev_page_url"
                            :next-page-url="vendors.next_page_url"
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
        props: ['vendors', 'filters'],
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
                    this.$inertia.replace(route('admin.vendors.index', Object.keys(query).length ? query : {}));
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
