<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h1>
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
                                            Mã đơn
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Sàn
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Người bán
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Trạng thái
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Ngày tạo
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative px-6 py-3 whitespace-nowrap"
                                        >
                                            <span class="sr-only">Sửa</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="order in orders.data"
                                        :key="order.id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <bolt-text-link :href="route('admin.orders.show', order.id)">
                                                {{ order.id }}
                                            </bolt-text-link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <bolt-text-link :href="route('admin.markets.show', order.vendor.market.id)">
                                                {{ order.vendor.market.name }}
                                            </bolt-text-link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <bolt-text-link :href="route('admin.vendors.show', order.vendor.id)">
                                                {{ order.vendor.name }}
                                            </bolt-text-link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ order.status.description }}
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap">
                                            {{ new Date(order.created_at) | date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <inertia-link
                                                :href="route('admin.orders.edit', order)"
                                                class="text-indigo-600 hover:text-indigo-900"
                                            >
                                                Chỉnh sửa
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="bg-white overflow-x-visible px-4 py-3 flex items-center border-t border-gray-200 justify-between sm:px-6">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <inertia-link
                                    :href="orders.prev_page_url || ''"
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                                    :class="{'cursor-not-allowed bg-gray-200 hover:bg-gray-200': orders.prev_page_url === null}"
                                >
                                    Trang trước
                                </inertia-link>
                                <inertia-link
                                    :href="orders.next_page_url || ''"
                                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                                    :class="{'cursor-not-allowed bg-gray-200 hover:bg-gray-200': orders.next_page_url === null}"
                                >
                                    Trang sau
                                </inertia-link>
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Hiển thị từ
                                        <span class="font-medium">{{ orders.from }}</span>
                                        đến
                                        <span class="font-medium">{{ orders.to }}</span>
                                        trên tổng số
                                        <span class="font-medium">{{ orders.total }}</span>
                                        kết quả
                                    </p>
                                </div>
                                <div>
                                    <nav
                                        class="relative z-0 inline-flex shadow-sm -space-x-px"
                                        aria-label="Pagination"
                                    >
                                        <inertia-link
                                            v-if="orders.prev_page_url"
                                            :href="orders.prev_page_url || ''"
                                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                            :class="{'cursor-not-allowed bg-gray-200 hover:bg-gray-200': orders.prev_page_url === null}"
                                        >
                                            <span class="sr-only">Trước</span>
                                            <svg
                                                class="h-5 w-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </inertia-link>
                                        <template
                                            v-for="link in orders.links.slice(1, -1)"
                                        >
                                            <inertia-link
                                                :href="link.url || ''"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                                :class="{'cursor-not-allowed bg-gray-200 hover:bg-gray-200': link.active}"
                                            >
                                                {{ link.label }}
                                            </inertia-link>
                                        </template>
                                        <inertia-link
                                            v-if="orders.next_page_url"
                                            :href="orders.next_page_url || ''"
                                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                            :class="{'cursor-not-allowed bg-gray-200 hover:bg-gray-200': orders.next_page_url === null}"
                                        >
                                            <span class="sr-only">Sau</span>
                                            <svg
                                                class="h-5 w-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </inertia-link>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltSearchFilter from "@/Components/SearchFilter";
    import BoltTextLink from "@/Components/TextLink";
    import throttle from "lodash/throttle";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";

    export default {
        name: "Index",
        components: {AdminLayout, BoltSearchFilter, BoltTextLink},
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
            reset() {
                this.form = mapValues(this.form, () => null);
            },
        },
    };
</script>
