<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Đơn hàng #{{ order.id }}
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.orders.edit', order.id)"
                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <svg
                            class="-ml-0.5 mr-2 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path
                                fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Sửa
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 lg:col-span-2">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Products -->
                            <div class="col-auto">
                                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                                        <h2 class="text-lg leading-6 font-medium text-gray-900">
                                            Sản phẩm
                                        </h2>
                                    </div>
                                    <div class="overflow-hidden overflow-x-auto relative">
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
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                    >
                                                        Đơn giá
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                    >
                                                        Tạm tính
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                    >
                                                        Phụ phí
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                    >
                                                        Tổng cộng
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                    >
                                                        <span class="sr-only">Thao tác</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                <tr
                                                    v-for="product in order.products"
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
                                                            <div class="ml-4 max-w-md">
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
                                                                <div
                                                                    v-if="product.note"
                                                                    class="text-sm text-gray-500 whitespace-normal"
                                                                >
                                                                    {{ product.note }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                        {{ product.quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                        <div class="text-sm text-gray-500">
                                                            {{ currencyFilter(product.price, order.currency_code) }}
                                                        </div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ currencyFilter(product.price * order.currency_rate) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                        <div class="text-sm text-gray-500">
                                                            {{ currencyFilter(product.subtotal, order.currency_code) }}
                                                        </div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ currencyFilter(product.subtotal * order.currency_rate) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                        <div class="text-sm text-gray-500">
                                                            {{ currencyFilter(product.charge_total, order.currency_code) }}
                                                        </div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ currencyFilter(product.charge_total * order.currency_rate) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 tabular-nums">
                                                        <div class="text-sm text-gray-500">
                                                            {{ currencyFilter(product.grand_total, order.currency_code) }}
                                                        </div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ currencyFilter(product.grand_total * order.currency_rate) }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 tabular-nums">
                                                        <inertia-link
                                                            :href="route('admin.products.edit', product.id)"
                                                            class="hover:text-indigo-600 transition ease-in-out duration-150"
                                                        >
                                                            Sửa
                                                        </inertia-link>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments -->
                            <div class="col-auto">
                                <bolt-card>
                                    <template #title>
                                        Thảo luận
                                    </template>

                                    <template #content>
                                        <div class="max-h-72 overflow-hidden overflow-y-scroll">
                                            <ul
                                                v-if="order.comments.length > 0"
                                                class="space-y-8"
                                            >
                                                <li
                                                    v-for="comment in order.comments.slice().reverse()"
                                                    :key="comment.id"
                                                >
                                                    <div class="flex space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <svg
                                                                class="h-10 w-10 fill-current text-gray-400 rounded-full bg-gray-200 p-0.5"
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
                                                        <div>
                                                            <div class="text-sm space-x-2">
                                                                <inertia-link
                                                                    :href="route('admin.users.show', comment.user.id)"
                                                                    class="font-medium text-gray-900"
                                                                >
                                                                    {{ comment.user.name }}
                                                                </inertia-link>
                                                                <span class="text-gray-500 font-medium">&middot;</span>
                                                                <span class="text-gray-500 text-xs tabular-nums">
                                                                    {{ dateFilter(comment.created_at) }}
                                                                </span>
                                                            </div>
                                                            <div class="mt-1 text-sm text-gray-700">
                                                                <p class="whitespace-pre-line">
                                                                    {{ comment.content }}
                                                                </p>
                                                            </div>
                                                            <div class="mt-2 flex items-center">
                                                                <inertia-link
                                                                    :href="route('admin.orders.comments.destroy', [order, comment])"
                                                                    as="button"
                                                                    method="delete"
                                                                    class="text-gray-500 hover:text-red-700"
                                                                >
                                                                    <svg
                                                                        class="w-3.5 h-3.5"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 20 20"
                                                                        fill="currentColor"
                                                                    >
                                                                        <path
                                                                            fill-rule="evenodd"
                                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                            clip-rule="evenodd"
                                                                        />
                                                                    </svg>
                                                                </inertia-link>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <p
                                                v-else
                                                class="text-sm text-gray-500"
                                            >
                                                Chưa có bình luận nào.
                                            </p>
                                        </div>
                                    </template>

                                    <template #footer>
                                        <div class="flex space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg
                                                    class="h-10 w-10 fill-current text-gray-400 rounded-full bg-gray-200 p-0.5"
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
                                            <div class="min-w-0 flex-1">
                                                <form @submit.prevent="createNewComment">
                                                    <div>
                                                        <label
                                                            for="comment"
                                                            class="sr-only"
                                                        >
                                                            Nội dung
                                                        </label>
                                                        <textarea
                                                            id="comment"
                                                            v-model="createCommentForm.content"
                                                            name="comment"
                                                            rows="3"
                                                            class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                                            placeholder="Nhập nội dung bình luận."
                                                        />
                                                    </div>
                                                    <div class="mt-3 flex items-center justify-between">
                                                        <span
                                                            class="hidden group sm:inline-flex items-start text-sm space-x-2 text-gray-500 hover:text-gray-900"
                                                        >
                                                            <!-- Heroicon name: solid/question-mark-circle -->
                                                            <svg
                                                                class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20"
                                                                fill="currentColor"
                                                                aria-hidden="true"
                                                            >
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                                    clip-rule="evenodd"
                                                                />
                                                            </svg>
                                                            <span>
                                                                Vui lòng sử dụng ngôn từ phù hợp.
                                                            </span>
                                                        </span>
                                                        <bolt-secondary-button type="submit">
                                                            Đăng bình luận
                                                        </bolt-secondary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </template>
                                </bolt-card>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-3 lg:col-span-1">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- General -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Tổng quan
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="col-span-2">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Trạng thái
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    <select
                                                        id="orderStatus"
                                                        v-model="updateOrderStatusForm.status"
                                                        class="appearance-none block w-full p-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                                        @change="updateOrderStatus"
                                                    >
                                                        <option
                                                            v-for="(value, key) in orderStatuses"
                                                            :key="key"
                                                            :value="key"
                                                        >
                                                            {{ value }}
                                                        </option>
                                                    </select>
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    ID
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.id }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tỷ giá
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.currency_rate }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Thị trường
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.vendor.market.name }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Cửa hàng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.vendor.name }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Ngày tạo đơn
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ dateFilter(order.created_at) }}
                                                </dd>
                                            </div>

                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Ngày cập nhật
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ dateFilter(order.updated_at) }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Customer -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Khách hàng
                                    </template>

                                    <template #actions>
                                        <inertia-link
                                            :href="route('admin.users.show', order.user.id)"
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                                        >
                                            Chi tiết
                                        </inertia-link>
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Họ và Tên
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_name }}
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Điện thoại
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_phone }}
                                                </dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Địa chỉ
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ order.shipping_address }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Payment -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Tài chính
                                    </template>

                                    <template #actions>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                                            @click="openPaymentModal"
                                        >
                                            Thêm giao dịch
                                        </button>
                                    </template>

                                    <template #content>
                                        <dl class="grid grid-cols-1 gap-4">
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tổng tiền hàng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.product_price_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tổng phụ phí sản phẩm
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.product_charge_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tổng phụ phí đơn hàng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.charge_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Tổng cộng
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.grand_total * order.currency_rate) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Đã thanh toán
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.total_paid) }}
                                                </dd>
                                            </div>
                                            <div class="col-span-1 flex justify-between">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Dư nợ
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ currencyFilter(order.total_due) }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </template>
                                </bolt-card>
                            </div>

                            <!-- Shipment -->
                            <div class="col-span-2 flex flex-col md:col-span-1 lg:col-span-2">
                                <bolt-card class="flex-1">
                                    <template #title>
                                        Vận chuyển
                                    </template>

                                    <template #actions>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                                            @click="openNewShipmentModal"
                                        >
                                            Thêm vận đơn
                                        </button>
                                    </template>

                                    <template #content>
                                        <dl
                                            v-if="order.shipments.length > 0"
                                            class="grid grid-cols-1 gap-4"
                                        >
                                            <div
                                                v-for="shipment in order.shipments"
                                                :key="shipment.id"
                                                class="col-span-1 flex justify-between"
                                            >
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    {{ shipment.id }}
                                                </dt>
                                                <dd class="mt-1 text-sm leading-5 text-gray-900">
                                                    {{ shipment.status.description }}
                                                </dd>
                                            </div>
                                        </dl>
                                        <div v-else>
                                            <p class="text-sm">
                                                Chưa có thông tin vận chuyển.
                                            </p>
                                        </div>
                                    </template>
                                </bolt-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add payment modal -->
        <bolt-dialog-model
            :show="addNewPayment"
            :closeable="false"
            @close="addNewPayment = false"
        >
            <template #title>
                Thêm giao dịch mới
            </template>

            <template #content>
                <p>Sử dụng ví điện tử để tạo giao dịch cho đơn hàng, số dư hiện tại là: {{ currencyFilter(order.user.wallet_balance) }}</p>
                <div class="mt-3">
                    <bolt-label
                        for="paymentAmount"
                        :value="'Số tiền cần thanh toán ' + currencyFilter(order.total_due)"
                    />
                    <bolt-input
                        id="paymentAmount"
                        v-model="createPaymentForm.amount"
                        type="number"
                        class="mt-1 block w-full"
                        :placeholder="currencyFilter(order.total_due)"
                        min="1"
                    />
                    <bolt-input-error
                        :message="createPaymentForm.errors.amount"
                        class="mt-2"
                    />
                    <p
                        v-if="createPaymentForm.amount > 0"
                        class="mt-2 text-sm text-gray-500"
                    >
                        Bạn đã nhập: {{ currencyFilter(createPaymentForm.amount) }}
                    </p>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="addNewPayment = false">
                    Hủy bỏ
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="createOrderPayment"
                >
                    Lưu lại
                </bolt-primary-button>
            </template>
        </bolt-dialog-model>

        <!-- Add shipment modal -->
        <bolt-dialog-model
            :show="addNewShipment"
            :closeable="false"
            @close="addNewShipment = false"
        >
            <template #title>
                Thêm vận đơn
            </template>

            <template #content>
                <!-- Product list -->
                <ul
                    class="block divide-y divide-gray-200"
                    :class="{'max-h-64 overflow-y-scroll': !expandProductInShipment}"
                >
                    <li
                        v-for="product in createShipmentForm.products"
                        :key="product.id"
                        class="py-4"
                    >
                        <div class="flex items-center">
                            <div class="flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="flex items-center">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        :src="product.image"
                                        alt="Product image"
                                    >
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ product.name }}
                                        </p>
                                        <ul class="list-none text-sm text-gray-500">
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
                                <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-4 sm:flex sm:justify-end">
                                    <bolt-input
                                        v-model="product.quantity"
                                        type="text"
                                        class="block w-full sm:w-1/3 text-center"
                                        :placeholder="product.quantity"
                                    />
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- Expand/Collapse product list -->
                <div class="relative">
                    <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                    >
                        <div class="w-full border-t border-gray-300" />
                    </div>
                    <div class="relative flex justify-center">
                        <button
                            type="button"
                            class="inline-flex items-center shadow-sm px-2 py-1 border border-gray-300 text-xs leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
                            @click="toggleProductInShipment"
                        >
                            <span>
                                {{ expandProductInShipment ? 'Thu gọn' : 'Mở rộng' }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Shipment form -->
                <div class="mt-5 grid grid-cols-6 gap-4">
                    <!-- Carrier -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="carrier"
                            value="Nhà vận chuyển"
                        />
                        <bolt-input
                            id="carrier"
                            v-model="createShipmentForm.carrier_name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.carrier_name"
                            class="mt-2"
                        />
                    </div>

                    <!-- Tracking -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="tracking"
                            value="Mã vận đơn"
                        />
                        <bolt-input
                            id="tracking"
                            v-model="createShipmentForm.tracking_number"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.tracking_number"
                            class="mt-2"
                        />
                    </div>

                    <!-- Status -->
                    <div class="col-span-6 sm:col-span-2">
                        <bolt-label
                            for="shipment_status"
                            value="Trạng thái"
                        />
                        <select
                            id="shipment_status"
                            v-model="createShipmentForm.status"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                        >
                            <option
                                v-for="(value, key) in shipmentStatuses"
                                :key="key"
                                :value="key"
                            >
                                {{ value }}
                            </option>
                        </select>
                        <bolt-input-error
                            :message="createShipmentForm.errors.tracking_number"
                            class="mt-2"
                        />
                    </div>

                    <!-- Price -->
                    <div class="col-span-6">
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-2">
                                <bolt-label
                                    for="price"
                                    value="Giá tiền"
                                />
                                <bolt-input
                                    id="price"
                                    v-model="createShipmentForm.price"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.price"
                                    class="mt-2"
                                />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <bolt-label
                                    for="shipment_currency_code"
                                    value="Loại tiền"
                                />
                                <select
                                    id="shipment_currency_code"
                                    v-model="createShipmentForm.currency_code"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                >
                                    <option :value="order.currency_code">
                                        {{ order.currency_code }}
                                    </option>
                                    <option value="VND">
                                        VND
                                    </option>
                                </select>
                                <bolt-input-error
                                    :message="createShipmentForm.errors.currency_code"
                                    class="mt-2"
                                />
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <bolt-label
                                    for="shipment_currency_rate"
                                    value="Tỷ giá"
                                />
                                <bolt-input
                                    id="shipment_currency_rate"
                                    v-model="createShipmentForm.currency_rate"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.currency_rate"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Dimension -->
                    <div class="col-span-6">
                        <div class="grid grid-cols-8 gap-4">
                            <!-- Weight -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="weight"
                                    value="Trọng lượng (gr)"
                                />
                                <bolt-input
                                    id="weight"
                                    v-model="createShipmentForm.weight"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.weight"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Length -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="length"
                                    value="Chiều dài (cm)"
                                />
                                <bolt-input
                                    id="length"
                                    v-model="createShipmentForm.length"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.length"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Width -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="width"
                                    value="Chiều rộng (cm)"
                                />
                                <bolt-input
                                    id="width"
                                    v-model="createShipmentForm.width"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.width"
                                    class="mt-2"
                                />
                            </div>

                            <!-- Height -->
                            <div class="col-span-2 sm:col-span-2">
                                <bolt-label
                                    for="height"
                                    value="Chiều cao (cm)"
                                />
                                <bolt-input
                                    id="height"
                                    v-model="createShipmentForm.height"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="0.00"
                                />
                                <bolt-input-error
                                    :message="createShipmentForm.errors.height"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-span-6">
                        <bolt-label
                            for="note"
                            value="Ghi chú"
                        />
                        <bolt-input
                            id="note"
                            v-model="createShipmentForm.note"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <bolt-input-error
                            :message="createShipmentForm.errors.note"
                            class="mt-2"
                        />
                    </div>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="addNewShipment = false">
                    Hủy bỏ
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="createNewShipment"
                >
                    Lưu lại
                </bolt-primary-button>
            </template>
        </bolt-dialog-model>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltCard from "@/Components/Card";
    import BoltDialogModel from "@/Components/DialogModal";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltLabel from "@/Components/Label";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {AdminLayout, BoltCard, BoltDialogModel, BoltInput, BoltInputError, BoltLabel, BoltPrimaryButton, BoltSecondaryButton},
        props: ['order', 'orderStatuses', 'shipmentStatuses'],
        data() {
            return {
                updateOrderStatusForm: this.$inertia.form({
                    status: this.order.status.value,
                }),
                addNewPayment: false,
                createPaymentForm: this.$inertia.form({
                    type: 'payment',
                    status: 'completed',
                    amount: null,
                }),
                addNewShipment: false,
                createShipmentForm: this.$inertia.form({
                    status: 'pending',
                    carrier_name: null,
                    tracking_number: null,
                    weight: null,
                    length: null,
                    width: null,
                    height: null,
                    price: null,
                    currency_code: this.order.currency_code,
                    currency_rate: this.order.currency_rate,
                    note: null,
                    products: this.order.products,
                }),
                createCommentForm: this.$inertia.form({
                    content: null,
                }),
                expandProductInShipment: false,
            };
        },
        methods: {
            currencyFilter,
            dateFilter,
            updateOrderStatus() {
                return this.updateOrderStatusForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
            openPaymentModal() {
                return this.addNewPayment = true;
            },
            createOrderPayment() {
                return this.createPaymentForm.post(route('admin.orders.transactions.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.createPaymentForm.reset();
                        this.addNewPayment = false;
                    },
                });
            },
            openNewShipmentModal() {
                return this.addNewShipment = true;
            },
            createNewShipment() {
                return this.createShipmentForm.post(route('admin.orders.shipments.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.createShipmentForm.reset();
                        this.addNewShipment = false;
                    },
                });
            },
            createNewComment() {
                return this.createCommentForm.post(route('admin.orders.comments.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.createCommentForm.reset();
                    },
                });
            },
            toggleProductInShipment() {
                return this.expandProductInShipment =! this.expandProductInShipment;
            },
        },
    };
</script>
