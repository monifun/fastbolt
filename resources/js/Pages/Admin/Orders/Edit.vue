<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Edit order
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.orders.show', order.id)"
                        class="inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Back
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- General -->
                <bolt-form-section @submitted="updateOrderGeneral">
                    <template #title>
                        General information
                    </template>

                    <template #description>
                        Update order information.
                    </template>

                    <template #form>
                        <!-- Exchange rate -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="currency_rate"
                                value="Currency rate"
                            />
                            <bolt-input
                                id="currency_rate"
                                v-model="orderGeneralForm.currency_rate"
                                type="number"
                                class="mt-1 block w-full"
                                min="1"
                                step="any"
                            />
                            <bolt-input-error
                                :message="orderGeneralForm.errors.currency_rate"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="orderGeneralForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': orderGeneralForm.processing }"
                            :disabled="orderGeneralForm.processing"
                        >
                            Save
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <bolt-section-border />

                <!-- Customer -->
                <bolt-form-section @submitted="updateOrderShipping">
                    <template #title>
                        Customer details
                    </template>

                    <template #description>
                        Update customer detailed information and shipping address.
                    </template>

                    <template #form>
                        <!-- Shipping Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_name"
                                value="Name"
                            />
                            <bolt-input
                                id="shipping_name"
                                v-model="orderShippingForm.shipping_name"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_name"
                                class="mt-2"
                            />
                        </div>

                        <!-- Shipping Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_phone"
                                value="Phone"
                            />
                            <bolt-input
                                id="shipping_phone"
                                v-model="orderShippingForm.shipping_phone"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_phone"
                                class="mt-2"
                            />
                        </div>

                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <bolt-label
                                for="shipping_address"
                                value="Address"
                            />
                            <bolt-input
                                id="shipping_address"
                                v-model="orderShippingForm.shipping_address"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderShippingForm.errors.shipping_address"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="orderShippingForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': orderShippingForm.processing }"
                            :disabled="orderShippingForm.processing"
                        >
                            Save
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <bolt-section-border />

                <!-- Tax and Fee -->
                <bolt-form-section @submitted="createOrderCharge">
                    <template #title>
                        Fees
                    </template>

                    <template #description>
                        Add new tax or fee to the order.
                    </template>

                    <template #form>
                        <div class="col-span-6 lg:col-span-4">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Type -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="charge_id"
                                        value="Type"
                                    />
                                    <select
                                        id="charge_id"
                                        v-model="orderChargeForm.charge_id"
                                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        @change="populateChargeFields"
                                    >
                                        <option
                                            value="null"
                                            disabled
                                        >
                                            Please select
                                        </option>
                                        <option
                                            v-for="charge in charges"
                                            :key="charge.id"
                                            :value="charge.id"
                                        >
                                            {{ charge.name }}
                                        </option>
                                    </select>
                                    <bolt-input-error
                                        :message="orderChargeForm.errors.charge_id"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Value -->
                                <div class="col-span-3">
                                    <bolt-label
                                        for="tax_value"
                                        value="Value"
                                    />
                                    <bolt-input
                                        id="tax_value"
                                        v-model="orderChargeForm.value"
                                        type="number"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="orderChargeForm.errors.value"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-span-6 lg:col-span-4">
                            <bolt-label
                                for="tax_description"
                                value="Description"
                            />
                            <bolt-input
                                id="tax_description"
                                v-model="orderChargeForm.description"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <bolt-input-error
                                :message="orderChargeForm.errors.description"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <bolt-action-message
                            :on="orderChargeForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </bolt-action-message>

                        <bolt-primary-button
                            :class="{ 'opacity-25': orderChargeForm.processing }"
                            :disabled="orderChargeForm.processing"
                        >
                            Save
                        </bolt-primary-button>
                    </template>
                </bolt-form-section>

                <div v-if="order.charges.length > 0">
                    <bolt-section-border />

                    <!-- Manage tax and fee -->
                    <bolt-action-section>
                        <template #title>
                            Manage Taxes and Fees
                        </template>

                        <template #description>
                            Order applied taxes and fees.
                        </template>

                        <template #content>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto">
                                    <div class="align-middle inline-block min-w-full">
                                        <div class="shadow overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Type
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Name
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Apply
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Value
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >
                                                            Total
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr v-for="charge in order.charges">
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ chargeTypes[charge.type] }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ charge.name }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ charge.target }}
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                                            <span v-if="charge.method === 'percent'">{{ charge.value }}%</span>
                                                            <span v-else>{{ currencyFilter(charge.value) }}</span>
                                                        </td>
                                                        <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                                            {{ currencyFilter(calculateTaxRow(order, charge)) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </bolt-action-section>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltFormSection from "@/Components/FormSection";
    import BoltActionSection from "@/Components/ActionSection";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltInputError from "@/Components/InputError";
    import BoltSectionBorder from "@/Components/SectionBorder";
    import BoltActionMessage from "@/Components/ActionMessage";
    import BoltPrimaryButton from "@/Components/PrimaryButton";
    import currencyFilter from "@/Filters/currency";

    export default {
        name: "Edit",
        components: {AdminLayout, BoltFormSection, BoltActionSection, BoltLabel, BoltInput, BoltInputError, BoltSectionBorder, BoltActionMessage, BoltPrimaryButton},
        props: ['order', 'charges', 'chargeTypes'],
        data() {
            return {
                orderGeneralForm: this.$inertia.form({
                    currency_rate: this.order.currency_rate,
                }),

                orderShippingForm: this.$inertia.form({
                    shipping_name: this.order.shipping_name,
                    shipping_phone: this.order.shipping_phone,
                    shipping_address: this.order.shipping_address,
                }),

                orderChargeForm: this.$inertia.form({
                    charge_id: null,
                    value: null,
                    description: null,
                }),
            };
        },
        methods: {
            currencyFilter,
            updateOrderGeneral() {
                return this.orderGeneralForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
            updateOrderShipping() {
                return this.orderShippingForm.put(route('admin.orders.update', this.order), {
                    preserveScroll: true,
                });
            },
            populateChargeFields() {
                let charge = this.charges.find(charge => charge.id === this.orderChargeForm.charge_id);

                return this.orderChargeForm = {...this.orderChargeForm, value: charge.value, description: charge.description};
            },
            createOrderCharge() {
                return this.orderChargeForm.post(route('admin.orders.charges.store', this.order), {
                    preserveScroll: true,
                });
            },
            calculateTaxRow(order, charge) {
                let price = 0;

                if (charge.method === 'fixed') {
                    price = 100 + charge.value;
                } else {
                    price = 100 * charge.value / 100;
                }

                return price.toFixed(2);
            },
        },
    };
</script>
