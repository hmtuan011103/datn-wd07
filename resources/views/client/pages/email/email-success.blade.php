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
        <img src="https://raw.githubusercontent.com/hmtuan011103/AirTicket/main/logo_web.png"
             alt="" style="margin-left: 20px;">
    </div>
    <div class="content">
        <div class="booking-details">
            <h2>Xin chào, {{ $userName }}!</h2>
            <h4 class="mb-1">CHÚC MỪNG BẠN</h4>
            <p class="p-0">
                Chúng tôi rất vui thông báo rằng bạn đã đạt được đặc quyền {{$Vip}}. Đây là một bước quan trọng trên hành trình của bạn với chúng tôi, và chúng tôi muốn bày tỏ sự biết ơn sâu sắc vì sự cam kết và đóng góp của bạn.

                Với đặc quyền {{$Vip}}, bạn sẽ nhận được ưu đãi đặc biệt là một mã giảm giá {{$valuediscount}}{{$type_discount}}

                Hãy tiếp tục đồng hành cùng chúng tôi, và chúng tôi hy vọng rằng đặc quyền {{$Vip}} sẽ làm cho mọi trải nghiệm của bạn trở nên đặc biệt và không quên được.
            </p>
            <p class="p-0">
                Cảm ơn bạn một lần nữa và chúc mừng vì đã đạt được mốc quan trọng này!
            </p>
            <p class="p-0">
                Trân trọng, Nhà Xe Chiến Thắng
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2023 Chiến Thắng Bus. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
