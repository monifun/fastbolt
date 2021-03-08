<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Bảng điều khiển
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-2 grid grid-cols-3 gap-6 flex flex-wrap">
                    <div class="col-span-3 sm:col-span-1 flex flex-col w-full">
                        <!-- Statistics -->
                        <bolt-card class="flex-1">
                            <template #content>
                                <div>
                                    <h2 class="text-lg font-semibold">
                                        Thống kê
                                    </h2>
                                    <p class="text-gray-500 text-sm">
                                        Tổng quan dữ liệu 30 ngày qua.
                                    </p>
                                </div>
                                <dl class="py-6 grid grid-cols-2 gap-6">
                                    <div>
                                        <dt class="text-gray-500 text-sm font-medium">
                                            Khách hàng
                                        </dt>
                                        <dd class="text-2xl font-medium text-indigo-600">
                                            {{ last30DaysUsersCount }}
                                        </dd>
                                    </div>

                                    <div>
                                        <dt class="text-gray-500 text-sm font-medium">
                                            Giao dịch
                                        </dt>
                                        <dd class="text-2xl font-medium text-indigo-600">
                                            {{ last30DaysTransactionsCount }}
                                        </dd>
                                    </div>

                                    <div>
                                        <dt class="text-gray-500 text-sm font-medium">
                                            Đơn hàng
                                        </dt>
                                        <dd class="text-2xl font-medium text-indigo-600">
                                            {{ last30DaysOrdersCount }}
                                        </dd>
                                    </div>

                                    <div>
                                        <dt class="text-gray-500 text-sm font-medium">
                                            Sản phẩm
                                        </dt>
                                        <dd class="text-2xl font-medium text-indigo-600">
                                            {{ last30DaysProductsCount }}
                                        </dd>
                                    </div>
                                </dl>
                            </template>
                        </bolt-card>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex flex-col w-full">
                        <!-- Graph -->
                        <bolt-card class="flex-1 relative">
                            <template #content>
                                <div>
                                    <h2 class="text-lg font-semibold">
                                        Biểu đồ đơn hàng
                                    </h2>
                                    <p class="text-gray-500 text-sm">
                                        Mô tả tình hình tăng trưởng đơn hàng 30 ngày qua.
                                    </p>
                                </div>
                                <div class="-mx-8 -my-10 sm:-mx-6 sm:-my-5 sm:absolute bottom-0 inset-x-0 h-2/3">
                                    <canvas id="myChart" />
                                </div>
                            </template>
                        </bolt-card>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-1 flex flex-col">
                            <bolt-card class="flex-1">
                                <template #title>
                                    Thị trường nổi bật
                                </template>
                                <template #content>
                                    <ul class="divide-y divide-gray-200 -mx-4 sm:-mx-6 -my-5">
                                        <li v-for="(market, index) in topMarkets">
                                            <a
                                                href="#"
                                                class="block hover:bg-gray-50"
                                            >
                                                <div class="flex items-center px-4 py-4 sm:px-6">
                                                    <div class="min-w-0 flex-1 flex items-center">
                                                        <div
                                                            class="flex items-center justify-center rounded-full p-1 h-10 w-10 bg-gray-300 text-white"
                                                            :class="{'bg-indigo-600': index === 0, 'bg-indigo-500': index === 1 , 'bg-indigo-400': index === 2}"
                                                        >
                                                            {{ index + 1 }}
                                                        </div>
                                                        <div class="min-w-0 flex-1 px-4">
                                                            <div>
                                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                                    {{ market.name }}
                                                                </p>
                                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                    với {{ market.orders_count }} đơn hàng được tạo.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </bolt-card>
                        </div>

                        <div class="col-span-3 sm:col-span-2 flex flex-col">
                            <!-- Recent orders -->
                            <bolt-card class="flex-1">
                                <template #title>
                                    Đơn hàng gần đây
                                </template>
                                <template #content>
                                    <div class="relative -mx-4 -my-5 sm:-mx-6">
                                        <div
                                            v-if="recentOrders.length > 0"
                                            class="overflow-hidden overflow-x-auto overflow-y-scroll relative"
                                        >
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
                                                            Khách hàng
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
                                                            Thời gian
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr
                                                        v-for="order in recentOrders"
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
                                                        <td class="text-right whitespace-nowrap">
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
                                        <div
                                            v-else
                                            class="p-4 bg-white"
                                        >
                                            No records to display
                                        </div>
                                    </div>
                                </template>
                            </bolt-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltCard from "@/Components/Card";
    import dateFilter from "@/Filters/date";

    export default {
        name: "Dashboard",
        components: {AdminLayout, BoltCard},
        props: ['last30DaysUsersCount', 'totalUsersCount', 'last30DaysTransactionsCount', 'totalTransactionsCount', 'last30DaysOrdersCount', 'totalOrdersCount', 'recentOrders', 'totalProductsCount', 'last30DaysProductsCount', 'topMarkets', 'orders_graph'],
        mounted() {
            const dates = [...Array(30)].map((_, i) => {
                const d = new Date();
                d.setDate(d.getDate() - i);
                return d.toLocaleDateString('vi-VN');
            }).reverse();
            const ctx = document.getElementById('myChart').getContext('2d');
            const chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Đơn hàng',
                        backgroundColor: 'rgba(141, 162, 251)',
                        borderColor: 'rgba(104,117,245)',
                        data: this.orders_graph,
                    }],
                },
                // Configuration options go here
                options: {
                    layout: {
                        padding: {
                            top: 5,
                        },
                    },
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    elements: {
                        point: {
                            radius: 2,
                        },
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                display: false,
                            },
                            gridLines: {
                                display: false,
                            },
                            scaleLabel: {
                                display: false,
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                display: false,
                            },
                            gridLines: {
                                display: false,
                            },
                            scaleLabel: {
                                display: false,
                            },
                        }],
                    },
                },
            });
        },
        methods: {
            dateFilter,
        },
    };
</script>
