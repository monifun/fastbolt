<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <div class="block h-10 w-auto fill-current text-gray-600">
                                <application-mark class="block h-9 w-auto" />
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <nav-link
                                :href="route('user.dashboard')"
                                :active="route().current('user.dashboard')"
                            >
                                Trang chủ
                            </nav-link>

                            <nav-link
                                :href="route('user.wallet.show')"
                                :active="route().current('user.wallet.*')"
                            >
                                Ví điện tử
                            </nav-link>

                            <nav-link
                                :href="route('user.cart.show')"
                                :active="route().current('user.cart.*')"
                            >
                                Giỏ hàng
                            </nav-link>

                            <nav-link
                                :href="route('user.orders.index')"
                                :active="route().current('user.orders.*')"
                            >
                                Đơn hàng
                            </nav-link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <drop-down
                                align="right"
                                width="48"
                            >
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <drop-down-link :href="route('user.profile.show')">
                                        Hồ sơ cá nhân
                                    </drop-down-link>

                                    <div class="border-t border-gray-100" />

                                    <drop-down-link
                                        :href="route('logout')"
                                        as="button"
                                        method="post"
                                    >
                                        Đăng xuất
                                    </drop-down-link>
                                </template>
                            </drop-down>
                        </div>
                    </div>
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            @click="showingNavigationDropdown = ! showingNavigationDropdown"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <responsive-nav-link
                        :href="route('user.dashboard')"
                        :active="route().current('user.dashboard')"
                    >
                        Trang chủ
                    </responsive-nav-link>

                    <responsive-nav-link
                        :href="route('user.wallet.show')"
                        :active="route().current('user.wallet.*')"
                    >
                        Ví điện tử
                    </responsive-nav-link>

                    <responsive-nav-link
                        :href="route('user.cart.show')"
                        :active="route().current('user.cart.*')"
                    >
                        Giỏ hàng
                    </responsive-nav-link>

                    <responsive-nav-link
                        :href="route('user.orders.index')"
                        :active="route().current('user.orders.*')"
                    >
                        Đơn hàng
                    </responsive-nav-link>

                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-10 w-10 fill-current text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <responsive-nav-link :href="route('user.profile.show')">
                                Hồ sơ cá nhân
                            </responsive-nav-link>

                            <!-- Authentication -->
                            <responsive-nav-link
                                :href="route('logout')"
                                as="button"
                                method="post"
                            >
                                Đăng xuất
                            </responsive-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>

<script>
    import ApplicationMark from "@/Components/ApplicationMark";
    import NavLink from "@/Components/NavLink";
    import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
    import DropDown from "@/Components/DropDown";
    import DropDownLink from "@/Components/DropDownLink";
    import currencyFilter from "@/Filters/currency";

    export default {
        name: "UserLayout",
        components: {ApplicationMark, NavLink, ResponsiveNavLink, DropDown, DropDownLink},
        data() {
            return {
                showingNavigationDropdown: false,
            };
        },
        methods: {
            currencyFilter,
        },
    };
</script>
