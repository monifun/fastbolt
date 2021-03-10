<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <transition :duration="300">
            <div
                v-show="showingSidebarNavigation"
                class="lg:hidden"
            >
                <div class="fixed inset-0 flex z-40">
                    <!-- Off-canvas menu overlay, show/hide based on off-canvas menu state. -->
                    <transition
                        enter-active-class="transition-opacity ease-linear duration-300"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition-opacity ease-linear duration-300"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div
                            v-show="showingSidebarNavigation"
                            class="fixed inset-0"
                            aria-hidden="true"
                            @click="showingSidebarNavigation = false"
                        >
                            <div class="absolute inset-0 bg-gray-600 opacity-75" />
                        </div>
                    </transition>

                    <!-- Off-canvas menu, show/hide based on off-canvas menu state. -->
                    <transition
                        enter-active-class="transition ease-in-out duration-300 transform"
                        enter-from-class="-translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transition ease-in-out duration-300 transform"
                        leave-from-class="translate-x-0"
                        leave-to-class="-translate-x-full"
                    >
                        <div
                            v-show="showingSidebarNavigation"
                            class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white"
                        >
                            <!-- Close menu button -->
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="showingSidebarNavigation = false"
                                >
                                    <span class="sr-only">Đóng lại</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg
                                        class="h-6 w-6 text-white"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>

                            <!-- Application Logo -->
                            <div class="flex-shrink-0 flex items-center px-4">
                                <img
                                    src="/img/logo.png"
                                    class="h-8 w-auto"
                                    :alt="$page.props.app.name"
                                >
                            </div>

                            <!-- Main navigation -->
                            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                                <nav class="px-2 space-y-1">
                                    <!-- Dashboard -->
                                    <inertia-link
                                        :href="route('admin.dashboard')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.dashboard')}"
                                    >
                                        <!-- Heroicon name: outline/home -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                            />
                                        </svg>
                                        Trang chủ
                                    </inertia-link>

                                    <!-- Users -->
                                    <inertia-link
                                        :href="route('admin.users.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.users.*')}"
                                    >
                                        <!-- Heroicon name: outline/users -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                            />
                                        </svg>
                                        Người dùng
                                    </inertia-link>

                                    <!-- Markets -->
                                    <inertia-link
                                        :href="route('admin.markets.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.markets.*')}"
                                    >
                                        <!-- Heroicon name: library -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                                            />
                                        </svg>
                                        Thị trường
                                    </inertia-link>

                                    <!-- Vendors -->
                                    <inertia-link
                                        :href="route('admin.vendors.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.vendors.*')}"
                                    >
                                        <!-- Heroicon name: outline/identification -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                                            />
                                        </svg>
                                        Cửa hàng
                                    </inertia-link>

                                    <!-- Products -->
                                    <inertia-link
                                        :href="route('admin.products.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.products.*')}"
                                    >
                                        <!-- Heroicon name: outline/document-text -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                        Sản phẩm
                                    </inertia-link>

                                    <!-- Orders -->
                                    <inertia-link
                                        :href="route('admin.orders.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.orders.*')}"
                                    >
                                        <!-- Heroicon name: outline/clipboard-list -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                            />
                                        </svg>
                                        Đơn hàng
                                    </inertia-link>

                                    <!-- Transactions -->
                                    <inertia-link
                                        :href="route('admin.transactions.index')"
                                        class="text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-gray-50"
                                        :class="{'bg-gray-100': route().current('admin.transactions.*')}"
                                    >
                                        <!-- Heroicon name: outline/refresh -->
                                        <svg
                                            class="text-gray-500 mr-4 h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                            />
                                        </svg>
                                        Giao dịch
                                    </inertia-link>
                                </nav>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </transition>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img
                            src="/img/logo.png"
                            class="h-8 w-auto"
                            :alt="$page.props.app.name"
                        >
                    </div>
                    <div class="mt-5 flex-grow flex flex-col">
                        <nav class="flex-1 px-2 bg-white space-y-1">
                            <!-- Dashboard -->
                            <inertia-link
                                :href="route('admin.dashboard')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.dashboard')}"
                            >
                                <!-- Heroicon name: outline/home -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    />
                                </svg>
                                Trang chủ
                            </inertia-link>

                            <!-- Users -->
                            <inertia-link
                                :href="route('admin.users.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.users.*')}"
                            >
                                <!-- Heroicon name: outline/users -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                    />
                                </svg>
                                Người dùng
                            </inertia-link>

                            <!-- Markets -->
                            <inertia-link
                                :href="route('admin.markets.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.markets.*')}"
                            >
                                <!-- Heroicon name: library -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                                    />
                                </svg>
                                Thị trường
                            </inertia-link>

                            <!-- Vendors -->
                            <inertia-link
                                :href="route('admin.vendors.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.vendors.*')}"
                            >
                                <!-- Heroicon name: outline/identification -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                                    />
                                </svg>
                                Cửa hàng
                            </inertia-link>

                            <!-- Products -->
                            <inertia-link
                                :href="route('admin.products.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.products.*')}"
                            >
                                <!-- Heroicon name: outline/document-text -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                                Sản phẩm
                            </inertia-link>

                            <!-- Orders -->
                            <inertia-link
                                :href="route('admin.orders.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.orders.*')}"
                            >
                                <!-- Heroicon name: outline/clipboard-list -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                                    />
                                </svg>
                                Đơn hàng
                            </inertia-link>

                            <!-- Transactions -->
                            <inertia-link
                                :href="route('admin.transactions.index')"
                                class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md hover:bg-gray-50"
                                :class="{'bg-gray-100': route().current('admin.transactions.*')}"
                            >
                                <!-- Heroicon name: outline/refresh -->
                                <svg
                                    class="text-gray-500 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                    />
                                </svg>
                                Giao dịch
                            </inertia-link>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
                <button
                    class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
                    @click="showingSidebarNavigation = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <!-- Heroicon name: outline/menu-alt-1 -->
                    <svg
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16"
                        />
                    </svg>
                </button>
                <!-- Search bar -->
                <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
                    <div class="flex-1 flex">
                        <form
                            class="w-full flex md:ml-0"
                            action="#"
                            method="GET"
                        >
                            <label
                                for="search_field"
                                class="sr-only"
                            >
                                Tìm kiếm
                            </label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none"
                                    aria-hidden="true"
                                >
                                    <!-- Heroicon name: solid/search -->
                                    <svg
                                        class="h-5 w-5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <input
                                    id="search_field"
                                    name="search_field"
                                    class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm"
                                    placeholder="Tìm kiếm"
                                    type="search"
                                >
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <drop-down
                                align="right"
                                width="48"
                            >
                                <template #trigger>
                                    <button
                                        id="user-menu"
                                        class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50"
                                        aria-haspopup="true"
                                    >
                                        <svg
                                            class="h-8 w-8 fill-current text-gray-400 rounded-full bg-gray-200 p-0.5"
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
                                        <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block">
                                            {{ $page.props.auth.user.name }}
                                        </span>
                                        <!-- Heroicon name: solid/chevron-down -->
                                        <svg
                                            class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <drop-down-link
                                        :href="route('logout')"
                                        as="button"
                                        method="post"
                                    >
                                        Logout
                                    </drop-down-link>
                                </template>
                            </drop-down>
                        </div>
                    </div>
                </div>
            </div>

            <main
                class="flex-1 relative overflow-y-auto focus:outline-none"
                tabindex="0"
                scroll-region
            >
                <!-- Page header -->
                <div class="bg-white shadow">
                    <div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
                        <div class="py-6 lg:border-t lg:border-gray-200">
                            <slot name="header" />
                        </div>
                    </div>
                </div>

                <!-- Page content -->
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
    import DropDown from "../Components/DropDown";
    import DropDownLink from "../Components/DropDownLink";
    export default {
        name: "AdminLayout",
        components: {DropDown, DropDownLink},
        data() {
            return {
                showingSidebarNavigation: false,
            };
        },
    };
</script>
