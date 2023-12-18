<div class="container list_trip">
    <div class="shedule-input-form relative flex w-full justify-center gap-4">
        <span class=" search-container">
            {{-- <span class="ant-input-prefix"> --}}
            {{-- <i class="fa-solid fa-magnifying-glass"></i></span> --}}
            <input type="text" placeholder="Nhập điểm đi" id="search_start" name="search_start" value="">
            <button id="searchButton"><i class="fa fa-search"></i></button>

        </span>
        {{--
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm...">
            <button id="searchButton"><i class="fa fa-search"></i></button>
          </div> --}}

        <img class="switch-location rotate-image" src="https://futabus.vn/images/icons/switch_location.svg"
            alt="switch location icon">

        <span class=" search-container">
            {{-- <span class="ant-input-prefix"> --}}
            {{-- <i class="fa-solid fa-magnifying-glass"></i></span> --}}
            <input type="text" placeholder="Nhập điểm đến" id="search_end" name="search_end" value="">
            <button id="searchButton"><i class="fa fa-search"></i></button>

        </span>
    </div>



    <div class="mt-6 flex w-full flex-col gap-4 overflow-auto ">
        <div class="ant-row row-search schedule-card" id="table_header">
            <div class="ant-col ant-col-4">Tuyến xe</div>
            <div class="ant-col ant-col-4">Loại xe</div>
            <div class="ant-col ant-col-2">Khởi hành</div>
            <div class="ant-col ant-col-2">Giá vé</div>
        </div>
        <div id="list_trip">
            {{-- dữ liệu data trip --}}
        </div>

        <div class="searchdata" style="display: none" id="content">

        </div>
        <div class="alldata">
            <ul id="pagination" class="pagination">
                <!-- Các nút phân trang sẽ được thêm vào đây bằng JavaScript -->
            </ul>
        </div>
        {{-- <div class="searchdata">

        </div> --}}

    </div> <br>




</div>
