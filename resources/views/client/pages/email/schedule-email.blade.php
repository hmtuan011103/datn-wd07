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
        p {
            margin: 0;
            padding: 0;
        }
        h2{
            margin-bottom: 30px;
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

        .py-3 {
            padding: 18px 0;
        }

        .p-0 {
            padding: 0;
        }

        .mb-1 {
            margin-bottom: 8px;
        }
        .mb-2 {
            margin-bottom: 24px;
        }

        .color-text {
            color: #ff8c00;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <img src="https://raw.githubusercontent.com/hmtuan011103/AirTicket/main/logo_web.png" alt=""
             style="margin-left: 20px;">
    </div>
    <div class="content">
        <div class="booking-details">
            <h2>Xin chào, {{ $name }}!</h2>
            <p class="p-0 mb-1">Xin chúc mừng! Bạn vừa nhận được một mã ưu đãi đặc biệt từ chúng tôi.
            </p>
            <p class="p-0 mb-1">
                Đừng bỏ lỡ cơ hội để sử dụng mã giảm giá này khi thanh toán và tận hưởng mức giá
                ưu đãi đặc biệt cho hành trình của mình.
            </p>
            <p class="p-0 mb-1">
                Hãy nhanh tay, vì mã giảm giá chỉ có hiệu lực trong thời gian ngắn.
            </p>
            <p class="p-0 mb-2">
                Cảm ơn bạn đã lựa chọn Chiến Thắng Bus và chúc bạn có một chuyến đi thú vị!
            </p>
            <p class="p-0 mb-1">
                Trân trọng, Nhà Xe Chiến Thắng
            </p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2023 Chiến Thắng Bus. All rights reserved.</p>
    </div>
</div>
</body>

</html>
