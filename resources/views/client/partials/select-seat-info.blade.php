<div class="container d-flex justify-content-between mb-5">
    <div class="w-70 border border-1 rounded-3 pt-4">
        <div class="border-bottom-4 pb-4">
            <div class="px-4">
                {{-- Hiển thị tiêu đề --}}
                <div class="row" id="show-seat-for-trip">
                    {{-- Hiển thị ghế của xe --}}
                </div>
            </div>
        </div>
        <div class="border-bottom-4 mx-0 py-4 row" id="info-turn-return">
            {{-- Hiển thị thông tin điểm đón trả --}}
        </div>
        <form action="" class="" method="" id="form-forward-checkout">
            <div class="border-bottom-4 py-4">
                <div class="px-4 d-flex">
                    <div class="w-50 pe-4">
                        <p class="fs-18 fw-medium infor-user-title">Thông tin khách hàng</p>
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
                            (*) Quý khách vui lòng có mặt tại bến xuất phát của xe trước ít nhất 30 phút giờ xe khởi hành, mang theo thông báo đã thanh toán vé thành công có chứa mã vé được gửi từ hệ thống FUTA BUS LINE. Vui lòng liên hệ Trung tâm tổng đài 1900 6067 để được hỗ trợ.
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
                    <button class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4">Hủy</button>
                    <button class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip-2 px-4">Thanh toán</button>
                </div>
            </div>
        </form>
    </div>
