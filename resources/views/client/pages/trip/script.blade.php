<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<script>
    const API = 'http://127.0.0.1:8000/api/data/';
    const tbody = document.querySelector('#list_trip');

    const getData = async () => {
        const res = await (await fetch(API)).json();
        const tripNames = new Set();
        const html = res.map(trip => {
                if (!tripNames.has(trip.start_location)) {
                    tripNames.add(trip.start_location);

                    function convertTime(timeString) {
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
                                                        class="ant-btn ant-btn-round ant-btn-default button-default mr-2">
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
            }).filter(Boolean)
            .join('');
        tbody.insertAdjacentHTML('beforeend', html);
    }
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
                                                <button type="button" class="ant-btn ant-btn-round ant-btn-default button-default mr-2">
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