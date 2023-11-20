<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .title {
            margin-top: 50px;
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
        }

        .tables {
            margin-top: 50px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #eaeaea;
        }
    </style>
</head>

<body>
    <div>
        <div class="title">
            <h3>{{$title}}</h3>
        </div>
        <div class="tables">
            <table class="table">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Điểm bắt đầu</td>
                        <td>Điểm kết thúc</td>
                        <td>Ngày đi</td>
                        <td>Giờ đi</td>
                        <td>Giờ đến</td>
                    </tr>
                </thead>
                <tbody>
                    @php($a = 0);
                    @foreach ($trip as $trip)
                        @php($a += 1)
                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{ $trip->start_location }}</td>
                            <td>{{ $trip->end_location }}</td>
                            <td>{{ $trip->start_date }}</td>
                            <td>{{ $trip->start_time }}</td>
                            <td>{{ $trip->end_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
