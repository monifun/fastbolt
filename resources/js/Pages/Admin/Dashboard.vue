<template>
    <admin-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";

    export default {
        name: "Dashboard",
        components: {AdminLayout},
    };
</script>