<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    {{-- Hiển thị tiêu đề cho mỗi trang tại đây với $title --}}
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- File js chung cho mọi giao diện --}}
    @include('admin.layout.header')

    {{-- Thay đổi file css của các giao diện bằng yeild style --}}
    @yield('style')
    <style>
        .error-help-block {
            color: red;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">

        @include('admin.partials.top-bar')

        @include('admin.partials.notification-modal')

        @include('admin.partials.app-menu')

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- Main Content-->
        @yield('content')

        @include('admin.partials.back-to-top')

        @include('admin.partials.preloader')

        {{-- @include('admin.partials.customizer-setting') --}}

        {{-- @include('admin.partials.theme-settings') --}}

    </div>

    {{-- File js chung cho mọi giao diện --}}
    @include('admin.layout.footer')

    {{-- Thay đổi file js của các giao diện bằng yeild script --}}
    @yield('script')
</body>

</html>
