<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Thị trường
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.markets.create')"
                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <svg
                            class="-ml-0.5 mr-2 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Thêm mới
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
                                            Tên
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Website
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Cửa hàng
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Ngày tạo
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="market in markets.data"
                                        :key="market.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.markets.show', market.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ market.name }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.markets.show', market.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ market.website }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.markets.show', market.id)"
                                                class="px-6 py-4 flex items-center justify-center"
                                            >
                                                {{ market.vendors_count }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.markets.show', market.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(market.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="markets.from"
                            :to="markets.to"
                            :total="markets.total"
                            :prev-page-url="markets.prev_page_url"
                            :next-page-url="markets.next_page_url"
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
        props: ['markets', 'filters'],
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
                    this.$inertia.replace(route('admin.markets.index', Object.keys(query).length ? query : {}));
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
