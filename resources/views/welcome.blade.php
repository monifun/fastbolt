<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/mark.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @routes
    </head>
    <body class="font-sans antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-50 sm:items-center sm:pt-0">
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('user.dashboard') }}" class="text-sm text-gray-700 underline">Tài khoản</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Đăng ký</a>
                @endauth
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg width="634" height="212" viewBox="0 0 634 212" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 sm:h-20">
                        <path d="M159.096 28.1933C154.659 20.4925 146.443 15.7399 137.567 15.7399H132.712L108.674 96.1149L149.224 94.7938L83.5277 195.967L73.3018 211.707L97.0979 195.967H137.567C146.443 195.967 154.659 191.215 159.096 183.514L196.672 118.315C201.109 110.614 201.109 101.109 196.672 93.4083L159.096 28.1933Z" fill="url(#paint0_linear)"/>
                        <path d="M91.3257 123.632L50.7758 124.953L121.698 15.7399L131.892 0L108.095 15.7399H62.4327C53.5413 15.7399 45.3413 20.4925 40.9036 28.1933L3.32824 93.3922C-1.10941 101.093 -1.10941 110.598 3.32824 118.299L40.9036 183.498C45.3413 191.199 53.5573 195.951 62.4327 195.951H69.2982L91.3257 123.632Z" fill="url(#paint1_linear)"/>
                        <path d="M262 52.84H275.28V153H260.72L239.6 80.68V153H226.32V52.84H241.52L262 123.08V52.84ZM304.585 74.92H321.705C331.625 74.92 336.585 79.6667 336.585 89.16V138.92C336.585 148.307 331.625 153 321.705 153H304.585C294.772 153 289.865 148.307 289.865 138.92V89.16C289.865 79.6667 294.772 74.92 304.585 74.92ZM322.345 136.84V91.08C322.345 89.16 322.025 87.88 321.385 87.24C320.745 86.6 319.465 86.28 317.545 86.28H308.745C306.825 86.28 305.545 86.6 304.905 87.24C304.372 87.88 304.105 89.16 304.105 91.08V136.84C304.105 138.76 304.372 140.04 304.905 140.68C305.545 141.32 306.825 141.64 308.745 141.64H317.545C319.465 141.64 320.745 141.32 321.385 140.68C322.025 140.04 322.345 138.76 322.345 136.84ZM357.884 74.92L368.124 140.84L378.524 74.92H392.924L378.524 153H357.884L343.484 74.92H357.884ZM429.785 74.92H444.185V153H429.785V146.76C428.398 150.92 425.092 153 419.865 153H414.105C404.505 153 399.705 148.307 399.705 138.92V89.16C399.705 79.6667 404.505 74.92 414.105 74.92H419.865C425.092 74.92 428.398 77 429.785 81.16V74.92ZM418.905 141.32H424.505C426.425 141.32 427.758 140.893 428.505 140.04C429.358 139.187 429.785 137.747 429.785 135.72V92.2C429.785 90.1733 429.358 88.7333 428.505 87.88C427.758 87.0267 426.425 86.6 424.505 86.6H418.905C416.985 86.6 415.705 86.92 415.065 87.56C414.425 88.0933 414.105 89.32 414.105 91.24V136.68C414.105 138.6 414.425 139.88 415.065 140.52C415.705 141.053 416.985 141.32 418.905 141.32ZM482.641 74.76H488.241C497.948 74.76 502.801 79.5067 502.801 89V138.92C502.801 148.307 497.948 153 488.241 153H482.641C477.415 153 474.108 150.92 472.721 146.76V153H458.321V45.96H472.721V81C474.108 76.84 477.415 74.76 482.641 74.76ZM488.401 136.68V91.08C488.401 89.2667 488.081 88.04 487.441 87.4C486.801 86.76 485.521 86.44 483.601 86.44H478.001C476.081 86.44 474.695 86.8667 473.841 87.72C473.095 88.5733 472.721 90.0133 472.721 92.04V135.72C472.721 137.747 473.095 139.187 473.841 140.04C474.695 140.893 476.081 141.32 478.001 141.32H483.601C485.521 141.32 486.801 141.053 487.441 140.52C488.081 139.88 488.401 138.6 488.401 136.68ZM529.898 74.92H547.018C556.938 74.92 561.898 79.6667 561.898 89.16V138.92C561.898 148.307 556.938 153 547.018 153H529.898C520.084 153 515.178 148.307 515.178 138.92V89.16C515.178 79.6667 520.084 74.92 529.898 74.92ZM547.658 136.84V91.08C547.658 89.16 547.338 87.88 546.698 87.24C546.058 86.6 544.778 86.28 542.858 86.28H534.058C532.138 86.28 530.858 86.6 530.218 87.24C529.684 87.88 529.418 89.16 529.418 91.08V136.84C529.418 138.76 529.684 140.04 530.218 140.68C530.858 141.32 532.138 141.64 534.058 141.64H542.858C544.778 141.64 546.058 141.32 546.698 140.68C547.338 140.04 547.658 138.76 547.658 136.84ZM589.596 153H575.196V45.96H589.596V153ZM630.034 86.6H619.314V136.04C619.314 137.96 619.58 139.24 620.114 139.88C620.754 140.413 622.034 140.68 623.954 140.68H630.034V153H619.794C609.767 153 604.754 148.307 604.754 138.92V86.6H597.394V74.92H604.754V61.64H619.314V74.92H630.034V86.6Z" fill="url(#paint2_linear)"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="207.731" y1="38.2766" x2="36.1143" y2="209.553" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFED00"/>
                                <stop offset="0.513" stop-color="#E6007E"/>
                                <stop offset="1" stop-color="#009FE3"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="167.943" y1="-1.59073" x2="-3.67527" y2="169.687" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFED00"/>
                                <stop offset="0.513" stop-color="#E6007E"/>
                                <stop offset="1" stop-color="#009FE3"/>
                            </linearGradient>
                            <linearGradient id="paint2_linear" x1="747.71" y1="-1.72101" x2="633.563" y2="330.396" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFED00"/>
                                <stop offset="0.513" stop-color="#E6007E"/>
                                <stop offset="1" stop-color="#009FE3"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6">
                        <h1 class="text-xl font-medium">
                            Chào mừng đến với Fastbolt!
                        </h1>
                        <p class="mt-5 text-gray-500">
                            Fastbolt là dự án mã nguồn mở cung cấp đầy đủ các tính năng cần thiết để bạn có thể bắt đầu
                            xây dựng một hệ thống dịch vụ mua hàng hộ của riêng mình. Bằng tất cả sự cẩn thận và tỉ mỉ
                            trong suốt quá trình xây dựng, chúng tôi tin rằng Fastbolt sẽ là điểm khởi đầu hoàn hảo
                            dành cho bạn. Hy vọng bạn sẽ thích sản phẩm này.
                        </p>
                    </div>

                    <div class="bg-gray-50 grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="https://docs.novabolt.dev" class="underline text-gray-900">
                                        Tài liệu
                                    </a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 text-sm">
                                    Tham khảo tài liệu hướng dẫn chi tiết về quy trình cài đặt và vận hành hệ thống này.
                                    Cho dù bạn là người mới hay đã có kinh nghiệm với Fastbolt, chúng tôi khuyên bạn nên đọc kỹ hướng dẫn sử dụng trước khi dùng.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900">
                                    Giỏ hàng
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 text-sm">
                                    Kết hợp với tiện ích mở rộng hỗ trợ phân tích và trích xuất dữ liệu sản phẩm chính
                                    xác giúp việc mua sắm trở nên dễ dàng hơn bao giờ hết.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900">
                                    Thông báo
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 text-sm">
                                    Gửi thông báo đến Khách hàng và Quản trị viên ngay lập tức thông qua Email hoặc các
                                    kênh nhắn tin trực tuyến mỗi khi có đơn hàng mới hoặc các thông tin liên quan được
                                    cập nhật trên hệ thống.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900">
                                    Ví điện tử
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 text-sm">
                                    Toàn bộ giao dịch trên hệ thống đều được thông qua Ví điện tử giúp Khách hàng có thể
                                    nắm bắt được tình hình thu chi của mình cũng như Quản trị viên có thể kiểm soát
                                    được tình hình công nợ của doanh nghiệp.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <div class="text-sm text-gray-500">
                        MIT Licensed | Copyright &copy; {{ date('Y') }} Duong Truong &amp; <a href="https://www.novabolt.dev" class="hover:underline">Novabolt</a> team.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
