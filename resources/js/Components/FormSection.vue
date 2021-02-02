<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <section-title>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="$emit('submitted')">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <slot name="form" />
                        </div>
                    </div>

                    <div
                        v-if="hasActions"
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6"
                    >
                        <slot name="actions" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import SectionTitle from "./SectionTitle";

    export default {
        name: "FormSection",
        components: {
            SectionTitle,
        },

        computed: {
            hasActions() {
                return !!this.$slots.actions;
            },
        },
    };
</script>
