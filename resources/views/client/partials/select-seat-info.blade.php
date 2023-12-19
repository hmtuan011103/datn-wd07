<div class="container d-flex justify-content-between mb-5">
    <div class="w-70 border border-1 rounded-3 pt-4">
        <div id="countdown_client_interface" class="fw-medium"></div>
        <div class="border-bottom-4 pb-4">
            <div class="px-4">
                {{-- Hiển thị tiêu đề --}}
                <div class="row" id="show-seat-for-trip">
                    {{-- Hiển thị ghế của xe --}}
                </div>
            </div>
        </div>
        <form action="{{ route('phuong_thuc_thanh_toan') }}" class="" method="POST" id="form-forward-checkout">
            @csrf
            <div class="border-bottom-4 mx-0 py-4 row" id="info-turn-return">
                {{-- Hiển thị thông tin điểm đón trả --}}
            </div>
            <div class="border-bottom-4 py-4">
                <div class="px-4 d-flex">
                    <div class="w-50 pe-4">
                        <p class="fs-18 fw-medium infor-user-title">Thông tin khách hàng</p>
                        <input type="hidden" name="client_verify" value="">
                        <div class="">
                            <div class="mb-3">
                                <label for="name" class="form-label fs-14">Họ và tên <span>*</span></label>
                                <input type="text" autocomplete="off" class="form-control w-100 fs-14" name="name" id="name" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label fs-14">Số điện thoại <span>*</span></label>
                                <input type="text" autocomplete="off" class="form-control w-100 fs-14" name="phone" id="phone" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fs-14">Email <span>*</span></label>
                                <input type="text" autocomplete="off" class="form-control w-100 fs-14" name="email" id="email" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="w-50 ps-4">
                        <p class="fs-16 fw-medium infor-user-title ta-center cl-orange">ĐIỀU KHOẢN & LƯU Ý</p>
                        <div class="mb-3 fs-14 fw-medium">
                            (*) Quý khách vui lòng có mặt tại quầy đổi vé trước ít nhất 30 phút giờ xe khởi hành, mang theo thông báo đã thanh toán vé thành công có chứa mã vé được gửi từ hệ thống CHIEN THANG BUS LINE. Vui lòng liên hệ Trung tâm tổng đài 1900 6067 để được hỗ trợ.
                        </div>
                        <div class="fs-14 fw-medium">
                            (*) Nếu quý khách có nhu cầu trung chuyển, vui lòng liên hệ Tổng đài trung chuyển 1900 6918 trước khi đặt vé. Chúng tôi không đón/trung chuyển tại những điểm xe trung chuyển không thể tới được.
                        </div>
                    </div>
                </div>
                <div class="form-check mx-4 cursor">
                    <input class="form-check-input cursor" type="checkbox" value="" name="policy" id="policy">
                    <label class="form-check-label fs-14 cursor" for="policy">
                        <span class="text-decoration-underline cl-orange fs-14 cursor">Chấp nhận điều khoản</span> đặt vé & chính sách bảo mật thông tin của Chien Thang Busline
                    </label>
                </div>
            </div>
            <div class="p-4 d-flex justify-content-between align-items-center">
                <div id="total-detail-price-trip-checkout">
                    {{-- In ra tổng tiền cần thanh toán --}}
                </div>
                <div>
                    <button class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4"
                            type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Quay lại
                    </button>
                    <button class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip-2 px-4"
                            name="redirect" type="submit">
                        Tiếp tục
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông tin chuyến đi của bạn</h1>
                                </div>
                                <div class="modal-body text-center">
                                    Chưa có thông tin gì
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
