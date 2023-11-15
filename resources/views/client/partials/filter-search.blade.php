<div class="container d-flex pt-5 pb-4 total-filter-search">
    <div class="d-flex list-btn-filter-v2">
        <button type="button" class="btn bg-white border border-1 me-2 fs-14 cl-orange bg-button-orange">
            <i class="fa-solid fa-hand-holding-dollar pe-1 fs-15"></i> Giá rẻ bất ngờ
        </button>
        <button type="button" class="btn btn-light bg-white border border-1 me-2 fs-14">
            <i class="fa-regular fa-clock pe-1 fs-15"></i>
            Giờ khởi hành
        </button>
        <button type="button" class="btn bg-white border border-1 me-2 fs-14 cl-orange bg-button-orange mobile block-filter">
            <i class="fa-solid fa-pen-to-square"></i> Bộ lọc
        </button>
    </div>
    <div  class="filter-container-left bg-route-popular p-3 rounded-3 w-30 filter-search">
        <div class="d-flex justify-content-between title-filter">
            <p class="text-uppercase fw-medium fs-16">Bộ lọc tìm kiếm</p>
            <p class="fs-15 cl-orange fw-medium cursor">Bỏ lọc <span class="ps-1"><i class="fa-regular fa-trash-can fs-18"></i></span></p>
        </div>
        <div class="type-hours border-bottom pt-3">
            <p class="mb-0 pb-2 px-2 fw-medium">Giờ đi</p>
            <div class="ps-2" id="checkboxContainer">
                <div class="form-check mb-2 cursor">
                    <input class="form-check-input cursor filter-time"  type="checkbox" value="00-06" id="" >
                    <label class="form-check-label cursor" for="">
                        Sáng sớm 00:00 - 06:00 <span id="count0006"></span>
                    </label>
                </div>
                <div class="form-check mb-2 cursor">
                    <input class="form-check-input cursor filter-time"  type="checkbox" value="06-12" id="" >
                    <label class="form-check-label cursor" for="">
                        Buổi sáng 06:00 - 12:00 <span id="count0612"></span>
                    </label>
                </div>
                <div class="form-check mb-2 cursor">
                    <input class="form-check-input cursor filter-time"  type="checkbox" value="12-16" id="" >
                    <label class="form-check-label cursor"  for="">
                        Buổi chiều 12:00 - 18:00 <span id="count1218"></span>
                    </label>
                </div>
                <div class="form-check mb-2 pb-2 cursor">
                    <input class="form-check-input cursor filter-time"  type="checkbox" value="18-24" id="" >
                    <label class="form-check-label cursor" for="">
                        Buổi tối 18:00 - 24:00 <span id="count1824"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="type-car border-bottom py-4 px-2">
            <div>
                <p class="mb-0 pb-2 fw-medium">Loại xe</p>
            </div>
            <div class="d-flex" id="type_car_all">
                {{-- <button type="button" class="btn btn-light bg-white border border-1 me-2 fs-14">Ghế</button>
                <button type="button" class="btn btn-light bg-white border border-1 me-2 fs-14">Giường</button>
                <button type="button" class="btn btn-light bg-white border border-1 me-2 fs-14 type-seat">Limousine</button>--}}

            </div>
        </div>
        <div class="type-car border-bottom py-4 px-2">
            <div>
                <p class="mb-0 pb-2 fw-medium">Hàng ghế</p>
            </div>
            <div class="d-flex">
                <button  class="btn btn-light bg-white border border-1 me-2 fs-14 rowseat" data-type="top">Hàng đầu</button>
                <button  class="btn btn-light bg-white border border-1 me-2 fs-14 rowseat" data-type="mid">Hàng giữa</button>
                <button  class="btn btn-light bg-white border border-1 me-2 fs-14 rowseat" data-type="end">Hàng cuối</button>
            </div>
        </div>
        <div class="type-car py-4 px-2">
            <div>
                <p class="mb-0 pb-2 fw-medium">Tầng</p>
            </div>
            <div class="d-flex">
                <button  class="btn btn-light bg-white border border-1 me-2 fs-14 floor" data-type="up">Tầng trên</button>
                <button  class="btn btn-light bg-white border border-1 me-2 fs-14 floor" data-type="down">Tầng dưới</button>
            </div>
        </div>
    </div>
