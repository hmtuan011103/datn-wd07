<form action="" method="POST" class="container position-relative pa-t-215 bg-white rounded-4 border-orange px-4 spacing-form-search">
    <div class="row align-items-center pt-4">
        <div class="col-6 d-flex">
            <div class="form-check cursor pe-4">
                <input class="form-check-input cursor" type="radio" name="type-ticket" id="one-way" value="1" checked>
                <label class="form-check-label cursor fs-15" for="one-way">
                    Một chiều
                </label>
            </div>
            <div class="form-check cursor">
                <input class="form-check-input cursor" type="radio" name="type-ticket" id="multi-way" value="2">
                <label class="form-check-label cursor fs-15" for="multi-way">
                    Khứ hồi
                </label>
            </div>
        </div>
        <div class="col-6 ta-right fs-15">
            <a href="" class=" text-decoration-none cl-orange">Hướng dẫn mua vé</a>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-3">
            <label for="" class="form-label fs-15">Điểm đi</label>
            <select class="form-select py-3" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <div class="col-3">
            <label for="" class="form-label fs-15">Điểm đến</label>
            <select class="form-select py-3" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-3">
            <label for="" class="form-label fs-15">Ngày đi</label>
            <input type="date" class="form-control py-3" id="" placeholder="">
        </div>
        <div class="col-3">
            <label for="" class="form-label fs-15">Số vé</label>
            <input type="number" class="form-control py-3" id="" placeholder="">
        </div>
    </div>
    <div class="row pb-3 pt-0">
        <div class="col-12">
            <p class="mb-2 fs-15">Tìm kiếm gần đây</p>
        </div>
        <a href="" class="col-2 bg-search-latest fs-15 border border-1 rounded-2 mx-2 text-decoration-none cl-black">
            <div class="d-flex py-2">
                <p class="m-0 p-0 fs-15">Hà Nội</p>
                <p class="px-1 py-0 m-0 fs-15"> - </p>
                <p class="m-0 p-0 fs-15">Nam Định</p>
            </div>
            <p class="p-0  fs-13">16/10/2023</p>
        </a>
        <a href="" class="col-2 bg-search-latest fs-15 border border-1 rounded-2 mx-2 text-decoration-none cl-black">
            <div class="d-flex py-2">
                <p class="m-0 p-0 fs-15">Sơn La</p>
                <p class="px-1 py-0 m-0 fs-15"> - </p>
                <p class="m-0 p-0 fs-15">Nam Định</p>
            </div>
            <p class="p-0  fs-13">18/10/2023</p>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-3 ta-center">
            <button type="submit" class="found-bus-ticket rounded-pill w-100 bg-orange-button cl-white btn-seact-trip fw-medium">Tìm chuyến xe</button>
        </div>
    </div>
</form>
