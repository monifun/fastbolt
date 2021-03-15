<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Vận đơn #{{ shipment.id }}
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-6">
                    <!-- Information -->
                    <div class="col-span-3 sm:col-span-1">
                        <bolt-card>
                            <template #title>
                                Thông tin vận đơn
                            </template>

                            <template #content>
                                <dl class="divide-y divide-gray-200 -mx-4 -my-5 sm:-mx-6">
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Đơn vị chuyển
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            {{ shipment.carrier_name }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Mã vận đơn
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            {{ shipment.tracking_number }}
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Đơn hàng
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            <inertia-link :href="route('admin.orders.show', shipment.order_id)" class="hover:text-indigo-600 transition ease-in-out duration-150">
                                                {{ shipment.order_id }}
                                            </inertia-link>
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Trọng lượng
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            {{ shipment.weight ?? 0 }} gr
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Thể tích
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            {{ shipment.volume ?? 0 }} cm<sup>3</sup>
                                        </dd>
                                    </div>
                                    <div class="px-4 py-5 grid grid-cols-2 gap-4 sm:px-6">
                                        <dt class="col-auto text-sm font-medium text-gray-500">
                                            Chi phí
                                        </dt>
                                        <dd class="col-auto text-sm text-gray-900">
                                            {{ currencyFilter(shipment.price, shipment.currency_code) }}
                                        </dd>
                                    </div>
                                </dl>
                            </template>
                        </bolt-card>
                    </div>
                    <!-- Product -->
                    <div class="col-span-3 sm:col-span-2">
                        <bolt-card>
                            <template #title>
                                Sản phẩm
                            </template>
                            <template #content>
                                <div class="overflow-hidden overflow-x-auto relative -mx-4 -my-5 sm:-mx-6">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                />
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                >
                                                    SL
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr
                                                v-for="product in shipment.products"
                                                :key="product.id"
                                                class="bg-white"
                                            >
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-14 w-12">
                                                            <img
                                                                class="h-14 rounded"
                                                                :src="product.image"
                                                                :alt="product.name"
                                                            >
                                                        </div>
                                                        <div class="ml-4 max-w-xs sm:max-w-md">
                                                            <div class="text-sm font-medium text-gray-900 truncate ...">
                                                                <a
                                                                    :href="product.url"
                                                                    class="hover:underline"
                                                                    target="_blank"
                                                                >
                                                                    {{ product.name }}
                                                                </a>
                                                            </div>
                                                            <div
                                                                v-if="product.options"
                                                                class="text-sm text-gray-900"
                                                            >
                                                                <ul class="list-none">
                                                                    <li
                                                                        v-for="(option, index) in product.options"
                                                                        :key="option.label"
                                                                        class="inline"
                                                                        :class="{'ml-1': index > 0}"
                                                                    >
                                                                        {{ option.label }}: {{ option.value }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                    {{ product.quantity }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </template>
                        </bolt-card>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltCard from "@/Components/Card";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {AdminLayout, BoltCard},
        props: ['shipment'],
        methods: {
            currencyFilter,
            dateFilter,
        },
    };
</script>

<style scoped>

</style>
