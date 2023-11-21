<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Orange Theme</title>
    <style>
        /* Reset CSS */
        body,
        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #ff8c00;
            color: #fff;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .booking-details {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #ff8c00;
            color: #fff;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 0px;
            color: #777;
            padding: 10px;
        }
        .py-3{
            padding: 18px 0;
        }
        .p-0{
            padding: 0;
        }
        .mb-1{
            margin-bottom: 8px;
        }
        .color-text{
            color: #ff8c00;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <img src="{{ asset('client/assets/images/logo_web.png') }}" alt="" style="margin-left: 20px;">
    </div>
    <div class="content">
        <div class="booking-details">
            <h2>Xin chào, {{ $data['name'] }}!</h2>
            <h4 class="mb-1">CHÚC MỪNG BẠN</h4>
            <p class="p-0">Việc mua vé online của bạn đã thành công. Và dưới đây là thông tin mua vé của bạn.</p>
            <div class="py-3">
                <p class="mb-1"><strong>Mã đặt vé: </strong><b class="color-text">FB12354D</b></p>
                <p class="mb-1"><strong>Tuyển đường: </strong><b class="color-text">Hải Phòng ⇒ Thanh Hóa</b></p>
                <p class="mb-1"><strong>Điểm đón: </strong><b class="color-text">Đại Học Hàng Hải</b></p>
                <p class="mb-1"><strong>Điểm trả: </strong><b class="color-text">Sầm Sơn</b></p>
                <p class="mb-1"><strong>Vị trí ghế: </strong><b class="color-text">A34, B43, A12</b></p>
            </div>
        </div>
        <p class="mb-1"><b>Lưu ý:</b>  Đây là thông tin cần được bảo mật, quý khách vui lòng không chia sẻ thông tin này cho bất kì ai để tránh việc mất vé. </p>
        <a href="#" class="button">Xem chi tiết vé đặt</a>
    </div>
    <div class="footer">
        <p>&copy; 2023 Chiến Thắng Bus. All rights reserved.</p>
    </div>
</div>
</body>

</html>
