<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Thông tin giao dịch
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <inline-svg
                        src="/svg/building_websites.svg"
                        fill="none"
                        aria-label="đang xây dựng"
                        class="h-60 w-auto"
                    />
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <p class="text-gray-500">
                        Nội dung trang đang được hoàn thiện, vui lòng trở lại sau.
                    </p>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    export default {
        name: "Show",
        components: {AdminLayout},
    };
</script>
