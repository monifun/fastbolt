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
                    <svg width="617" height="212" viewBox="0 0 617 212" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class="h-16 w-auto text-gray-700 sm:h-20">
                        <path
                            d="M168.096 28.1933C163.659 20.4925 155.443 15.7399 146.567 15.7399H141.712L117.674 96.1149L158.224 94.7938L92.5276 195.967L82.3017 211.707L106.098 195.967H146.567C155.443 195.967 163.659 191.215 168.096 183.514L205.672 118.315C210.109 110.614 210.109 101.109 205.672 93.4083L168.096 28.1933Z"
                            fill="url(#paint0_linear)"/>
                        <path
                            d="M100.326 123.632L59.7758 124.953L130.698 15.7399L140.892 0L117.095 15.7399H71.4327C62.5413 15.7399 54.3413 20.4925 49.9036 28.1933L12.3282 93.3922C7.89059 101.093 7.89059 110.598 12.3282 118.299L49.9036 183.498C54.3413 191.199 62.5573 195.951 71.4327 195.951H78.2982L100.326 123.632Z"
                            fill="url(#paint1_linear)"/>
                        <path
                            d="M279 64.52H249.88V97.48H272.92V108.84H249.88V153H235.32V52.84H279V64.52ZM316.285 74.92H330.685V153H316.285V146.76C314.898 150.92 311.592 153 306.365 153H300.605C291.005 153 286.205 148.307 286.205 138.92V89.16C286.205 79.6667 291.005 74.92 300.605 74.92H306.365C311.592 74.92 314.898 77 316.285 81.16V74.92ZM305.405 141.32H311.005C312.925 141.32 314.258 140.893 315.005 140.04C315.858 139.187 316.285 137.747 316.285 135.72V92.2C316.285 90.1733 315.858 88.7333 315.005 87.88C314.258 87.0267 312.925 86.6 311.005 86.6H305.405C303.485 86.6 302.205 86.92 301.565 87.56C300.925 88.0933 300.605 89.32 300.605 91.24V136.68C300.605 138.6 300.925 139.88 301.565 140.52C302.205 141.053 303.485 141.32 305.405 141.32ZM370.901 137.32V124.36C370.901 122.44 370.581 121.213 369.941 120.68C369.301 120.04 368.021 119.72 366.101 119.72H357.941C348.021 119.72 343.061 115.027 343.061 105.64V89.16C343.061 79.6667 348.021 74.92 357.941 74.92H369.621C379.648 74.92 384.661 79.6667 384.661 89.16V96.68H370.581V90.6C370.581 88.68 370.261 87.4533 369.621 86.92C368.981 86.28 367.701 85.96 365.781 85.96H361.941C360.021 85.96 358.741 86.28 358.101 86.92C357.461 87.4533 357.141 88.68 357.141 90.6V104.04C357.141 105.96 357.461 107.24 358.101 107.88C358.741 108.413 360.021 108.68 361.941 108.68H370.261C380.075 108.68 384.981 113.427 384.981 122.92V138.92C384.981 148.307 380.021 153 370.101 153H358.261C348.341 153 343.381 148.307 343.381 138.92V131.24H357.461V137.32C357.461 139.24 357.781 140.52 358.421 141.16C359.061 141.693 360.341 141.96 362.261 141.96H366.101C368.021 141.96 369.301 141.693 369.941 141.16C370.581 140.52 370.901 139.24 370.901 137.32ZM423.721 86.6H413.001V136.04C413.001 137.96 413.268 139.24 413.801 139.88C414.441 140.413 415.721 140.68 417.641 140.68H423.721V153H413.481C403.455 153 398.441 148.307 398.441 138.92V86.6H391.081V74.92H398.441V61.64H413.001V74.92H423.721V86.6ZM456.641 74.76H462.241C471.948 74.76 476.801 79.5067 476.801 89V138.92C476.801 148.307 471.948 153 462.241 153H456.641C451.415 153 448.108 150.92 446.721 146.76V153H432.321V45.96H446.721V81C448.108 76.84 451.415 74.76 456.641 74.76ZM462.401 136.68V91.08C462.401 89.2667 462.081 88.04 461.441 87.4C460.801 86.76 459.521 86.44 457.601 86.44H452.001C450.081 86.44 448.695 86.8667 447.841 87.72C447.095 88.5733 446.721 90.0133 446.721 92.04V135.72C446.721 137.747 447.095 139.187 447.841 140.04C448.695 140.893 450.081 141.32 452.001 141.32H457.601C459.521 141.32 460.801 141.053 461.441 140.52C462.081 139.88 462.401 138.6 462.401 136.68ZM503.898 74.92H521.018C530.938 74.92 535.898 79.6667 535.898 89.16V138.92C535.898 148.307 530.938 153 521.018 153H503.898C494.084 153 489.178 148.307 489.178 138.92V89.16C489.178 79.6667 494.084 74.92 503.898 74.92ZM521.658 136.84V91.08C521.658 89.16 521.338 87.88 520.698 87.24C520.058 86.6 518.778 86.28 516.858 86.28H508.058C506.138 86.28 504.858 86.6 504.218 87.24C503.684 87.88 503.418 89.16 503.418 91.08V136.84C503.418 138.76 503.684 140.04 504.218 140.68C504.858 141.32 506.138 141.64 508.058 141.64H516.858C518.778 141.64 520.058 141.32 520.698 140.68C521.338 140.04 521.658 138.76 521.658 136.84ZM563.596 153H549.196V45.96H563.596V153ZM604.034 86.6H593.314V136.04C593.314 137.96 593.58 139.24 594.114 139.88C594.754 140.413 596.034 140.68 597.954 140.68H604.034V153H593.794C583.767 153 578.754 148.307 578.754 138.92V86.6H571.394V74.92H578.754V61.64H593.314V74.92H604.034V86.6Z"
                            fill="url(#paint2_linear)"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="216.731" y1="38.2766" x2="45.1143" y2="209.553" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFED00"/>
                                <stop offset="0.513" stop-color="#E6007E"/>
                                <stop offset="1" stop-color="#009FE3"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="176.943" y1="-1.59073" x2="5.32473" y2="169.687" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFED00"/>
                                <stop offset="0.513" stop-color="#E6007E"/>
                                <stop offset="1" stop-color="#009FE3"/>
                            </linearGradient>
                            <linearGradient id="paint2_linear" x1="723.603" y1="-1.72101" x2="603.593" y2="325.631" gradientUnits="userSpaceOnUse">
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
