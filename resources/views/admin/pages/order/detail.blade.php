<div class="modal fade" id="show">
    <div class="container">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <h2>Thông tin hóa đơn</h2>
                    </h4>
                    <p type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">X</p>
                </div>
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fs-6 fw-semibold">Mã hóa đơn : <label id="code_order"></label></p>
                            <p class="fs-6 fw-semibold">Thời gian mua: <label id="time"></label></p>
                            <p class="fs-6 fw-semibold">Tên khách hàng: <label id="user"></label></p>
                            <p class="fs-6 fw-semibold">Email: <label id="email"></label></p>
                        </div>
                        <div class="col-md-6">
                            <p class="fs-6 fw-semibold">Số vé : <label id="number_ticket"></label></p>
                            <p class="fs-6 fw-semibold">Loại thanh toán : <label id="type_pay"></label></p>
                            <p class="fs-6 fw-semibold">Trạng thái: <label id="status_pay"></label></p>
                            <p class="fs-6 fw-semibold">SĐT: <label id="phone"></label></p>
                            {{-- <p class="fs-6 fw-semibold"><label id="user"></label></p> --}}
                        </div>
                        
                    </div>
                    <div class="row">
                        <p class="fs-5 fw-semibold">Chi tiết đơn hàng : <label id="car_name"></label></p>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th >STT</th>
                                    <th >Tuyến xe</th>
                                    <th >Mã ghế</th>
                                    <th >Giá vé</th>
                                    <th >Số lượng</th>
                                    <th >Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="details_bill">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
