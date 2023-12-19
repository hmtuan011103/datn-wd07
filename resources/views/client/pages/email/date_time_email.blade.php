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
            <h2>Xin chào, {{ $user->name}}!</h2>
            <div class="py-3">
                <p class="mb-1">
                    @php
                        use Carbon\Carbon;
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $tripInfo->start_date)->format('d-m-Y');
                        $startTime = Carbon::createFromFormat('H:i:s', $tripInfo->start_time)->format('H\hi');
                    @endphp
                    Bạn vừa hoàn thành chuyến đi từ <b>{{$tripInfo->start_location}}</b> <b>⇒</b> <b>{{$tripInfo->end_location}}</b> khởi hành lúc
                    <b>{{$startTime}}</b> ngày <b>{{$startDate}}</b>.
                </p>
                <p class="mb-1">
                    Chúng tôi mong muốn bạn hãy đánh giá,đóng góp ý kiến của mình. Để chúng tôi có thể cải thiện
                    dịch vụ được tốt hơn cho những trải nghiệm lần sau.
                </p>
                <p class="mb-1">
                    Cảm ơn quý khách hàng đã ủng hộ xe khách Chiến Thắng.
                </p>
                <p class="mb-1">
                    Trân trọng, Nhà Xe Chiến Thắng
                </p>

            </div>
            <a href="{{ route('review', ['id_trip' => $tripInfo->id, 'id_user' => $user->id]) }}" class="button">Đánh Giá Chuyến Đi</a>
        </div>
        <div class="footer">
            <p>&copy; 2023 Chiến Thắng Bus. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
