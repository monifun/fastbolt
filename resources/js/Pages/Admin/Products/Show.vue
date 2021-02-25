<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Product details
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.products.edit', product)"
                        class="inline-flex items-center px-4 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Edit
                    </inertia-link>
                </div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    export default {
        name: "Show",
        components: {AdminLayout},
        props: ['product'],
    };
</script>

<style scoped>

</style>
