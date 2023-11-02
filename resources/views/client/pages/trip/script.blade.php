<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    const API = 'http://127.0.0.1:8000/api/data/';
    const tbody = document.querySelector('#list_trip');
    const pagination = document.querySelector('#pagination');

    const itemsPerPage = 5; // Số mục hiển thị trên mỗi trang
    let currentPage = 1;
    let totalPages = 0;
    let startIndex = 0;

    const getData = async () => {
        const res = await (await fetch(API)).json();
        const tripNames = new Set();
        const endIndex = startIndex + itemsPerPage;

        const filteredData = res.slice(startIndex, endIndex);

        const html = filteredData.map(trip => {
            if (!tripNames.has(trip.start_location)) {
                tripNames.add(trip.start_location);

                function convertTime(timeString) {
                    if (timeString && typeof timeString === 'string') {
                        var parts = timeString.split(":");
                        var hour = parseInt(parts[0]);
                        var minute = parseInt(parts[1]);

                        var hourText = hour.toString();
                        var minuteText = minute.toString();

                        if (hour < 10) {
                            hourText = "0" + hourText;
                        }

                        if (minute < 10) {
                            minuteText = "0" + minuteText;
                        }

                        var timeInVietnamese = hourText + " giờ " + minuteText + " phút";

                        return timeInVietnamese;
                    } else {
                        // Xử lý trường hợp `timeString` không tồn tại hoặc không hợp lệ.
                    }
                }

                return `
            
                <div class="alldata">
                    <div class="schedule-card flex w-full flex-col gap-[6px] text-left " >
                        ${res.map(function(item) {
                                        if(item.start_location === trip.start_location) {
                                            return ` 
                                            <div class="ant-row items-center" > 
                                                <div class="ant-col ant-col-6" >
                                                    <div class="flex w-full items-center gap-2">
                                                        <span class="font-medium text-orange"> ${item.start_location}</span>
                                                        <img src="https://futabus.vn/images/icons/ic_double_arrow.svg" alt="arrow">
                                                        <span> ${item.end_location}</span>
                                                    </div>
                                                </div>
                                                <div class="ant-col ant-col-2">${item.car_type_name}</div>
                                                <div class="ant-col ant-col-4">${convertTime(item.interval_trip)}</div>
                                                <div class="ant-col ant-col-2">${item.trip_price}.000 VNĐ</div>
                                                <!-- <div class="ant-col ant-col-2"></div> -->
                                                <div class="ant-col flex justify-end" style="flex: 1 1 auto;">
                                                    <button type="button"
                                                        class="ant-btn ant-btn-round ant-btn-default button-default mr-2" data-turn="${item.id}">
                                                        <span>Chọn chuyến</span>
                                                    </button>
                                                </div>

                                                </div>`
                                        }
                                    
                                    }) .filter(Boolean) // Remove any falsy values (null, undefined) from the array
                .join('')
                                } 
                                </div>
                            </div>
            `;
            }
        }).join('');
        tbody.innerHTML = html;

        calculateTotalPages(res.length);
        renderPagination();
    };

    const calculateTotalPages = (totalItems) => {
        totalPages = Math.ceil(totalItems / itemsPerPage);
    };

    const renderPagination = () => {
        let paginationHtml = '';

        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        }

        pagination.innerHTML = paginationHtml;

    };

    const changePage = (page) => {
        currentPage = page;
        startIndex = (currentPage - 1) * itemsPerPage;
        getData();
    };

    getData();
</script>
<script type="text/javascript">
    var debounceTimer;
    var $inputStart = $('#search_start');
    var $inputEnd = $('#search_end');
    var printedTripNames = [];


    $inputStart.on('keyup', searchTrips);
    $inputEnd.on('keyup', searchTrips);

    function searchTrips() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            var startValue = $inputStart.val().toLowerCase();
            var endValue = $inputEnd.val().toLowerCase();

            if (startValue || endValue) {
                $('.alldata').hide();
                $('.searchdata').show();
            } else {
                $('.alldata').show();
                $('.searchdata').hide();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('api/search_trip') }}',
                data: {
                    'search_start': startValue,
                    'search_end': endValue
                },
                success: function(data) {
                    console.log(data);
                    var $searchResults = $('#content');
                    $searchResults.empty();
                    printedTripNames = [];
                  

                    if (Array.isArray(data)) {
                        data.forEach(function(trip) {
                            var tripStart = trip.start_location;
                            var tripEnd = trip.end_location;

                            if (!printedTripNames.includes(tripStart)) {
                                printedTripNames.push(tripStart);
                                var tripsWithSameStart = data.filter(function(item) {
                                    return item.start_location === tripStart;
                                });

                                var output = `<div class="schedule-card flex w-full flex-col gap-[6px] text-left " style="margin-bottom:15px">
                                    ${tripsWithSameStart.map(function(item) {
                                        return `<div class="ant-row items-center">
                                            <div class="ant-col ant-col-6">
                                                <div class="flex w-full items-center gap-2">
                                                    <span class="font-medium text-orange">${item.start_location}</span>
                                                    <img src="https://futabus.vn/images/icons/ic_double_arrow.svg" alt="arrow">
                                                    <span>${item.end_location}</span>
                                                </div>
                                            </div>
                                            <div class="ant-col ant-col-2">${item.car_type_name}</div>
                                            <div class="ant-col ant-col-4">11 giờ 30 phút</div>
                                            <div class="ant-col ant-col-2">${item.trip_price}.000 VNĐ</div>
                                            <div class="ant-col flex justify-end" style="flex: 1 1 auto;">
                                                <button type="button" class="ant-btn ant-btn-round ant-btn-default button-default mr-2" data-turn="${item.id}">
                                                    <span>Chọn chuyến</span>
                                                </button>
                                            </div>
                                        </div>`;
                                    }).join('')}
                                </div>`;

                                $searchResults.append(output);
                             

                            }
                        });
                    }
                    
                }
                
            });
           
        }, 300);
        
    }
</script>
