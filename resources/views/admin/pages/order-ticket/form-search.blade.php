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
            <input type="text" class="form-control py-3" name="start_time" id="dateInputstart"
                   placeholder="dd/mm/yyyy">
            <span class="text-danger" id="error_start_time"></span>
        </div>
        <div class="col-3 row">
            <div class="col-8" style="display:none" id="returndate">
                <label for="" class="form-label fs-15">Ngày về</label>
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
    </div>
    <div class="row justify-content-center">
        <div class="col-3 ta-center">
            <button type="submit"
                    class="found-bus-ticket border border-1 py-3 border-primary mt-2 mb-3 rounded-pill w-100 btn-seact-trip fw-medium">Tìm
                chuyến xe</button>
        </div>
    </div>
</form>
<div class="d-none" id="formsearchcookie">

</div>
