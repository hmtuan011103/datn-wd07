<form id="searchForm" onsubmit="submitForm(event)"
    class="container position-relative pa-t-215 bg-white rounded-4 border-orange px-4 spacing-form-search">
    <div class="row align-items-center pt-4">
        <div class="col-6 d-flex">
            <div class="form-check cursor pe-4">
                <input class="form-check-input cursor" type="radio" name="type-ticket" onclick="showFormElement()"
                    id="one-way" value="1" checked>
                <label class="form-check-label cursor fs-15" for="one-way">
                    Một chiều
                </label>
            </div>
            <div class="form-check cursor">
                <input class="form-check-input cursor" type="radio" name="type-ticket" onclick="showFormElement()"
                    id="multi-way" value="2">
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
            <select class="form-select py-3" aria-label="Default select example" name="start_location"
                id="mySelectstart">

                <option value="0" selected hidden>Chọn điểm đi</option>
            </select>
            <span class="text-danger" id="error_start_location"></span>
        </div>

        <div class="col-3">
            <label for="" class="form-label fs-15">Điểm đến</label>
            <select class="form-select py-3" aria-label="Default select example" name="end_location" id="mySelectend">
                <option value="0" selected hidden>Chọn điểm đến</option>
            </select>
            <span class="text-danger" id="error_end_location"></span>
        </div>
        <div class="col-3">
            <label for="" class="form-label fs-15">Ngày đi</label>
            {{-- <input type="date" class="form-control py-3" id="dateInput"> --}}
            <input type="text" class="form-control py-3" name="start_time" id="dateInputstart"
                placeholder="dd/mm/yyyy">
            <span class="text-danger" id="error_start_time"></span>
        </div>
        <div class="col-3 row">
            <div class="col-8" style="display:none" id="returndate">
                <label for="" class="form-label fs-15">Ngày về</label>
                {{-- <input type="date" class="form-control py-3" id="" placeholder=""> --}}
                <input type="text" class="form-control py-3" name="end_time" id="dateInputend"
                    placeholder="dd/mm/yyyy">
                <span class="text-danger" id="error_end_time"></span>
            </div>
            <div class="col" id="totalticket">
                <label for="" class="form-label fs-15">Số vé</label>
                <select class="form-select py-3" name="ticket" id="tickettotal" aria-label="Default select example">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <span class="text-danger" id="error_ticket"></span>
            </div>
        </div>
    </div>
    <div class="row pb-3 pt-0" id="searchrecently">
        <div class="col-12">
            <p class="mb-2 fs-15">Tìm kiếm gần đây</p>
        </div>
        {{-- <a href=""
            class="col-2 bg-search-latest fs-15 border border-1 rounded-2 mx-2 text-decoration-none cl-black">
            <div class="d-flex py-2">
                <p class="m-0 p-0 fs-15">Hà Nội</p>
                <p class="px-1 py-0 m-0 fs-15"> - </p>
                <p class="m-0 p-0 fs-15">Nam Định</p>
            </div>
            <p class="p-0  fs-13">16/10/2023</p>
        </a> --}}
        {{-- <a href="#" onclick="submitFormCookie(2)"
            class="col-2 bg-search-latest fs-15 border border-1 rounded-2 mx-2 text-decoration-none cl-black">
            <div class="d-flex py-2">
                <p class="m-0 p-0 fs-15">Sơn La</p>
                <p class="px-1 py-0 m-0 fs-15"> - </p>
                <p class="m-0 p-0 fs-15">Nam Định</p>
            </div>
            <p class="p-0  fs-13">18/10/2023</p>
            <div class="d-none">
                <form id="myFormCookie2" onsubmit="submitForm(event)">
                    <input class="form-check-input cursor" type="radio" name="type-ticket"
                        id="one-way" value="1" checked>
                    <select class="form-select py-3" aria-label="Default select example" name="start_location">
                        <option value="" selected></option>
                    </select>
                    <select class="form-select py-3" aria-label="Default select example" name="end_location">
                        <option value="" selected></option>
                    </select>
                    <input type="text" class="form-control py-3" name="start_time" value="">
                    <input type="text" class="form-control py-3" name="end_time" value="">
                    <select class="form-select py-3" name="ticket" id="tickettotal"
                        aria-label="Default select example">
                        <option value="1" selected>1</option>
                    </select>
                    <button>submit</button>
                </form>
            </div>
        </a> --}}

    </div>
    <div class="row justify-content-center">
        <div class="col-3 ta-center">
            <button type="submit"
                class="found-bus-ticket rounded-pill w-100 bg-orange-button cl-white btn-seact-trip fw-medium">Tìm
                chuyến xe</button>
        </div>
    </div>
</form>
<div class="d-none" id="formsearchcookie">

</div>
