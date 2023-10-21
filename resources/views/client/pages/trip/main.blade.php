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
            <div class="ant-col ant-col-3">Quãng đường</div>
            <div class="ant-col ant-col-4">Thời gian hành trình </div>
            <div class="ant-col ant-col-2">Giá vé</div>
        </div>
        {{-- @php
            $tripNames = [];
        @endphp
        @foreach ($trips as $trip)
            @if (!in_array($trip->start_location, $tripNames))
                <div class="alldata">
                    <div class="schedule-card flex w-full flex-col gap-[6px] text-left ">
                        @foreach ($trips as $item)
                            @if ($item->start_location === $trip->start_location)
                                <div class="ant-row items-center">
                                    <div class="ant-col ant-col-6">
                                        <div class="flex w-full items-center gap-2">
                                            <span class="font-medium text-orange">{{ $item->start_location }}</span>
                                            <img src="https://futabus.vn/images/icons/ic_double_arrow.svg"
                                                alt="arrow">
                                            <span>{{ $item->end_location }}</span>
                                        </div>
                                    </div>
                                    <div class="ant-col ant-col-2">{{ $item->car_type_name }}</div>
                                    <div class="ant-col ant-col-3">639km</div>
                                    <div class="ant-col ant-col-4">11 giờ 30 phút </div>
                                    <div class="ant-col ant-col-2">{{ $item->trip_price }}.000 VNĐ</div>
                                    <!-- <div class="ant-col ant-col-2"></div> -->
                                    <div class="ant-col flex justify-end" style="flex: 1 1 auto;">
                                        <button type="button"
                                            class="ant-btn ant-btn-round ant-btn-default button-default mr-2">
                                            <span>Tìm tuyến xe</span>
                                        </button>
                                    </div>

                                </div>
                            @else
                            @endif
                        @endforeach
                    </div>
                </div>
                @php
                    $tripNames[] = $trip->start_location;
                @endphp
            @else
            @endif
        @endforeach --}}
        <div class="searchdata" style="display: none" id="content">
         
        </div>

    </div>
</div>
