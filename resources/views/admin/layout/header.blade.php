
{{-- Chứa file chung ở trong thẻ head. File này là mặc định, không được thêm gì nữa vào đây --}}
<link rel="shortcut icon" href="{{ asset("admin/assets/images/favicon.ico") }}">
<!-- Layout config Js -->
<script src="{{ asset("admin/assets/js/layout.js") }}"></script>
<!-- Bootstrap Css -->
<link href="{{ asset("admin/assets/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset("admin/assets/css/icons.min.css") }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset("admin/assets/css/app.min.css") }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset("admin/assets/css/custom.min.css") }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .menu_admin{
        overflow-x: auto;
        white-space: nowrap;
    }
    .menu_admin::-webkit-scrollbar {
        display: none;
    }
</style>