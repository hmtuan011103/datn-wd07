{{-- Modal show chi tiết todo --}}
<div class="modal fade" id="show">
    <div class="container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin chuyến đi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                  
                    <div class="row">
                        <div class="col-md-6">
                            <p>Tên xe : <label id="car_name"></label></p>
                            <p>Người lái : <label id="drive_name"></label></p>
                            <p>Phụ xe : <label id="assistantCar_name"></label></p>
                            <p>Ngày đi : <label id="start_date"></label></p>
                        </div>
                        <div class="col-md-6">
                            <p>Điểm bắt đầu : <label id="start_location"></label></p>
                            <p>Điểm kết thúc : <label id="end_location"></label></p>
                            <p>Giá vé : <label id="trip_price"></label>.000 VND</p>
                            <p>Giờ đi : <label id="start_time"></label></p>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
