<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Thông tin người dùng
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.users.edit', user.id)"
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
                    <button
                        class="ml-2 inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="openDepositModal"
                    >
                        <svg
                            class="-ml-0.5 mr-2 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Nạp ví
                    </button>
                </div>
            </div>
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
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                <dl class="sm:divide-y sm:divide-gray-200">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Đăng ký
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-2">
                                            {{ dateFilter(user.created_at, 'dd-MM-yyyy') }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Điện thoại
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-2">
                                            {{ user.phone }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Số dư ví
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ currencyFilter(user.wallet_balance) }}
                                        </dd>
                                    </div>
                                </dl>
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
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                >
                                                    Trạng thái
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                >
                                                    Ngày tạo
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr
                                                v-for="order in user.orders"
                                                :key="order.id"
                                                class="hover:bg-gray-100 focus-within:bg-gray-100"
                                            >
                                                <td class="whitespace-nowrap">
                                                    <inertia-link
                                                        :href="route('admin.orders.show', order)"
                                                        class="px-6 py-4 flex items-center"
                                                    >
                                                        {{ order.id }}
                                                    </inertia-link>
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    <inertia-link
                                                        :href="route('admin.orders.show', order)"
                                                        class="px-6 py-4 flex items-center justify-end"
                                                    >
                                                        {{ order.status.description }}
                                                    </inertia-link>
                                                </td>
                                                <td class="whitespace-nowrap tabular-nums">
                                                    <inertia-link
                                                        :href="route('admin.orders.show', order)"
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
                                    class="px-4 py-5 sm:p-6"
                                >
                                    Không có dữ liệu.
                                </div>
                            </div>
                        </div>

                        <!-- Transactions -->
                        <div class="mt-6 bg-white overflow-hidden shadow sm:rounded-lg">
                            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Giao dịch
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Danh sách giao dịch thực hiện gần đây
                                </p>
                            </div>
                            <div>
                                <div
                                    v-if="user.transactions.length > 0"
                                    class="overflow-hidden overflow-x-auto relative"
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
                                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                                >
                                                    Số tiền
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
                                                v-for="transaction in user.transactions"
                                                :key="transaction.id"
                                                class="hover:bg-gray-100 focus-within:bg-gray-100"
                                            >
                                                <td class="whitespace-nowrap">
                                                    <inertia-link
                                                        href="#"
                                                        class="px-6 py-4 flex items-center"
                                                    >
                                                        {{ transaction.id }}
                                                    </inertia-link>
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    <inertia-link
                                                        href="#"
                                                        class="px-6 py-4 flex items-center justify-end"
                                                    >
                                                        {{ currencyFilter(transaction.amount) }}
                                                    </inertia-link>
                                                </td>
                                                <td class="whitespace-nowrap tabular-nums">
                                                    <inertia-link
                                                        href="#"
                                                        class="px-6 py-4 flex items-center justify-end"
                                                    >
                                                        {{ dateFilter(transaction.created_at) }}
                                                    </inertia-link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p
                                    v-else
                                    class="px-4 py-5 sm:p-6"
                                >
                                    Không có dữ liệu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <bolt-dialog-modal
            :show="showDepositModal"
            :closeable="false"
            :max-width="'md'"
            @close="showDepositModal = false"
        >
            <template #title>
                Nạp tiền vào ví
            </template>

            <template #content>
                <div>
                    <bolt-label
                        for="amount"
                        :value="`Số tiền: ${currencyFilter(depositForm.amount)}`"
                    />
                    <bolt-input
                        id="amount"
                        v-model="depositForm.amount"
                        type="number"
                        class="block w-full"
                        autocomplete="off"
                    />
                    <bolt-input-error
                        :message="depositForm.errors.amount"
                        class="mt-2"
                    />
                </div>

                <div class="mt-6">
                    <bolt-label
                        for="note"
                        value="Ghi chú"
                    />
                    <bolt-input
                        id="note"
                        v-model="depositForm.note"
                        type="text"
                        class="block w-full"
                        autocomplete="off"
                    />
                    <bolt-input-error
                        :message="depositForm.errors.note"
                        class="mt-2"
                    />
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="showDepositModal = false">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-primary-button
                    class="ml-2"
                    @click="makeDeposit"
                >
                    Lưu lại
                </bolt-primary-button>
            </template>
        </bolt-dialog-modal>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltDialogModal from "@/Components/DialogModal";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltLabel from "@/Components/Label";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import currencyFilter from "@/Filters/currency";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Show",
        components: {AdminLayout, BoltDialogModal, BoltInput, BoltInputError, BoltLabel, BoltPrimaryButton, BoltSecondaryButton},
        props: ['user'],
        data() {
            return {
                showDepositModal: false,
                depositForm: this.$inertia.form({
                    amount: null,
                    note: null,
                }),
            };
        },
        methods: {
            currencyFilter,
            dateFilter,
            openDepositModal() {
                return this.showDepositModal = true;
            },
            makeDeposit() {
                return this.depositForm.post(route('admin.users.wallet.deposit', this.user), {
                    onSuccess: () => {
                        this.depositForm.reset();
                        this.showDepositModal = false;
                    },
                });
            },
        },
    };
</script>
