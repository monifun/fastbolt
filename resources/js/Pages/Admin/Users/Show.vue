<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Thông tin người dùng
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6 text-center">
                                <div>
                                    <svg
                                        class="h-32 w-32 p-1 rounded-full bg-gray-200 mx-auto fill-current text-gray-400"
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
                                </div>

                                <div class="mt-2">
                                    <div class="font-medium text-base text-gray-800">
                                        {{ user.name }}
                                    </div>
                                    <div class="flex items-center justify-center font-medium text-sm text-gray-500">
                                        <span
                                            v-if="user.email_verified_at != null"
                                            class="inline-block h-4 w-4 rounded-full text-green-400"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                                />
                                            </svg>
                                        </span>
                                        <span class="ml-1">
                                            {{ user.email }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-0 col-span-2">
                        <!-- Orders -->
                        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Đơn hàng
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Danh sách đơn hàng được tạo gần đây
                                </p>
                            </div>
                            <div>
                                <div
                                    v-if="user.orders.length > 0"
                                    class="overflow-hidden overflow-x-auto relative"
                                >
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
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
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
                                                    <span class="sr-only">Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr
                                                v-for="order in user.orders"
                                                :key="order.id"
                                            >
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ order.id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    {{ order.status.description }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right tabular-nums">
                                                    {{ new Date(order.created_at) | date }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <inertia-link
                                                        :href="route('admin.orders.show', order)"
                                                        class="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Chi tiết
                                                    </inertia-link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p v-else>
                                    Chưa có thông tin đơn hàng
                                </p>
                            </div>
                        </div>

                        <!-- Transactions -->
                        <div class="mt-6 bg-white overflow-hidden shadow sm:rounded-lg">
                            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Giao dịch
                                </h3>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <p>Chưa có thông tin giao dịch</p>
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
    export default {
        name: "Show",
        components: {AdminLayout},
        props: ['user'],
    };
</script>
