     {{-- Chứa file chung ở trong thẻ head. File này là mặc định, không được thêm gì nữa vào đây --}}
     <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
     <!-- Layout config Js -->
     <script src="{{ asset('admin/assets/js/layout.js') }}"></script>
     <!-- Bootstrap Css -->
     <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <!-- Icons Css -->
     <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
     <!-- App Css-->
     <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- auth-page wrapper -->
     <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

         <!-- auth-page content -->
         <div class="auth-page-content overflow-hidden p-0">
             <div class="container">
                 <div class="row justify-content-center">
                     <div class="col-xl-7 col-lg-8">
                         <div class="text-center">
                             <img src="{{ asset('admin/assets/images/error400-cover.png') }}" alt="error img"
                                 class="img-fluid">
                             <div class="mt-3">
                                 <h3 class="text-uppercase">Xin lỗi, Trang không tồn tại 😭</h3>
                                 <p class="text-muted mb-4">Trang bạn đang tìm kiếm không có sẵn!</p>
                                 <a href="{{ route('admin.homepage') }}" class="btn btn-success">
                                     <i class="mdi mdi-home me-1"></i>
                                     Quay lại trang chủ
                                 </a>
                             </div>
                         </div>
                     </div><!-- end col -->
                 </div>
                 <!-- end row -->
             </div>
             <!-- end container -->
         </div>
         <!-- end auth-page content -->
     </div>
     <!-- end auth-page-wrapper -->
