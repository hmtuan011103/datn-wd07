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



    <div class="mt-6 flex w-full flex-col gap-4 overflow-auto " id="list_trip" >
        <div class="ant-row row-search schedule-card">
            <div class="ant-col ant-col-6">Tuyến xe</div>
            <div class="ant-col ant-col-2">Loại xe</div>
            <div class="ant-col ant-col-4">Thời gian hành trình </div>
            <div class="ant-col ant-col-2">Giá vé</div>
        </div>

        <div class="searchdata" style="display: none" id="content">
         
        </div>

    </div>
</div>
