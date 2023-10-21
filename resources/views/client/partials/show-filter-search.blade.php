    <form class="content-container-right ps-4 w-70"  style="display:none" id="searchresulttrue">
        <p class="title-trip-found fs-20 fw-medium" id="start_end"><span id="total_trip"></span></p>
        <div class="d-flex">
            <button type="button" class="btn bg-white border border-1 me-2 fs-14 cl-orange bg-button-orange">
                <i class="fa-solid fa-hand-holding-dollar pe-1 fs-15"></i> Giá rẻ bất ngờ
            </button>
            <button type="button" class="btn btn-light bg-white border border-1 me-2 fs-14">
                <i class="fa-regular fa-clock pe-1 fs-15"></i>
                Giờ khởi hành
            </button>
        </div>

        <div id="type_ticket_two">
            
        </div>

        <div id="searchresults">
            {{-- <div class="p-4 border border-1 rounded-3 mt-3 w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0 pe-3 fw-medium">07:30</p>
                    <img src="styles/start_place.svg" alt="">
                    <span class="border-dotted"></span>
                    <div class="ta-center show-time-run">
                        <p class="fw-medium mb-0">2 giờ </p>
                        <p class="fs-13 fw-medium">(Asian/Ho Chi Minh)</p>
                    </div>
                    <span class="border-dotted"></span>
                    <img src="styles/end_place.svg" alt="">
                    <p class="mb-0 ps-3 fw-medium">09:30</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mb-0 fs-15 fw-medium">Bến Xe Giáp Bát</p>
                    <p class="mb-0 fs-15 fw-medium">Bến Xe Nam Định</p>
                </div>
                <div class="d-flex pt-4 justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <p class="fs-14 mb-0 cl-orange fw-medium">100.000đ</p>
                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                        <p class="fs-14 mb-0 cl-orange fw-medium">Ghế</p>
                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                        <p class="fs-14 mb-0 cl-orange fw-medium">23 chỗ trống</p>
                        <p class="ps-2 fs-14 cl-blue-light text-decoration-underline cursor mb-0 fw-medium">Chọn ghế</p>
                    </div>
                    <div>
                        <button
                            class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4">Chọn
                            chuyến</button>
                    </div>
                </div>
            </div> --}}
        </div>

    </form>
    <div class="content-container-right ps-4 w-70 text-center" style="display:none" id="searchresultfalse">
        <div class="ant-empty mt-20 mb-4 mt-5">
            <div class="mb-3"><img src="https://futabus.vn/images/empty_list.svg" alt="empty_list" width="260">
            </div>
            <div class="fs-5 fw-bold">Không có kết quả được tìm thấy.</div>
        </div>
    </div>
