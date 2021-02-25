<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Create new product
                    </h1>
                </div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    export default {
        name: "Create",
        components: {AdminLayout},
    };
</script>

<style scoped>

</style>
