<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Vendor details
            </h1>
        </template>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    export default {
        name: "Show",
        components: {AdminLayout},
    };
</script>
