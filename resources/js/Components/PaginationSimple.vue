<template>
    <nav
        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
        aria-label="Pagination"
    >
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Hiển thị từ
                <span class="font-medium">{{ from }}</span>
                đến
                <span class="font-medium">{{ to }}</span>
                trên tổng số
                <span class="font-medium">{{ total }}</span>
                kết quả
            </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
            <inertia-link
                v-if="prevPageUrl !== null"
                :href="prevPageUrl"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Trang trước
            </inertia-link>
            <span
                v-else
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 cursor-default"
            >
                Trang trước
            </span>
            <inertia-link
                v-if="nextPageUrl !== null"
                :href="nextPageUrl"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
                Trang sau
            </inertia-link>
            <span
                v-else
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 cursor-default"
            >
                Trang sau
            </span>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "PaginationSimple",
        props: ['from', 'to', 'total', 'prevPageUrl', 'nextPageUrl'],
    };
</script>
