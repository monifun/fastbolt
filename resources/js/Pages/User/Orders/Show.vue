<template>
    <user-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Đơn hàng #{{ order.id }} - {{ order.status.description }}
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 lg:col-span-2">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Product -->
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
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment -->
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
                                                                <span class="font-medium text-gray-900">
                                                                    {{ comment.user.name }}
                                                                </span>
                                                                <span
                                                                    v-if="comment.user.is_admin"
                                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800"
                                                                >
                                                                    Nhân viên
                                                                </span>
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
                                                <form @submit.prevent="addComment">
                                                    <div>
                                                        <label
                                                            for="comment"
                                                            class="sr-only"
                                                        >
                                                            Nội dung
                                                        </label>
                                                        <textarea
                                                            id="comment"
                                                            v-model="commentForm.content"
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

                    <!-- Order Details -->
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
                                            <div class="sm:col-span-1">
                                                <dt class="text-sm leading-5 font-medium text-gray-500">
                                                    Mã đơn
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <bolt-dialog-model
            :show="showPaymentModal"
            :closeable="false"
            @close="showPaymentModal = false"
        >
            <template #title>
                Tạo giao dịch mới
            </template>

            <template #content>
                <p>Sử dụng ví điện tử để thanh toán cho đơn hàng này, số dư hiện tại là: {{ currencyFilter($page.props.auth.user.wallet_balance) }}</p>
                <div class="mt-3">
                    <bolt-label
                        for="paymentAmount"
                        :value="'Số tiền cần thanh toán ' + currencyFilter(order.total_due)"
                    />
                    <bolt-input
                        id="paymentAmount"
                        v-model="paymentForm.amount"
                        type="number"
                        class="mt-1 block w-full"
                        :placeholder="currencyFilter(order.total_due)"
                        min="1"
                    />
                    <bolt-input-error
                        :message="paymentForm.errors.amount"
                        class="mt-2"
                    />
                    <p
                        v-if="paymentForm.amount > 0"
                        class="mt-2 text-sm text-gray-500"
                    >
                        Bạn đã nhập: {{ currencyFilter(paymentForm.amount) }}
                    </p>
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="showPaymentModal = false">
                    Hủy bỏ
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="makePayment"
                >
                    Xác nhận
                </bolt-primary-button>
            </template>
        </bolt-dialog-model>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
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
        components: {UserLayout, BoltCard, BoltDialogModel, BoltInput, BoltInputError, BoltLabel, BoltPrimaryButton, BoltSecondaryButton},
        props: ['order'],
        data() {
            return {
                showPaymentModal: false,
                paymentForm: this.$inertia.form({
                    amount: null,
                }),
                commentForm: this.$inertia.form({
                    content: null,
                }),
            };
        },
        methods: {
            currencyFilter,
            dateFilter,
            openPaymentModal() {
                return this.showPaymentModal = true;
            },
            makePayment() {
                return this.paymentForm.post(route('user.orders.payments.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.paymentForm.reset();
                        this.showPaymentModal = null;
                    },
                });
            },
            addComment() {
                return this.commentForm.post(route('user.orders.comments.store', this.order), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.commentForm.reset();
                    },
                });
            },
        },
    };
</script>

<style scoped>

</style>
