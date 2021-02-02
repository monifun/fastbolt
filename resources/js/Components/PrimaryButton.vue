<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        },
    };
</script>
