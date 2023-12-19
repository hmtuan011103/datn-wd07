<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="vi">
    <title>Vé</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 20px 10px;
        }

        .ticket {
            width: 350px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-bottom: none;
            border-radius: 8px 8px;
        }
        .ticket .logo {
            width: 100%;
            text-align: center;
            margin: 10px 0 20px 0;
        }

        .ticket-details {
            max-width: 600px;
            height: 270px;
            margin: 0 auto;
            padding: 10px 20px;
        }
        .title p,
        .data p {
            font-size: 15px;
            /* font-weight: 600; */
            padding: 5px 0;
            color: gray;
        }
        .title {
            float: left;
            width: 40%;
        }

        .data {
            float: right;
            width: 60%;
            clear: right;
            text-align: right;
        }
        .data .route,
        .data .time,
        .data .seat {
            color: green
        }

        .data .location{
            color:black
        }
        .data .price{
            color: red
        }
        .title p,
        .data p {
            margin: 5px 0;
        }

        .ticket-footer {
            text-align: center;
            border: 1px solid rgb(225, 225, 225);
            width: 95%;
            height: 50px;
            border-radius: 0 0 8px 8px;
            border-top: none;
            padding: 8px 8px 0 8px;
            background-color: #F7F7F7;
            font-size: 10px;
            /* font-weight: 500; */
            color: green;
        }  
        
        .title-ticket{
            text-align: center;
        }
        .ttcty{
            padding: 0 0 0 10px;
        }
        .ttcty p {
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        @foreach ($tickets as $ticket)
            <div class="ticket">
                <div class="logo">
                    <img src="data:image/jpg;base64,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" alt="" width="70%">
                </div>
                <div class="ttcty">
                    <p>CÔNG TY TNHH CHIẾN THẮNG BUS <br>
                    ĐC:Địa chỉ: Tòa nhà FPT Polytechnic, Phố Trịnh Văn Bô,
                        Nam Từ Liêm, Hà Nội. <br>
                    ĐT: 0999999999 - MST: 0999999999999</p>
                </div>
                <div class="title-ticket">
                    <h3>VÉ XE KHÁCH</h3>
                    <h5>TUYẾN ĐƯỜNG: <br> {{$ticket->bill->trip->route->name}}</h5>
                </div>
                <div class="ticket-details">
                    <div class="title">
                        <p><b>Mã vé:</b> </p>
                        <p><b>Thời gian:</b> </p>
                        <p><b>Biển số xe:</b> </p>
                        <p><b>Số ghế:</b> </p>
                        <p><b>Điểm đón:</b> </p>
                        <p><b>Điểm trả:</b> </p>
                        <p><b>Giá vé:</b> </p>
                    </div>
                    <div class="data">
                        <p class="time"><b>{{$ticket->code_ticket}}</b></p>
                        <p class="time"><b>{{$ticket->time_start}}</b></p>
                        <p class="seat"><b>{{$ticket->bill->trip->car->license_plate}}</b></p>
                        <p class="seat"><b>{{$ticket->code_seat}}</b></p>
                        <p class="location"><b>{{$ticket->pickup_location}}</b></p>
                        <p class="location"><b>{{$ticket->pay_location}}</b></p>
                        <p class="price"><b>{{number_format($ticket->bill->trip->trip_price, 0, ',', '.') }}đ</b></p>
                    </div>
                </div>
                <div class="ticket-footer">
                    <p><b>Hãy mang mã vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít nhất 60 phút</b></p>
                </div>
            </div>
            @if ($number_ticket != 1)
            -------------------------------------------------------------------------------------
            @endif
        @endforeach
    </div>


    <!-- Các thông tin khác về vé -->

</body>

</html>
