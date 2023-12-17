<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var link = 'http://127.0.0.1:8000/';
    window.addEventListener('beforeunload', function() {
        localStorage.clear();
    });
    var currentpagetrip = '';
    fetch(link + 'api/searchtrip/get_type_car')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {

            data.forEach(function(item) {
                document.getElementById('type_car_all').innerHTML +=
                    `<button class="btn btn-light bg-white border border-1 me-2 fs-14 type-seat" data-type=${item.type_seats}>${ item.type_seats == 1 ? 'Ghế': (item.type_seats == 2 ? 'Giường' : 'Limousine') }</button>`
            })

        })
    document.addEventListener('DOMContentLoaded', function() {
        fetch(link + 'api/location/list_client_location')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var selectstartElement = document.getElementById('mySelectstart');
                var selectendElement = document.getElementById('mySelectend');
                var list = data[0];
                list.forEach(function(item) {
                    var optionstart = document.createElement('option');
                    optionstart.value = item.name;
                    optionstart.textContent = item.name;
                    selectstartElement.appendChild(optionstart);
                    var optionend = document.createElement('option');
                    optionend.value = item.name;
                    optionend.textContent = item.name;
                    selectendElement.appendChild(optionend);
                });

                var start_location_select = document.getElementById("mySelectstart");
                for (var i = 0; i < start_location_select.options.length; i++) {
                    if (start_location_select[i].value === start_location) {
                        start_location_select[i].selected = true;
                        break;
                    }
                }
                var end_location_select = document.getElementById("mySelectend");
                for (var i = 0; i < end_location_select.options.length; i++) {
                    if (end_location_select[i].value === end_location) {
                        end_location_select[i].selected = true;
                        break;
                    }
                }


            })
            .catch(function(error) {
                console.log('Error:', error);
            });

    });

    function showFormElement() {
        var one_way = document.getElementById("one-way");
        var formElement = document.getElementById("returndate");
        var element = document.getElementById("totalticket");
        if (one_way.checked) {
            formElement.style.display = 'none';
            element.classList.remove("col-4");
            element.classList.add("col");
        } else {
            formElement.style.display = 'block';
            element.classList.add("col-4");
            element.classList.remove("col");
        }
    }
    // flatpickr("#dateInput", {
    //     dateFormat: "d/m/Y",
    // });
    flatpickr("#dateInputstart", {
        minDate: "today",
        dateFormat: "d/m/Y",
        onChange: function(selectedDates, dateStr, instance) {
            // Kiểm tra ngày chọn sau khi thay đổi
            var selectedDate = selectedDates[0];
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            var error_start_time = document.getElementById("error_start_time");
            if (selectedDate < currentDate) {
                error_start_time.textContent = "Không thể chọn ngày trong quá khứ";
                // instance.clear(); // Xóa ngày đã chọn nếu không hợp lệ
            } else {
                error_start_time.textContent = "";
            }
        }
    });

    flatpickr("#dateInputend", {
        minDate: "today",
        dateFormat: "d/m/Y",
        onChange: function(selectedDates, dateStr, instance) {
            // Kiểm tra ngày chọn sau khi thay đổi
            var selectedDate = selectedDates[0];
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            var error_end_time = document.getElementById("error_end_time");
            if (selectedDate < currentDate) {
                error_end_time.textContent = "Không thể chọn ngày trong quá khứ";
                return;
                // instance.clear(); // Xóa ngày đã chọn nếu không hợp lệ
            } else {
                error_end_time.textContent = "";
            }

        }
    });



    function submitForm(event) {
        event.preventDefault();

        var type_ticket = document.querySelector('input[name="type-ticket"]:checked').value;
        var start_location = document.querySelector('select[name="start_location"]').value;
        var end_location = document.querySelector('select[name="end_location"]').value;
        var start_time = document.querySelector('input[name="start_time"]').value;
        var end_time = document.querySelector('input[name="end_time"]').value;
        var ticket = document.querySelector('select[name="ticket"]').value;

        var error_start_location = document.getElementById("error_start_location");
        var error_end_location = document.getElementById("error_end_location");
        var error_start_time = document.getElementById("error_start_time");
        var error_end_time = document.getElementById("error_end_time");
        var error_ticket = document.getElementById("error_ticket");
        var dateInputstart = document.getElementById("dateInputstart")._flatpickr.selectedDates[0];
        var dateInputend = document.getElementById("dateInputend")._flatpickr.selectedDates[0];
        if (start_location === '0') {
            Toastify({
                text: `Vui lòng chọn điểm đi`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_start_location.textContent = "Vui lòng chọn điểm đi";
            return;
        }
        // else {
        //     error_start_location.textContent = "";
        // }
        if (end_location === '0') {
            Toastify({
                text: `Vui lòng chọn điểm đến`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_end_location.textContent = "Vui lòng chọn điểm đến";
            return;
        }
        //  else {
        //     error_end_location.textContent = "";
        // }
        if (start_location === end_location) {
            Toastify({
                text: `Điểm đến phải khác điểm đi`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_end_location.textContent = "Điểm đến phải khác điểm đi";
            return;
        }
        // else {
        //     error_end_location.textContent = "";
        // }
        if (start_time === '') {
            Toastify({
                text: `Vui lòng chọn ngày đi`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_start_time.textContent = "Vui lòng chọn ngày đi"
            return;
        }
        // else {
        //     error_start_time.textContent = ""
        // }
        if (type_ticket === '2') {
            if (end_time === '') {
                Toastify({
                    text: `Vui lòng chọn ngày về`,
                    duration: 2000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#EF5222",
                        padding: "20px 10px",
                        borderRadius: '5px'
                    },
                }).showToast();
                // error_end_time.textContent = "Vui lòng chọn ngày về";
                return;
            }
            //  else {
            //     error_end_time.textContent = "";
            // }

            if (dateInputstart > dateInputend) {
                Toastify({
                    text: `Ngày về phải lớn hơn ngày đi`,
                    duration: 2000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#EF5222",
                        padding: "20px 10px",
                        borderRadius: '5px'
                    },
                }).showToast();
                // error_end_time.textContent = "Ngày về phải lớn hơn ngày đi";
                return;
            }
            //  else {
            //     error_end_time.textContent = "";
            // }
        }

        if (ticket > 5) {
            Toastify({
                text: `Số vé tối đa là 5`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_ticket.textContent = "Số vé tối đa là 5";
            return;
        }
        //  else {
        //     error_ticket.textContent = "";
        // }

        if (ticket < 1) {
            Toastify({
                text: `Số vé tối thiểu là 1`,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "#EF5222",
                    padding: "20px 10px",
                    borderRadius: '5px'
                },
            }).showToast();
            // error_ticket.textContent = "Số vé tối thiểu là 1";
            return;
        }
        //  else {
        //     error_ticket.textContent = "";
        // }

        var form = document.getElementById("searchForm");
        var formData = new FormData(form);
        var jsonData = {};

        // Chuyển đổi FormData thành JSON
        for (var pair of formData.entries()) {
            jsonData[pair[0]] = pair[1];
        }

        function addDataToCookieArray(data) {
            // Kiểm tra xem cookie có tồn tại hay không
            if (document.cookie.length > 0) {
                // Tách các cookie thành một mảng
                var cookies = document.cookie.split(';');

                // Tìm và cập nhật cookie chứa mảng dữ liệu
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();

                    // Kiểm tra xem cookie có chứa mảng dữ liệu hay không
                    if (cookie.indexOf('myData=') === 0) {
                        // Lấy giá trị của cookie
                        var cookieValue = cookie.substring('myData='.length);

                        // Chuyển đổi giá trị cookie thành mảng
                        var dataArray = JSON.parse(cookieValue);

                        // Thêm dữ liệu mới vào mảng
                        dataArray.push(data);

                        // Giới hạn số lượng phần tử trong mảng là 2
                        if (dataArray.length > 2) {
                            dataArray.shift(); // Xóa phần tử đầu tiên
                        }

                        // Cập nhật giá trị cookie với mảng dữ liệu mới
                        var expiresDate = new Date();
                        expiresDate.setDate(expiresDate.getDate() + 10); // Thời gian sống 10 ngày
                        document.cookie = 'myData=' + JSON.stringify(dataArray) + '; expires=' + expiresDate
                            .toUTCString();

                        return; // Kết thúc function sau khi cập nhật cookie
                    }
                }
            }

            // Nếu không tìm thấy cookie chứa mảng dữ liệu, tạo một cookie mới
            var newArray = [data];
            var expiresDate = new Date();
            expiresDate.setDate(expiresDate.getDate() + 10); // Thời gian sống 10 ngày
            document.cookie = 'myData=' + JSON.stringify(newArray) + '; expires=' + expiresDate.toUTCString();
        }
        addDataToCookieArray(jsonData)
        var queryString = Object.keys(jsonData).map(key => key + '=' + encodeURIComponent(jsonData[key])).join('&');
        $("#overlay").fadeIn(300);
        window.location.href = link + 'tim-kiem?' + queryString;
        window.onload = function() {
            $("#overlay").fadeOut(300);
        };
    }

    function getDataFromCookieArray() {
        var dataArray = [];

        // Kiểm tra xem cookie có tồn tại hay không
        if (document.cookie.length > 0) {
            // Tách các cookie thành một mảng
            var cookies = document.cookie.split(';');

            // Tìm và lấy cookie chứa mảng dữ liệu
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();

                // Kiểm tra xem cookie có chứa mảng dữ liệu hay không
                if (cookie.indexOf('myData=') === 0) {
                    // Lấy giá trị của cookie
                    var cookieValue = cookie.substring('myData='.length);

                    // Chuyển đổi giá trị cookie thành mảng
                    dataArray = JSON.parse(cookieValue);
                    break; // Thoát khỏi vòng lặp sau khi lấy dữ liệu
                }
            }
        }

        return dataArray;
    }

    function calculateEndTime(startTime, duration) {
        var startTimeParts = startTime.split(":");
        var durationParts = duration.split(":");

        var startHours = parseInt(startTimeParts[0]);
        var startMinutes = parseInt(startTimeParts[1]);
        var startSeconds = parseInt(startTimeParts[2]);

        var durationHours = parseInt(durationParts[0]);
        var durationMinutes = parseInt(durationParts[1]);
        var durationSeconds = parseInt(durationParts[2]);

        var totalStartSeconds = startHours * 3600 + startMinutes * 60 + startSeconds;
        var totalDurationSeconds = durationHours * 3600 + durationMinutes * 60 + durationSeconds;

        var totalSeconds = (totalStartSeconds + totalDurationSeconds) % (24 * 3600);

        var endHours = Math.floor(totalSeconds / 3600);
        var endMinutes = Math.floor((totalSeconds % 3600) / 60);
        var endSeconds = totalSeconds % 60;

        return (
            ("0" + endHours).slice(-2) +
            ":" +
            ("0" + endMinutes).slice(-2)
        );
    }
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var type_ticket = urlParams.get('type-ticket');
    var start_location = urlParams.get('start_location');
    var end_location = urlParams.get('end_location');
    var start_time = urlParams.get('start_time');
    var end_time = urlParams.get('end_time');
    var ticket = urlParams.get('ticket');


    var jsonData = {
        type_ticket: type_ticket,
        start_location: start_location,
        end_location: end_location,
        start_date: start_time,
        end_time: end_time,
        ticket: ticket,
    };
    const optionValue = type_ticket;
    const radioInputs = document.querySelectorAll('input[name="type-ticket"]');

    radioInputs.forEach(input => {
        if (input.value === optionValue) {
            input.checked = true;
        }
        showFormElement();
    })
    const specificDatestart = start_time;
    const flatpickrInstance = flatpickr("#dateInputstart", {
        dateFormat: "d/m/Y",
        minDate: "today",
        defaultDate: specificDatestart,
    });
    const specificDateend = end_time;
    const flatpickrInstanceend = flatpickr("#dateInputend", {
        dateFormat: "d/m/Y",
        minDate: "today",
        defaultDate: specificDateend,
    });

    var ticket_select = document.getElementById("tickettotal");
    for (var i = 0; i < ticket_select.options.length; i++) {
        if (ticket_select[i].value === ticket) {
            ticket_select[i].selected = true;
            break;
        }
    }



    const part = start_time.split("/");
    const day = part[0];
    const month = part[1];
    const year = part[2];
    const start_date = `${year}/${month}/${day}`;

    if (end_time != '' && type_ticket == 2) {
        const parts = end_time.split("/");
        const days = parts[0];
        const months = parts[1];
        const years = parts[2];
        var end_date = `${years}/${months}/${days}`;
    } else {
        var end_date = end_time;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var fetchapisearch = link + 'api/searchtrip?start_location=' + start_location + '&end_location=' +
            end_location +
            '&start_date=' + start_date + '&end_date=' + end_date + '&ticket=' + ticket + '&type_ticket=' +
            type_ticket;
        fetch(fetchapisearch)
            .then(function(response) {
                return response.json();
            })
            .then(function(datadefault) {

                if (datadefault.status == 0) {
                    data = datadefault
                } else if (datadefault.status == 1) {
                    if (Array.isArray(datadefault[0])) {
                        var data = datadefault[0]
                    } else {
                        var data = Object.values(datadefault[0]);
                    }
                } else {
                    if (Array.isArray(datadefault[0][0])) {
                        var datastart = datadefault[0][0]
                    } else {
                        var datastart = Object.values(datadefault[0][0]);
                    }
                    if (Array.isArray(datadefault[0][1])) {
                        var dataend = datadefault[0][1]
                    } else {
                        var dataend = Object.values(datadefault[0][1]);
                    }
                    data = [datastart, dataend]
                }

                var countfilter = 0;
                showFilterSearch(datadefault, data, countfilter)
                const checkedOptions = [];
                const checkedTypes = [];
                const checkedFloors = [];
                const checkedRowSeats = [];
                function filterData(data, checkedOptions, checkedTypes, checkedFloors, checkedRowSeats) {
                    if (checkedOptions.length === 0 && checkedTypes.length === 0 && checkedFloors.length ===
                        0 && checkedRowSeats.length === 0) {
                        return data;
                    }
                    if (Array.isArray(data[0])) {
                        var datafilter0 = data[0].filter((item) => {
                            return filter_search(item,checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);
                        });

                        var datafilter1 = data[1].filter((item) => {
                            return filter_search(item,checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);
                        });
                        return [datafilter0, datafilter1]
                    } else {
                        return data.filter((item) => {
                            return filter_search(item,checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);
                        });
                    }

                }

                //Hàm xử lý sự kiện khi checkbox thay đổi
                function handleCheckboxChange(event) {
                    const checkbox = event.target;
                    const value = checkbox.value;

                    if (checkbox.checked) {
                        // Nếu checkbox được chọn, thêm giá trị vào mảng checkedOptions
                        checkedOptions.push(value);
                    } else {
                        // Nếu checkbox không được chọn, loại bỏ giá trị khỏi mảng checkedOptions
                        const index = checkedOptions.indexOf(value);
                        if (index > -1) {
                            checkedOptions.splice(index, 1);
                        }
                    }
                    // Lọc dữ liệu
                    const filteredData = filterData(data, checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);
                    // Hiển thị kết quả
                    var countfilter = 1;
                    showFilterSearch(datadefault, filteredData, countfilter);
                }


                // Hàm xử lý sự kiện khi button loại thay đổi
                function handleTypeButtonClick(event) {
                    const button = event.target;
                    const type = button.dataset.type;

                    if (button.classList.contains("active")) {
                        // Nếu button đã được chọn, loại bỏ loại khỏi mảng checkedTypes
                        const index = checkedTypes.indexOf(type);
                        if (index > -1) {
                            checkedTypes.splice(index, 1);
                        }
                        button.classList.remove("active");
                    } else {
                        // Nếu button chưa được chọn, thêm loại vào mảng checkedTypes
                        checkedTypes.push(type);
                        button.classList.add("active");
                    }

                    // Lọc dữ liệu
                    const filteredData = filterData(data, checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);

                    // Hiển thị kết quả
                    var countfilter = 0;
                    showFilterSearch(datadefault, filteredData, countfilter);

                }

                function handleFloorButtonClick(event) {
                    const button = event.target;
                    const type = button.dataset.type;
                    if (button.classList.contains("active")) {
                        // Nếu button đã được chọn, loại bỏ loại khỏi mảng checkedFloors
                        const index = checkedFloors.indexOf(type);
                        if (index > -1) {
                            checkedFloors.splice(index, 1);
                        }
                        button.classList.remove("active");
                    } else {
                        // Nếu button chưa được chọn, thêm loại vào mảng checkedFloors
                        checkedFloors.push(type);
                        button.classList.add("active");
                    }

                    // Lọc dữ liệu
                    const filteredData = filterData(data, checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);

                    // Hiển thị kết quả
                    var countfilter = 0;
                    showFilterSearch(datadefault, filteredData, countfilter);

                }
                function handleRowSeatButtonClick(event) {
                    const button = event.target;
                    const type = button.dataset.type;
                    if (button.classList.contains("active")) {
                        // Nếu button đã được chọn, loại bỏ loại khỏi mảng checkedFloors
                        const index = checkedRowSeats.indexOf(type);
                        if (index > -1) {
                            checkedRowSeats.splice(index, 1);
                        }
                        button.classList.remove("active");
                    } else {
                        // Nếu button chưa được chọn, thêm loại vào mảng checkedFloors
                        checkedRowSeats.push(type);
                        button.classList.add("active");
                    }
                    // Lọc dữ liệu
                    const filteredData = filterData(data, checkedOptions, checkedTypes, checkedFloors, checkedRowSeats);
                    // Hiển thị kết quả
                    var countfilter = 0;
                    showFilterSearch(datadefault, filteredData, countfilter);

                }
                //Gắn sự kiện cho các checkbox khi tài liệu HTML đã được tải và sẵn sàng
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("change", handleCheckboxChange);
                });

                // Gắn sự kiện cho các button loại xe khi tài liệu HTML đã được tải và sẵn sàng
                const typeButtons = document.querySelectorAll(".type-seat");
                typeButtons.forEach((button) => {
                    button.addEventListener("click", handleTypeButtonClick);
                });
                // Gắn sự kiện cho các button tầng khi tài liệu HTML đã được tải và sẵn sàng
                const floorButtons = document.querySelectorAll(".floor");
                floorButtons.forEach((button) => {
                    button.addEventListener("click", handleFloorButtonClick);
                });
                const rowSeatButtons = document.querySelectorAll(".rowseat");
                rowSeatButtons.forEach((button) => {
                    button.addEventListener("click", handleRowSeatButtonClick);
                });

            })

        function showFilterSearch(data, datafilter, countfilter) {
            if (data.status == 0 || datafilter.length == 0) {
                document.getElementById('searchresultfalse').style.display = 'block';
                document.getElementById('searchresulttrue').style.display = 'none';
                if (countfilter != 1) {
                    document.getElementById('count0006').innerHTML = `(0)`
                    document.getElementById('count0612').innerHTML = `(0)`
                    document.getElementById('count1218').innerHTML = `(0)`
                    document.getElementById('count1824').innerHTML = `(0)`
                }
            } else if (data.status == 1) {

                var count0006 = datafilter.filter(item => item.start_time > '00:00:00' && item.start_time <=
                    '06:00:00').length;
                var count0612 = datafilter.filter(item => item.start_time > '06:00:00' && item.start_time <=
                    '12:00:00').length;
                var count1218 = datafilter.filter(item => item.start_time > '12:00:00' && item.start_time <=
                    '18:00:00').length;
                var count1824 = datafilter.filter(item => item.start_time > '18:00:00' && item.start_time <=
                    '24:00:00').length;

                if (countfilter != 1) {
                    document.getElementById('count0006').innerHTML = `(${count0006})`
                    document.getElementById('count0612').innerHTML = `(${count0612})`
                    document.getElementById('count1218').innerHTML = `(${count1218})`
                    document.getElementById('count1824').innerHTML = `(${count1824})`
                }



                document.getElementById('searchresultfalse').style.display = 'none';
                document.getElementById('searchresulttrue').style.display = 'block';
                document.getElementById('searchresults').innerHTML = '';
                datafilter.forEach(function(item) {
                    document.getElementById('start_end').innerHTML = '';
                    document.getElementById('start_end').innerHTML =
                        `${item.start_location} - ${item.end_location} (${datafilter.length})`;
                    var type_seat = item.car.type_car.type_seats == 1 ? 'Ghế' : 'Giường';
                    var htmlresult =
                        `<div class="p-4 border border-1 rounded-3 mt-3 w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0 pe-3 fw-medium">${item.start_time.slice(0, -3)}</p>
                                    <img src="{{ asset('client/assets/images/start_place.svg') }}" alt="">
                                    <span class="border-dotted"></span>
                                    <div class="ta-center show-time-run">
                                        <p class="fw-medium mb-0">${parseInt(item.interval_trip.substring(0, 2))} giờ</p>
                                        <p class="fs-13 fw-medium">(Asian/Ho Chi Minh)</p>
                                    </div>
                                    <span class="border-dotted"></span>
                                    <img src="{{ asset('client/assets/images/end_place.svg') }}" alt="">
                                    <p class="mb-0 ps-3 fw-medium">${calculateEndTime(item.start_time,item.interval_trip)}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 fs-15 fw-medium">${item.start_location}</p>
                                    <p class="mb-0 fs-15 fw-medium">${item.end_location}</p>
                                </div>
                                <div class="d-flex pt-4 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${item.trip_price.toLocaleString("vi-VN")}đ</p>
                                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${type_seat} </p>
                                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${item.seat_empty} chỗ trống</p>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4" onclick="redirectToSelectSeat(this)"  data-turn="${item.id}">Chọn
                                            chuyến</button>
                                    </div>
                                </div>
                            </div>`;
                    document.getElementById('searchresults').innerHTML += htmlresult;


                });
            } else {
                document.getElementById('searchresultfalse').style.display = 'none';
                document.getElementById('searchresulttrue').style.display = 'block';
                document.getElementById('searchresults').innerHTML = '';
                document.getElementById('type_ticket_two').innerHTML =
                    `<div
                        class="header-popover-custom mt-8 hidden text-center text-base font-medium uppercase sm:flex sm:bg-white row pe-4 ps-4 pt-5">
                        <div class="col mb-3 fs-5 fw-medium pb-4" id="showtripstart">
                            Chuyến đi - ${start_time}</div>
                        <div class="col mb-3 fs-5 fw-medium pb-4" id="showtripend">Chuyến về
                            - ${end_time}</div>
                    </div>`;
                var tripstart = document.getElementById('showtripstart');
                var tripend = document.getElementById('showtripend');

                tripstart.addEventListener('click', function() {
                    currentpagetrip = 'start';
                    tripstart.style.borderBottom = '3px solid red';
                    tripstart.style.color = 'red';
                    tripend.style.borderBottom = '1px solid rgba(130, 122, 122, 0.823)';
                    tripend.style.color = 'black';
                    document.getElementById('searchresults').innerHTML = '';
                    var count0006 = datafilter[0].filter(item => item.start_time > '00:00:00' && item
                        .start_time <= '06:00:00').length;
                    var count0612 = datafilter[0].filter(item => item.start_time > '06:00:00' && item
                        .start_time <= '12:00:00').length;
                    var count1218 = datafilter[0].filter(item => item.start_time > '12:00:00' && item
                        .start_time <= '18:00:00').length;
                    var count1824 = datafilter[0].filter(item => item.start_time > '18:00:00' && item
                        .start_time <= '24:00:00').length;
                    if (countfilter != 1) {
                        document.getElementById('count0006').innerHTML = `(${count0006})`
                        document.getElementById('count0612').innerHTML = `(${count0612})`
                        document.getElementById('count1218').innerHTML = `(${count1218})`
                        document.getElementById('count1824').innerHTML = `(${count1824})`
                    }

                    if (datafilter[0].length == 0) {
                        document.getElementById('searchresults').innerHTML =
                            `<div class=" ps-4 text-center">
                                <div class="ant-empty mt-20 mb-4 mt-5">
                                    <div class="mb-3"><img src="https://futabus.vn/images/empty_list.svg" alt="empty_list" width="260">
                                    </div>
                                    <div class="fs-5 fw-bold">Không có kết quả được tìm thấy.</div>
                                </div>
                            </div>`;
                    } else {
                        datafilter[0].forEach(function(item) {
                            document.getElementById('start_end').innerHTML = '';
                            document.getElementById('start_end').innerHTML =
                                `${item.start_location} - ${item.end_location} (${datafilter[0].length})`;
                            var type_seat = item.car.type_car.type_seats == 1 ? 'Ghế' :
                                'Giường';

                            var htmlresult =
                                `<div class="p-4 border border-1 rounded-3 mt-3 w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 pe-3 fw-medium">${item.start_time.slice(0, -3)}</p>
                                <img src="{{ asset('client/assets/images/start_place.svg') }}" alt="">
                                <span class="border-dotted"></span>
                                <div class="ta-center show-time-run">
                                    <p class="fw-medium mb-0">${parseInt(item.interval_trip.substring(0, 2))} giờ</p>
                                    <p class="fs-13 fw-medium">(Asian/Ho Chi Minh)</p>
                                </div>
                                <span class="border-dotted"></span>
                                <img src="{{ asset('client/assets/images/end_place.svg') }}" alt="">
                                <p class="mb-0 ps-3 fw-medium">${calculateEndTime(item.start_time,item.interval_trip)}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 fs-15 fw-medium">${item.start_location}</p>
                                <p class="mb-0 fs-15 fw-medium">${item.end_location}</p>
                            </div>
                            <div class="d-flex pt-4 justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <p class="fs-14 mb-0 cl-orange fw-medium">${item.trip_price.toLocaleString("vi-VN")}đ</p>
                                    <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                    <p class="fs-14 mb-0 cl-orange fw-medium">${type_seat}</p>
                                    <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                    <p class="fs-14 mb-0 cl-orange fw-medium">${item.seat_empty} chỗ trống</p>
                                </div>
                                <div>
                                    <button
                                        class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4 buttontrip" onclick="handleClick(this,event)" data-type='start' data-id="${item.id}">Chọn
                                        chuyến</button>
                                </div>
                            </div>
                        </div>`;
                            document.getElementById('searchresults').innerHTML +=
                                htmlresult;
                            buttonselected = document.querySelector(
                                `.buttontrip[data-id="${localStorage.getItem('buttontrip')}"]`
                            )
                            if (buttonselected !== null) {
                                buttonselected.style.backgroundColor = '#F9821D';
                                buttonselected.style.color = '#fff';
                            }

                        });
                    }

                });

                tripend.addEventListener('click', function() {

                    currentpagetrip = 'end';
                    tripend.style.borderBottom = '3px solid red';
                    tripend.style.color = 'red';
                    tripstart.style.borderBottom = '1px solid rgba(130, 122, 122, 0.823)';
                    tripstart.style.color = 'black';
                    var count0006 = datafilter[1].filter(item => item.start_time > '00:00:00' && item
                        .start_time <= '06:00:00').length;
                    var count0612 = datafilter[1].filter(item => item.start_time > '06:00:00' && item
                        .start_time <= '12:00:00').length;
                    var count1218 = datafilter[1].filter(item => item.start_time > '12:00:00' && item
                        .start_time <= '18:00:00').length;
                    var count1824 = datafilter[1].filter(item => item.start_time > '18:00:00' && item
                        .start_time <= '24:00:00').length;

                    if (countfilter != 1) {
                        document.getElementById('count0006').innerHTML = `(${count0006})`
                        document.getElementById('count0612').innerHTML = `(${count0612})`
                        document.getElementById('count1218').innerHTML = `(${count1218})`
                        document.getElementById('count1824').innerHTML = `(${count1824})`
                    }
                    document.getElementById('searchresults').innerHTML = '';

                    if (Array.isArray(data[0][1])) {
                        var result = data[0][1]
                    } else {
                        var result = Object.values(data[0][1]);
                    }

                    if (datafilter[1].length == 0) {
                        document.getElementById('searchresults').innerHTML =
                            `<div class=" ps-4 text-center">
                                <div class="ant-empty mt-20 mb-4 mt-5">
                                    <div class="mb-3"><img src="https://futabus.vn/images/empty_list.svg" alt="empty_list" width="260">
                                    </div>
                                    <div class="fs-5 fw-bold">Không có kết quả được tìm thấy.</div>
                                </div>
                            </div>`;
                    } else {
                        datafilter[1].forEach(function(item) {
                            document.getElementById('start_end').innerHTML = '';
                            document.getElementById('start_end').innerHTML =
                                `${item.start_location} - ${item.end_location} (${datafilter[1].length})`;
                            var type_seat = item.car.type_car.type_seats == 1 ? 'Ghế' :
                                'Giường';

                            var htmlresult =
                                `<div class="p-4 border border-1 rounded-3 mt-3 w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0 pe-3 fw-medium">${item.start_time.slice(0, -3)}</p>
                                    <img src="{{ asset('client/assets/images/start_place.svg') }}" alt="">
                                    <span class="border-dotted"></span>
                                    <div class="ta-center show-time-run">
                                        <p class="fw-medium mb-0">${parseInt(item.interval_trip.substring(0, 2))} giờ</p>
                                        <p class="fs-13 fw-medium">(Asian/Ho Chi Minh)</p>
                                    </div>
                                    <span class="border-dotted"></span>
                                    <img src="{{ asset('client/assets/images/end_place.svg') }}" alt="">
                                    <p class="mb-0 ps-3 fw-medium">${calculateEndTime(item.start_time,item.interval_trip)}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 fs-15 fw-medium">${item.start_location}</p>
                                    <p class="mb-0 fs-15 fw-medium">${item.end_location}</p>
                                </div>
                                <div class="d-flex pt-4 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${item.trip_price.toLocaleString("vi-VN")}đ</p>
                                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${type_seat}</p>
                                        <p class="mx-2 mb-0 circle-menu-style rounded-pill"></p>
                                        <p class="fs-14 mb-0 cl-orange fw-medium">${item.seat_empty} chỗ trống</p>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-primary fs-14 fw-medium cl-orange rounded-pill bg-button-choose-trip px-4 buttontrip" onclick="handleClick(this,event)" data-type='end' data-id="${item.id}">Chọn
                                            chuyến</button>
                                    </div>
                                </div>
                            </div>`;
                            document.getElementById('searchresults').innerHTML +=
                                htmlresult;
                            buttonselected = document.querySelector(
                                `.buttontrip[data-id="${localStorage.getItem('buttontrip')}"]`
                            )
                            if (buttonselected !== null) {
                                buttonselected.style.backgroundColor = '#F9821D';
                                buttonselected.style.color = '#fff';
                            }

                        });
                    }
                });
                if (currentpagetrip == 'end') {
                    tripend.click()
                } else {
                    tripstart.click()
                }

            }
        }

        var myDataArray = getDataFromCookieArray();
        var formId = 0;
        myDataArray.forEach(function(data) {
            formId++;
            if (myDataArray.length > 0) {
                document.getElementById('searchrecently').innerHTML +=
                    `<a href="#" onclick="submitFormCookie('${formId}')"
                        class="col-2 bg-search-latest fs-15 border border-1 rounded-2 mx-2 text-decoration-none cl-black">
                        <div class="d-flex py-2">
                            <p class="m-0 p-0 fs-15">${data.start_location}</p>
                            <p class="px-1 py-0 m-0 fs-15"> - </p>
                            <p class="m-0 p-0 fs-15">${data.end_location}</p>
                        </div>
                        <p class="p-0  fs-13">${data.start_time}</p>
                    </a>`
                document.getElementById('formsearchcookie').innerHTML +=
                    `<form id="myFormCookie${formId}" action="${link + 'tim-kiem'}" onsubmit="submitForm(event)" >
                        <input class="form-check-input cursor" type="radio" name="type-ticket"
                            id="one-way" value="${data['type-ticket']}" checked>
                        <select class="form-select py-3" aria-label="Default select example" name="start_location">
                            <option value="${data.start_location}" selected></option>
                        </select>
                        <select class="form-select py-3" aria-label="Default select example" name="end_location">
                            <option value="${data.end_location}" selected></option>
                        </select>
                        <input type="text" class="form-control py-3" name="start_time" value="${data.start_time}">
                        <input type="text" class="form-control py-3" name="end_time" value="${data.end_time}">
                        <select class="form-select py-3" name="ticket" id="tickettotal" aria-label="Default select example">
                            <option value="${data.ticket}" selected>1</option>
                        </select>
                        <button>abc</button>
                    </form>`

            }
        });

    })

    function submitFormCookie(formId) {
        var form = document.getElementById("myFormCookie" + formId);
        form.submit();
    }

    var selectedButtons = [];

    function redirectToSelectSeat(button) {
        $("#overlay").fadeIn(300);
        const tripTurn = button.getAttribute('data-turn');
        window.location.href = `/chon-ghe?trip_turn=${tripTurn}`;
        window.onload = function() {
            $("#overlay").fadeOut(300);
        };
    }

    function handleClick(button, event) {
        event.preventDefault();

        var dataId = button.getAttribute("data-id");
        var dataType = button.getAttribute("data-type");

        button.style.backgroundColor = '#F9821D';
        button.style.color = '#fff';
        if (selectedButtons.length === 2) {
            var b1 = selectedButtons[0].getAttribute('data-id')
            var b2 = selectedButtons[1].getAttribute('data-id')
            return;
        }

        if (selectedButtons.length === 1) {
            var existingButton = selectedButtons[0];
            var existingButtonType = existingButton.getAttribute("data-type");
            if (dataType !== existingButtonType) {
                // Khác data-type, không xóa nút cũ, chỉ thêm nút mới
                selectedButtons.push(button);

                if (selectedButtons[0].getAttribute("data-type") == 'start') {
                    var b1 = selectedButtons[0].getAttribute('data-id')
                    var b2 = selectedButtons[1].getAttribute('data-id')
                } else {
                    var b2 = selectedButtons[0].getAttribute('data-id')
                    var b1 = selectedButtons[1].getAttribute('data-id')
                }
                // datatrip = selectedButtons.map(function(button) {
                //     return button.getAttribute('data-id');
                // });
                selectedButtons[1].setAttribute('data-turn', b1);
                selectedButtons[1].setAttribute('data-return', b2);
                localStorage.removeItem("buttontrip")
                $("#overlay").fadeIn(300);
                window.location.href = `/chon-ghe?trip_turn=${b1}&trip_return=${b2}`;
                window.onload = function() {
                    $("#overlay").fadeOut(300);
                };
            } else {
                buttonselected = document.querySelector(
                    `.buttontrip[data-id="${localStorage.getItem('buttontrip')}"]`
                )
                if (button.getAttribute('data-id') === selectedButtons[0].getAttribute('data-id')) {

                } else {
                    if (buttonselected !== null) {
                        buttonselected.style.backgroundColor = '#FDE5DE';
                        buttonselected.style.color = '#F9821D';
                        localStorage.setItem("buttontrip", button.getAttribute("data-id"));
                    }
                    // Cùng data-type, xóa nút cũ và thêm nút mới
                    selectedButtons[0].style.backgroundColor = '#FDE5DE';
                    selectedButtons[0].style.color = '#F9821D';
                    var indexToRemove = selectedButtons.indexOf(existingButton);
                    selectedButtons.splice(indexToRemove, 1);
                    selectedButtons.push(button);
                    console.log(selectedButtons[0])
                }

            }
        } else {
            selectedButtons.push(button);
            localStorage.setItem("buttontrip", button.getAttribute("data-id"));
        }
    }

    function filter_search(item,checkedOptions, checkedTypes, checkedFloors, checkedRowSeats) {
        const startTime = new Date(`2000-01-01T${item.start_time}`);
        const startHour = startTime.getHours();
        let dataresult = true;
        if (checkedOptions.length > 0) {
            dataresult = false;
            for (const option of checkedOptions) {
                const [start, end] = option.split("-");
                const startHourOption = parseInt(start);
                const endHourOption = parseInt(end);

                if (startHour > startHourOption && startHour <= endHourOption) {
                    dataresult = true;
                    break;
                }
            }
        }
        if (dataresult == false) {
            return false;
        }
        if (checkedTypes.length > 0) {
            dataresult = checkedTypes.includes(item.car.type_car.type_seats
                .toString());
        }
        if (dataresult == false) {
            return false;
        }
        var seat_code = item.seat_code;
        var result = [];
        for (var key in seat_code) {
            if (seat_code.hasOwnProperty(key)) {
                var value = seat_code[key];
                var number = value.replace(/\d/g, "");
                result.push(number);
            }
        }
        var countdown = 0;
        var countup = 0;
        for (var i = 0; i < result.length; i++) {
            if (result[i] == 'A') {
                countdown++;
            } else if (result[i] == 'B') {
                countup++;
            }
        }
        let matchFloor = true;
        if (checkedFloors.length > 0) {
            if (checkedFloors == 'down') {
                if (countdown > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            } else if (checkedFloors == 'up') {
                if (countup > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            } else {
                if (countup > 0 && countdown > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }
        }
        if (dataresult == false) {
            return false;
        }

        var resultstring = [];
        for (var key in seat_code) {
            if (seat_code.hasOwnProperty(key)) {
                var value = seat_code[key];
                var number = parseInt(value.replace(/\D/g, ""));
                resultstring.push(number);
            }
        }
        var counttop = 0;
        var countmid = 0;
        var countend = 0;
        for (var i = 0; i < resultstring.length; i++) {
            numberseat = parseInt(resultstring[i]);
            if (numberseat <= 6) {
                counttop++;
            } else if (numberseat > 6 && numberseat <= 18) {
                countmid++;
            }else if (numberseat > 18) {
                countend++
            }
        }
        if (checkedRowSeats.length == 1) {
            if (checkedRowSeats == 'top') {
                if (counttop > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            } else if (checkedRowSeats == 'mid') {
                if (countmid > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }else if (checkedRowSeats == 'end') {
                if (countend > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }
            // else if (checkedRowSeats == ['end', 'mid']) {
            //     if (countend > 0) {
            //         dataresult = true
            //     } else {
            //         dataresult = false
            //     }
            // }
        }else if (checkedRowSeats.length == 2) {
            if ((checkedRowSeats[0] == 'top' && checkedRowSeats[1] == 'mid') || (checkedRowSeats[0] == 'mid' && checkedRowSeats[1] == 'top')) {
                if (counttop > 0 && countmid > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }
            if ((checkedRowSeats[0] == 'top' && checkedRowSeats[1] == 'end') || (checkedRowSeats[0] == 'end' && checkedRowSeats[1] == 'top')) {
                if (counttop > 0 && countmid > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }
            if ((checkedRowSeats[0] == 'mid' && checkedRowSeats[1] == 'end') || (checkedRowSeats[0] == 'end' && checkedRowSeats[1] == 'mid')) {
                if (counttop > 0 && countmid > 0) {
                    dataresult = true
                } else {
                    dataresult = false
                }
            }
        }else{
            dataresult = true
        }
        return dataresult;
    }
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
