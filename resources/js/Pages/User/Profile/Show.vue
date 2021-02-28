<template>
    <user-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Profile
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <update-profile-form :user="$page.props.auth.user" />

                <bolt-section-border />

                <update-password-form class="mt-10 sm:mt-0" />
            </div>
        </div>
    </user-layout>
</template>

<script>
    import UserLayout from "@/Layouts/UserLayout";
    import BoltSectionBorder from "@/Components/SectionBorder";
    import UpdateProfileForm from "@/Pages/User/Profile/UpdateProfileForm";
    import UpdatePasswordForm from "@/Pages/User/Profile/UpdatePasswordForm";
    export default {
        name: "Show",
        components: {UserLayout, BoltSectionBorder, UpdateProfileForm, UpdatePasswordForm},
    };
</script>

<style scoped>

</style>
