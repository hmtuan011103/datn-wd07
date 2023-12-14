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

        .py-3 {
            padding: 18px 0;
        }

        .p-0 {
            padding: 0;
        }

        .mb-1 {
            margin-bottom: 8px;
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
            <div class="py-3">
                <p class="mb-1">
                    Chào quý khách hàng thân mến,
                <p class="mb-1">
                    Nhà Xe Chiến Thắng xin gửi lời tri ân chân thành đến quý khách hàng đã sử dụng dịch vụ của chúng
                    tôi trong chuyến đi gần đây.
                </p>
                    Chúng tôi trân trọng sự tin tưởng và ủng hộ từ phía quý khách hàng, và hy vọng rằng chúng tôi đã
                    đáp ứng đúng những mong đợi của quý vị. Đội ngũ lái xe và nhân viên của chúng tôi luôn nỗ lực
                    hết mình để mang lại trải nghiệm di chuyển an toàn, thuận lợi và thoải mái cho quý khách.
                <p class="mb-1">
                    Chúng tôi rất trân trọng ý kiến phản hồi từ phía quý khách để cải thiện chất lượng dịch vụ của
                    mình. Vì vậy, chúng tôi xin mời quý khách hàng dành chút thời gian để đánh giá chuyến đi gần đây
                    của mình. Ý kiến của quý khách sẽ giúp chúng tôi ngày càng hoàn thiện và mang lại trải nghiệm
                    tốt nhất cho tất cả khách hàng của Nhà Xe Chiến Thắng.
                </p>
                <p class="mb-1">
                    Cảm ơn quý khách hàng một lần nữa và mong được phục vụ quý vị trong những chuyến đi sắp tới.
                </p>
                <p class="mb-1">
                    Trân trọng, Nhà Xe Chiến Thắng
                </p>

            </div>
            <a href="{{ route('review') }}" class="button">Đánh Giá Chuyến Đi</a>
        </div>
        <div class="footer">
            <p>&copy; 2023 Chiến Thắng Bus. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
