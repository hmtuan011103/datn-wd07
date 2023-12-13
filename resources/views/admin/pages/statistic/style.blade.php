 <!-- Sweet Alert css-->
 <link rel="stylesheet" href={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}>
<!-- jsvectormap css -->
<link href={{ asset("admin/assets/libs/jsvectormap/css/jsvectormap.min.css") }} rel="stylesheet" type="text/css" />
<!--Swiper slider css-->
<link href="{{ asset("admin/assets/libs/swiper/swiper-bundle.min.css") }}" rel="stylesheet" type="text/css" />
<style>
    canvas {
    max-width:100%; /* Đảm bảo bảng không vượt quá chiều rộng của cha nó */
    height: 100px; /* Để bảng tự điều chỉnh chiều cao tùy theo tỉ lệ khung hình */
}
.form {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.rowData{
    background-color: white;
}
.filter {
   padding-right: 10px;
    width: 200px
}
.form-data{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>