<template>
    <div class="flex items-center">
        <div class="flex w-full relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg
                    class="w-5 h-5 text-gray-500 text-opacity-70"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
            </div>
            <input
                id="search"
                type="text"
                name="search"
                :value="modelValue"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                placeholder="Tìm kiếm"
                autocomplete="off"
                @input="$emit('update:modelValue', $event.target.value)"
            >
        </div>
        <button
            class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
            type="button"
            @click="$emit('reset')"
        >
            Xóa
        </button>
    </div>
</template>

<script>
    export default {
        name: 'SearchFilter',
        props: ['modelValue'],
        emits: ['update:modelValue', 'reset'],
    };
</script>
