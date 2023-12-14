<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('client/assets/css/checkout.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

<body>
<div class="container">
    <div class="py-4 text-center">
        <div>
            <i class="fa-solid fa-circle-xmark" style="font-size: 64px; color: #8BE2D3;"></i>
        </div>
        <p class="fs-4 mb-1" style="color: #3C7054;">Mua vé xe thất bại</p>
        <p class="fs-6">Có một số lỗi xảy ra trong quá trình thanh toán! Vui lòng thử lại</p>
        <div class="row justify-content-center px-3">
            <div class="col-lg-3 col-md-6 col-xs-12 text-center">
                <a href="{{ route('order_ticket-admin') }}" class="btn w-100 fw-medium button-important text-decoration-none d-flex justify-content-center">
                    <div>
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="ps-2">
                        Trang chủ
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</body>

</html>
