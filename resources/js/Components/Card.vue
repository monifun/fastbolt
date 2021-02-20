<template>
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h2 class="text-lg leading-6 font-medium text-gray-900">
                <slot name="title" />
            </h2>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <slot name="content" />
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Card',
    };
</script>
