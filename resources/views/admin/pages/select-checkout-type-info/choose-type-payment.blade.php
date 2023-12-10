<div class="container">
    <div class="row px-0 justify-content-between">
        <div class="col-lg-7 bg-white rounded">
            <div class="row">
                <div class="col-lg-12 border border-1 rounded-3 pb-3">
                    <h6 class="pt-3"><b>Thông người đặt</b></h6>
                    <div class="row px-0 pt-3 justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    Họ và tên
                                    <p><b>{{ $nameUser }}</b></p>
                                </div>
                                <div class="col-lg-6">
                                    Số điện thoại
                                    <p><b>{{ $phoneUser }}</b></p>
                                </div>
                                <div class="col-lg-6">
                                    Email
                                    <p><b>{{ $emailUser }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border mb-3" style="width: 95%;"></div>
                    <div class="row px-0 pt-3 justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <span class="fw-medium">Chuyến đi:</span>
                                    <p><b>{{ $tripTurn->start_location . "-" . $tripTurn->end_location }}</b></p>
                                </div>
                                <div class="col-lg-6">
                                    Thời gian đi
                                    <p>
                                        <b>
                                            <span style="color: #EF5222;">{{ \Carbon\Carbon::createFromFormat('H:i:s', $tripTurn->start_time)->format('H:i')  }}</span>
                                            - {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tripTurn->start_date)->format('d/m/Y') }}
                                        </b>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    Điểm đón
                                    <p><b>{{ $placeStart->name }}</b></p>
                                </div>
                                <div class="col-lg-6">
                                    Điểm trả
                                    <p><b>{{ $placeEnd->name }}</b></p>
                                </div>
                            </div>
                        </div>
                        @if($tripReturn !== null)
                            <div class="border mb-3" style="width: 95%;"></div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="fw-medium">Chuyến về:</span>
                                        <p><b>{{ $tripReturn->start_location . "-" . $tripReturn->end_location }}</b></p>
                                    </div>
                                    <div class="col-lg-6">
                                        Thời gian đi
                                        <p>
                                            <b>
                                                <span style="color: #EF5222;">{{ \Carbon\Carbon::createFromFormat('H:i:s', $tripReturn->start_time)->format('H:i')  }}</span>
                                                - {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tripReturn->start_date)->format('d/m/Y') }}
                                            </b>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        Điểm đón
                                        <p><b>{{ $placeStartSecond->name ?? "" }}</b></p>
                                    </div>
                                    <div class="col-lg-6">
                                        Điểm trả
                                        <p><b>{{ $placeEndSecond->name ?? "" }}</b></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 border border-1 rounded-3 pb-3 mt-3">
                    <h6 class="pt-3"><b>Thông tin thanh toán</b></h6>
                    <div class="row px-0 pt-3">
                        <div class="col-12">
                            <table class="table border w-100" style="border-radius: 10px;">
                                <thead>
                                <tr>
                                    <th scope="col">Chuyến</th>
                                    <th scope="col">Ghế</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá vé</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="fw-medium">Đi</td>
                                    <td class="fw-medium">{{ $seatsTurn[0] }}</td>
                                    <td class="fw-medium">{{ count(explode(',', $seatsTurn[0])) }}</td>
                                    <td class="fw-medium">{{ number_format($moneyTurn / count(explode(',', $seatsTurn[0])), 0, ',', '.') }}đ</td>
                                    <td class="fw-medium">{{ number_format($moneyTurn, 0, ',', '.') }}đ</td>
                                </tr>
                                @if($seatsReturn !== null)
                                    <tr>
                                        <td class="fw-medium">Về</td>
                                        <td class="fw-medium">{{ $seatsReturn[0] }}</td>
                                        <td class="fw-medium">{{ count(explode(',', $seatsReturn[0])) }}</td>
                                        <td class="fw-medium">{{ number_format($moneyReturn / count(explode(',', $seatsReturn[0])), 0, ',', '.') }}đ</td>
                                        <td class="fw-medium">{{ number_format($moneyReturn, 0, ',', '.') }}đ</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 bg-white rounded">
            <form class="row" action="{{ route('thanh_toan') }}" method="POST">
                @csrf
                <input type="hidden" hidden value="{{ $nameUser }}" name="name">
                <input type="hidden" hidden value="{{ $phoneUser }}" name="email">
                <input type="hidden" hidden value="{{ $emailUser }}" name="phone">
                <input type="hidden" hidden value="{{ $moneyReturn ?? "" }}" name="money_return">
                <input type="hidden" hidden value="{{ $moneyTurn }}" name="money_turn">
                <input type="hidden" hidden value="{{ $seatsReturn[0] ?? "" }}" name="seats_return[]">
                <input type="hidden" hidden value="{{ $seatsTurn[0] }}" name="seats_turn[]">
                <input type="hidden" hidden value="{{ $tripReturn->id ?? "" }}" name="trip_return">
                <input type="hidden" hidden value="{{ $tripTurn->id }}" name="trip_turn">
                <input type="hidden" hidden value="{{ $placeStart->id }}" name="place_start_turn">
                <input type="hidden" hidden value="{{ $placeEnd->id }}" name="place_end_turn">
                <input type="hidden" hidden value="{{ $placeStart->id }}" name="place_start_turn_0">
                <input type="hidden" hidden value="{{ $placeEnd->id }}" name="place_end_turn_0">
                <input type="hidden" hidden value="{{ $placeStartSecond->id ?? "" }}" name="place_start_turn_1">
                <input type="hidden" hidden value="{{ $placeEndSecond->id ?? "" }}" name="place_end_turn_1">
                <div class="col-lg-12 border border-1 rounded-3 pb-3">
                    <div class="row px-0">
                        <div class="col-lg-12">
                            <h6 class="py-3"><b>Phương thức thanh toán</b></h6>
                            <div class="form-check py-3 d-flex align-items-center cursor-payment" id="vnpayDiv">
                                <input class="form-check-input ms-1 cursor-payment" type="radio" name="type_payment" id="vnpay" value="1" checked>
                                <label class="form-check-label ps-2 fw-medium w-100 cursor-payment" for="vnpay">
                                    <img src="{{ asset('client/assets/images/choose-type-checkout/vnpay_checkout.jpg') }}" alt=""  height="35px" width="35px">
                                    <span class="ps-2">VNPAY</span>
                                </label>
                            </div>
                            <div class="form-check py-3 mt-2 d-flex align-items-center cursor-payment" id="momoDiv">
                                <input class="form-check-input ms-1 cursor-payment" type="radio" name="type_payment" id="momo" value="2">
                                <label class="form-check-label ps-2 fw-medium w-100 cursor-payment" for="momo">
                                    <img src="{{ asset('client/assets/images/choose-type-checkout/momo_checkout.jpg') }}" alt="" height="35px" width="35px">
                                    <span class="ps-2">MOMO</span>
                                </label>
                            </div>
                            <div class="form-check py-3 mt-2 d-flex align-items-center cursor-payment" id="directDiv">
                                <input class="form-check-input ms-1 cursor-payment" type="radio" name="type_payment" id="direct" value="3">
                                <label class="form-check-label ps-2 fw-medium w-100 cursor-payment" for="direct">
                                    <img src="{{ asset('client/assets/images/choose-type-checkout/direct-checkout.png') }}" alt="" height="35px" width="35px">
                                    <span class="ps-2">THANH TOÁN TRỰC TIẾP</span>
                                </label>
                            </div>
                            <div class="pt-3 pb-1 d-flex">
                                <input type="text" class="form-control discount_code discount_code_value py-3 w-70" name="discount_code" id="discount_code" placeholder="Mã giảm giá">
                                <button class="w-30 btn-execute-code-discount" type="button">Áp dụng</button>
                            </div>
                            <div class="py-3">
                                <h6><b>Chi phí</b></h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Thanh toán</p>
                                <p>
                                    @if($seatsReturn !== null)
                                        <b class="total_money_first">{{ number_format($moneyReturn + $moneyTurn, 0, ',', '.') }}</b><b>đ</b>
                                    @else
                                        <b class="total_money_first">{{ number_format($moneyTurn, 0, ',', '.') }}</b><b>đ</b>
                                    @endif
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Phí thanh toán</p>
                                <p><b>0đ</b></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Giảm giá</p>
                                <p>
                                    <b class="value_discount_fill">0</b>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Tổng cộng</p>
                                <p>
                                    @if($seatsReturn !== null)
                                        <b class="total_money_final">{{ number_format($moneyReturn + $moneyTurn, 0, ',', '.') }}</b><b>đ</b>
                                    @else
                                        <b class="total_money_final">{{ number_format($moneyTurn, 0, ',', '.') }}</b><b>đ</b>
                                    @endif
                                </p>
                            </div>
                            <div class="w-100 mt-4">
                                <button class="btn btn-primary w-100 rounded-pill" type="submit" name="redirect-payment" id="payment-final"><b>Thanh toán</b></button>
                            </div>
                            <div class="w-100 py-3">
                                <button class="btn w-100 rounded-pill" type="button" id="return-select-seat"><b>Quay lại</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
