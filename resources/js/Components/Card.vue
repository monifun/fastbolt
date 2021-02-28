<template>
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <slot name="title" />
                    </h3>
                    <p
                        v-if="hasDescription"
                        class="mt-1 text-sm text-gray-500"
                    >
                        <slot name="description" />
                    </p>
                </div>
                <div
                    v-if="hasActions"
                    class="ml-4 mt-2 flex-shrink-0"
                >
                    <slot name="actions" />
                </div>
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <slot name="content" />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Card',
        computed: {
            hasDescription() {
                return !! this.$slots.description;
            },
            hasActions() {
                return !! this.$slots.actions;
            },
        },
    };
</script>
