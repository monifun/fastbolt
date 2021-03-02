<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        User details
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.users.edit', user.id)"
                        class="inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Edit
                    </inertia-link>
                    <button
                        class="ml-2 inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="openDepositModal"
                    >
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
                                            Joined
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-2">
                                            {{ dateFilter(user.created_at) }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Balance
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
                                    Orders
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    List of recent orders
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
                                    No records to display
                                </div>
                            </div>
                        </div>

                        <!-- Transactions -->
                        <div class="mt-6 bg-white overflow-hidden shadow sm:rounded-lg">
                            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Transactions
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    List of recent transactions
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
                                                    Amount
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
                                    class="px-4 py-5"
                                >
                                    No records to display
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
                <bolt-label
                    for="amount"
                    value="Amount"
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
                <p class="mt-2 text-sm text-gray-500">
                    Số tiền nạp vào: {{ currencyFilter(depositForm.amount) }}
                </p>
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
