<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('client/assets/css/checkout.css') }}">
</head>

<body>
<div class="container">
    <div class="pt-4 text-center">
        <div>
            <i class="fa-solid fa-circle-check" style="font-size: 64px; color: #8BE2D3;"></i>
        </div>
        <p class="fs-4 mb-1" style="color: #3C7054;">Mua vé xe thành công</p>
        <p class="fs-6">Chiến thắng đã gửi thông tin vé đã đặt về địa chỉ email và số điện thoại của bạn</p>
    </div>
    <div class="table">
        <div class="title">
            <h5 class="py-3 fw-bold">THÔNG TIN MUA VÉ</h5>
        </div>
        <div class="row detail-user text-user px-3">
            <div class="col-md-6 text-user">
                <div class="detail-user-one">
                    <p class="label-infor">Họ và tên : </p>
                    <p class="label-infor">Số điện thoại : </p>
                    <p class="label-infor">Email : </p>
                </div>

                <div class="detail-user-two">
                    @if($inforUser !== null)
                        <p class="label-user">{{ $inforUser['name'] }}</p>
                        <p class="label-user">{{ $inforUser['phone_number'] }}</p>
                        <p class="label-user">{{ $inforUser['email'] }}</p>
                    @endif
                </div>

            </div>
            <div class="col-md-6 text-user">
                <div class="detail-user-one">
                    <p class="label-infor">Tổng tiền đã thanh toán : </p>
                    <p class="label-infor">PTTT : </p>
                    <p class="label-infor">Trạng thái : </p>
                </div>
                <div class="detail-user-two">
                    <p class="label-user">{{ number_format($totalMoney, 0, '.', '.') }}đ</p>
                    <p class="label-user">VNPAY</p>
                    <p class="label-user pttt">Đã thanh toán</p>
                </div>
            </div>
        </div>
        <div class="row px-3">
            @foreach($data['turn'] as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12 mb-3">
                    <div class="detail-ticket">
                        <p class="text-center fw-bold">Mã vé: {{ $item->code_ticket }}</p>
                        <div class="logo-qr-turn d-flex justify-content-center mb-3" data-code="{{ $item->code_ticket }}">
                        </div>
                        <div class=" order-ticket">
                            <div class="column-ticket text">
                                <p>Tên tuyến</p>
                                <p>Thời gian</p>
                                <p>Số ghế</p>
                                <p>Điểm lên xe</p>
                                <p>Điểm trả khách</p>
                                <p>Giá vé</p>
                            </div>
                            <div class="column-ticket data">
                                <p>
                                    <label>{{ $item->bill->trip->start_location }} - </label>
                                    <label>{{ $item->bill->trip->end_location  }}</label>
                                </p>

                                <p>
                                    <label style="margin-right: 5px;">{{ \Carbon\Carbon::parse($item->bill->trip->start_time)->format('H:i') }}</label>
                                    <label>{{ \Carbon\Carbon::parse($item->bill->trip->start_date)->format('d/m/Y') }}</label>
                                </p>
                                <p>{{ $item->code_seat  }}</p>
                                <p>{{ $item->pickup_location  }}</p>
                                <p>{{ $item->pay_location  }}</p>
                                <p>{{ number_format($item->bill->trip->trip_price, 0, '.', '.') }}đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-footer" id="hi">
                        <p>Hãy mang vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít nhất 60 phút</p>
                    </div>
                </div>
            @endforeach
            @isset($data['return'])
                @forelse($data['return'] as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12 mb-3">
                        <div class="detail-ticket">
                            <p class="text-center fw-bold">Mã vé: {{ $item->code_ticket }}</p>
                            <div class="logo-qr-return d-flex justify-content-center mb-3" data-code="{{ $item->code_ticket }}">
                            </div>
                            <div class=" order-ticket">
                                <div class="column-ticket text">
                                    <p>Tên tuyến</p>
                                    <p>Thời gian</p>
                                    <p>Số ghế</p>
                                    <p>Điểm lên xe</p>
                                    <p>Điểm trả khách</p>
                                    <p>Giá vé</p>
                                </div>
                                <div class="column-ticket data">
                                    <p>
                                        <label>{{ $item->bill->trip->start_location }} - </label>
                                        <label>{{ $item->bill->trip->end_location  }}</label>
                                    </p>

                                    <p>
                                        <label style="margin-right: 5px;">{{ \Carbon\Carbon::parse($item->bill->trip->start_time)->format('H:i') }}</label>
                                        <label>{{ \Carbon\Carbon::parse($item->bill->trip->start_date)->format('d/m/Y') }}</label>
                                    </p>
                                    <p>{{ $item->code_seat  }}</p>
                                    <p>{{ $item->pickup_location  }}</p>
                                    <p>{{ $item->pay_location  }}</p>
                                    <p>{{ number_format($item->bill->trip->trip_price, 0, '.', '.') }} đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-footer" id="hi">
                            <p>Hãy mang vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít nhất 60 phút</p>
                        </div>
                    </div>
                @empty
                    <p></p>
                @endforelse
            @endisset
            <div class="row justify-content-center px-3">
                <div class="col-lg-3 col-md-6 col-xs-12 text-center">
                    <a href="{{ route('trang_chu') }}" class="btn w-100 fw-medium button-important text-decoration-none d-flex justify-content-center">
                        <div>
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="ps-2">
                            Trang chủ
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12 text-center">
                    <button type="button" class="btn w-100 fw-medium button-important">
                        <div class=" d-flex justify-content-center">
                            <div>
                                <i class="fa-solid fa-download"></i>
                            </div>
                            <div class="ps-2">
                                Tải về
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('client/assets/js/url-config.js') }}"></script>
    <script src="{{ asset('client/assets/js/qr-code.js') }}"></script>
</div>
</body>

</html>
