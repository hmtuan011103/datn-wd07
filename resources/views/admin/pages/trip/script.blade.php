<script src={{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}></script>

<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<!-- listjs init -->
<script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Javascript Requirements -->
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.3/2.1.3/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

{!! JsValidator::formRequest('App\Http\Requests\Trip\StoreTripRequest') !!}

{{-- định dạng tiền tệ --}}
<script>
    function format_curency(a) {
        xuli = a.value.replaceAll('.', '');
        a.value = xuli.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    }
</script>


<script>
    function deleteMultiples() {
        var checkboxes = document.getElementsByName('rowCheckbox');
        var selectedRows = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedRows.push(checkboxes[i].value);
            }
        }
        console.log(selectedRows.length)
        var result = '';
        if (selectedRows.length > 0) {
            var result = confirm('Bạn có chắc chắn muốn xóa những chuyến này')
            if (result) {
                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/trip/delete/" +
                            selectedRows[a],
                        method: "GET"
                    });
                    var row = document.getElementById('row' + selectedRows[a]);
                    if (row) {
                        row.remove();
                        // style.display = 'none';
                    }
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Xóa chuyến đi thành công!",
                        showConfirmButton: !1,
                        timer: 2e3,
                        showCloseButton: !0,
                    })
                }
            } else {

            }

        } else {
            Swal.fire({
                title: "Vui lòng chọn ít nhất 1 chuyến đi",
                confirmButtonClass: "btn btn-danger",
                confirmButtonColor: '#d33',
            });
        }
    }
</script>
{{-- <script>
    $(document).ready(function() {
        $('.btn-show').click(function() {
            var url = $(this).attr('data-url');
            console.log(url);
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    // $('#show').modal('hide');
                    // console.log(response)
                    // var dateTime = new Date(response.data[0].start_date); // DateTime object
                    // var date = dateTime.getDate();

                    var dateTime = new Date(response.data[0].start_date); // DateTime object
                    var date = dateTime.getDate();
                    var month = dateTime.getMonth() +
                        1; // Lấy tháng từ 0-11, nên cộng thêm 1
                    var year = dateTime.getFullYear();
                    var fullDate = date + '/' + month + '/' + year;

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

                    $('label#car_name').text(response.data[3][0].car_name)
                    $('label#drive_name').text(response.data[1][0].drive_name)
                    $('label#assistantCar_name').text(response.data[2][0].assistantCar_name)
                    $('label#start_date').text(fullDate)
                    $('label#start_location').text(response.data[0].start_location)
                    $('label#end_location').text(response.data[0].end_location)
                    $('label#trip_price').text(response.data[0].trip_price)
                    $('label#start_time').text(response.data[0].start_time)
                    $('label#interval_trip').text(convertTime(response.data[0]
                        .interval_trip));

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    })
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.getElementsByClassName('btn-remove');

        Array.from(deleteButtons).forEach(function(button) {
            button.addEventListener('click', function() {
                var roleId = this.dataset
                    .roleId;
                var roleIdElement = document.getElementById('role-id');
                roleIdElement.textContent = roleId;
            });
        });
        document.getElementById('delete-record').addEventListener('click', function() {
            var roleId = document.getElementById('role-id')
                .textContent;
            var ajaxRequest = $.ajax({
                url: "http://127.0.0.1:8000/manage/trip/delete/" +
                    roleId,
                method: "GET"
            });
            var modalElement = document.getElementById('modalDelete');
            modalElement.style.display = 'none';
            window.location.reload();

            var row = document.getElementById('row' + roleId);
            if (row) {
                row.style.display = 'none';
            }
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Xóa chuyến đi thành công!",
                showConfirmButton: !1,
                timer: 2e3,
                showCloseButton: !0,
            })
        });
    });
</script> --}}
<script>
    function confirmDelete(itemId) {
        Swal.fire({
            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Xác nhận xóa?</h4><p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa đi không?</p></div></div>',
            showCancelButton: true,
            confirmButtonText: "Đồng ý",
            confirmButtonClass: "btn btn-primary w-xs mx-2 mb-1",
            cancelButtonText: "Hủy",
            cancelButtonClass: "btn btn-danger w-xs mb-1",
            reverseButtons: true,
            buttonsStyling: false,
            showCloseButton: true,
            customClass: {
                confirmButton: "btn btn-primary w-xs mx-2 mb-1",
                cancelButton: "btn btn-danger w-xs mb-1",
            },
        }).then((result) => {
            var rowdelete = document.getElementById('row' + itemId);
            if (result.isConfirmed) {
                var ajaxRequest = $.ajax({
                    url: "http://127.0.0.1:8000/manage/trip/delete/" +
                        itemId,
                    method: "GET"
                });
                if (rowdelete) {
                    rowdelete.remove();
                }
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Xóa vai trò thành công!",
                    showConfirmButton: !1,
                    timer: 2e3,
                    showCloseButton: !0,
                })

            }

        });
    }
</script>

{{-- click date --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('date-input');

        flatpickr(dateInput, {
            dateFormat: 'Y-m-d',
            // Các tùy chọn khác...
        });
    });
</script>

{{-- click time --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var timeInput = document.getElementById('time-input');

        flatpickr(timeInput, {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
        });
    });
</script>

<script>
    $("#timeInput").on("input", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });

    function formatTime() {
        const input = document.getElementById("timeInput");
        const pattern = /^\d{2}giờ \d{2}phút$/;
        const pattern1 = /^\d{2}giờ \d{1}phút$/;
        const pattern2 = /^giờ phút$/;
        const pattern3 = /^\d{1}giờ \d{2}phút$/;
        const pattern4 = /^\d{1}giờ \d{1}phút$/;
        let value = input.value;
        if (!pattern.test(value) && !pattern1.test(value) && !pattern2.test(value) && !pattern3.test(value) && !pattern4
            .test(value)) {
            if (value === "0") {
                input.value = "";
                return true;
            }
            if (value.length > 4) {
                value = value.substr(0, 4);
            }

            if (value.length <= 4) {
                let hour = value.substr(0, 2);
                const minute = value.substr(2);
                let formattedTime = "";
                if (minute >= 60) {
                    hour++;
                    const minutePr = minute - 60;
                    formattedTime = hour + "giờ " + minutePr + "phút";
                } else {
                    formattedTime = hour + "giờ " + minute + "phút";
                }
                input.value = formattedTime;
            }
            if (value.length <= 3) {
                let hour = value.substr(0, 1);
                const minute = value.substr(1, 2);
                let formattedTime = "";
                if (minute >= 60) {
                    hour++;
                    const minutePr = minute - 60;
                    formattedTime = hour + "giờ " + minutePr + "phút";
                } else {
                    formattedTime = hour + "giờ " + minute + "phút";
                }
                input.value = formattedTime;
            }
            if (value.length <= 2) {
                var formattedTime = value + "giờ " + "00phút";
                input.value = formattedTime;
            }
        }
    }

    var previousValue = "";

    function validateTime() {
        var input = document.getElementById("timeInput");
        var value = input.value;

        if (value.length === 4) {
            var hour = value.substr(0, 2);
            var minute = value.substr(2);
            // Kiểm tra nếu giờ hoặc phút không phải là số
            if (isNaN(hour) || isNaN(minute)) {
                // Khôi phục giá trị trước đó
                input.value = previousValue;
            } else {
                previousValue = value;
            }
        } else {
            previousValue = value;
        }
    }
</script>






{{-- lấy tài xế --}}
<script>
    var link = 'http://127.0.0.1:8000/api/data_user';
    fetch(link)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(item) {
                document.getElementById('driver').innerHTML +=
                    `<option value="${item.id}">${item.name}</option>`
            })
        })
</script>

{{-- lấy phụ xe  --}}
<script>
    var link = 'http://127.0.0.1:8000/api/data_user_assistant';
    fetch(link)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(item) {
                document.getElementById('assistant').innerHTML +=
                    `<option value="${item.id}">${item.name}</option>`
            })
        })
</script>

{{-- lấy điểm đến  --}}
<script>
    var link = 'http://127.0.0.1:8000/api/location/list_filter_location';
    fetch(link)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(item) {
                document.getElementById('depature_point').innerHTML +=
                    `<option value="${item.name}">${item.name}</option>`
            })
        })
</script>
<script>
    var link = 'http://127.0.0.1:8000/api/location/list_filter_location';
    fetch(link)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(item) {
                document.getElementById('destination').innerHTML +=
                    `<option value="${item.name}">${item.name}</option>`
            })
        })
</script>



{{-- filter  --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        function formatTimes(time) {
            var date = new Date(time);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            // Đảm bảo rằng ngày và tháng luôn có 2 chữ số
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }
            var formattedTime = day + '/' + month + '/' + year;
            return formattedTime;
        }

        function formatCurrency(amount) {
            var formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                minimumFractionDigits: 0,
            });

            var formattedCurrency = formatter.format(amount);
            return formattedCurrency;
        }

        function formatStartTime(time) {
            var parts = time.split(':');
            var hour = parts[0];
            var minute = parts[1];

            return hour + ':' + minute;
        }

        // $("#searchInput").on("input", function() {
        //     var searchKeyword = $(this).val();
        //     filterData(searchKeyword);
        // });

        // var`isFilterSelected = false; // Biến để kiểm tra xem người dùng đã chọn bất kỳ điều kiện nào hay chưa
        // var selectedDriver = [];
        // var selectedAssiant = [];
        // var selectedStartLocation = [];
        // var selectedEndLocation = [];
        // var selectedDateStart = [];

        // //Hàm để lọc dữ liệu
        // function filterData() {
        //     $.ajax({
        //         type: "GET",
        //         url: "http://127.0.0.1:8000/api/filter", // Đường dẫn tới tệp JSON chứa dữ liệu giả
        //         dataType: "json",
        //         success: function(data) {

        //             var filteredData = data.filter(function(item) {
        //                 // Kiểm tra xem loại xe và loại ghế nằm trong các loại đã chọn
        //                 return (
        //                     (selectedDriver.length === 0 || selectedDriver.includes(item
        //                         .drive_id)) &&
        //                     (selectedAssiant.length === 0 || selectedAssiant.includes(
        //                         item.assistantCar_id)) &&
        //                     (selectedStartLocation.length === 0 || selectedStartLocation
        //                         .includes(item.start_location)) &&
        //                     (selectedEndLocation.length === 0 || selectedEndLocation
        //                         .includes(item.end_location)) &&
        //                     (selectedDateStart.length === 0 || selectedDateStart
        //                         .includes(moment(item.start_date).format('YYYY-MM-DD')))
        //                 );
        //             });

        //             // Hiển thị kết quả lọc
        //             var result = "";
        //             if (filteredData.length > 0) {
        //                 filteredData.forEach(function(item) {
        //                     var formattedDate = moment(item.start_date).format('YYYY-MM-DD');
        //                     console.log(formattedDate);
        //                     var departureDateTime = moment(formattedDate + ' ' +
        //                         item.start_time); // Kết hợp ngày và giờ khởi hành
        //                     var currentTime = moment(); // Lấy thời gian hiện tại
        //                     var timeDifference = currentTime.diff(departureDateTime,
        //                         'minutes'); // Tính khoảng thời gian chênh lệch trong phút
        //                     var isWithinOneHour = timeDifference <= 120;

        //                     var routeDetail =
        //                         `http://127.0.0.1:8000/manage/trip/show/${item.id}`;
        //                     var routeEdit =
        //                         `http://127.0.0.1:8000/manage/trip/edit/${item.id}`;
        //                     var routeDelete =
        //                         `http://127.0.0.1:8000/manage/trip/delete/${item.id}`;
        //                     result += `
        //                         <tr id="row${item.id}">
        //                             <th scope="row">
        //                                 <div class="form-check">
        //                                     <input class="form-check-input" type="checkbox"
        //                                         name="rowCheckbox" value="${item.id}">
        //                                 </div>
        //                             </th>
        //                             <td class="id" style="display:none;"><a
        //                                                         href="javascript:void(0);"
        //                                                         class="fw-medium link-primary">#VZ2101</a></td>
        //                             <td class="customer_name">${item.start_location}</td>
        //                             <td class="email">${item.end_location}</td>
        //                             <td class="phone">${formatTimes( item.start_date)}</td>
        //                             <td class="date">${formatStartTime(item.start_time)}</td>
        //                             <td class="status">${formatCurrency(item.trip_price)}</td>
        //                             <td>
        //                             <div class="d-flex gap-2">
        //                                 <div class="detail">
        //                                 <button data-url="${routeDetail}" class="btn btn-primary btn-sm edit-item-btn btn-show" data-target="#show" data-toggle="modal">
        //                                     <i class="bx bx bx-show"></i>
        //                                 </button>
        //                                 </div>
        //                                 <div class="edit">
        //                                 <a href="${routeEdit}">
        //                                     <button class="btn btn-success btn-sm edit-item-btn">
        //                                     <i class="bx bx-edit"></i>
        //                                     </button>
        //                                 </a>
        //                                 </div>
        //                                 <div class="remove">
        //                                     <button class="btn btn-sm btn-danger btn-remove"
        //                                             onclick="confirmDelete(${item.id})" ><i class="bx bx-trash"></i></button>
        //                                 </div>
        //                             </div>
        //                             </td>
        //                         </tr>
        //                         `;
        //                 });
        //             } else {
        //                 $(".noresult").css("display", "block");
        //             }
        //             $(".form-check-all").html(result);


        //         }
        //     });
        // }

        // // Sử dụng Ajax để lọc dữ liệu khi có thay đổi trong checkbox và select
        // $("select").change(function() {
        //     isFilterSelected = true; // Đánh dấu là người dùng đã chọn bất kỳ điều kiện nào.
        //     filterData();
        // });
        // $("#departure-date").change(function() {
        //     isFilterSelected = true; // Đánh dấu là người dùng đã chọn bất kỳ điều kiện nào.
        //     filterData();
        // });

        // Lấy giá trị được chọn từ select và cập nhật vào mảng selectedDriver và selectedAssiant
        function updateSelectedValues() {
            selectedDateStart = $("#departure-date").val() || [];
            selectedDriver = $("#driver").val() || [];
            selectedAssiant = $("#assistant").val() || [];
            selectedStartLocation = $("#depature_point").val() || [];
            selectedEndLocation = $("#destination").val() || [];

        }

        // Kích hoạt sự kiện change trên select để cập nhật kết quả lọc
        $("#departure-date,#driver, #assistant, #depature_point, #destination").change(function() {
            updateSelectedValues();
            // $("input[type='date']").change();
        });

        // Hiển thị toàn bộ dữ liệu khi người dùng chưa chọn bất kỳ điều kiện nào
        $(window).on('load', function() {
            if (!isFilterSelected) {
                filterData();
            }
        });

        // Cập nhật giá trị ban đầu cho selectedDriver và selectedAssiant
        updateSelectedValues();


        $(document).on('click', '.btn-show', function() {
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    console.log(response);
                    $('label#car_name').text(response.data[3][0].car_name)
                    $('label#drive_name').text(response.data[1][0].drive_name)
                    $('label#assistantCar_name').text(response.data[2][0]
                        .assistantCar_name)
                    $('label#start_date').text(formatTimes(response.data[2][0]
                        .start_date))
                    $('label#start_location').text(response.data[2][0]
                        .start_location)
                    $('label#end_location').text(response.data[2][0]
                        .end_location)
                    $('label#trip_price').text(formatCurrency(response.data[2][
                        0
                    ].trip_price))
                    $('label#start_time').text(formatStartTime(response.data[2][
                        0
                    ].start_time))
                    $('label#interval_trip').text(formatStartTime(response.data[
                        2][0].interval_trip));

                }
            })
        });
    });
    $(document).on('click', '.btn-show-comment', function () {
        var url = $(this).attr('data-url');
        console.log(url);

        // Xóa dữ liệu cũ khi mở modal mới
        $('.modal-body .col-md-12').empty();

        $.ajax({
            type: 'get',
            url: url,
            success: function (data) {
                var comments = data.comments;
                if (comments.length >0){
                    for (var i = 0; i < comments.length; i++) {
                        var comment = comments[i];

                        // Tạo chuỗi chứa biểu tượng ngôi sao dựa trên số sao
                        var starsHTML = '';
                        for (var j = 0; j < comment.stars; j++) {
                            starsHTML += '⭐'; // Dùng ký tự Unicode cho ngôi sao
                        }
                        var commentHTML = '<p>Email: ' + comment.email + '</p>' +
                            '<p>Họ Tên: ' + comment.name + '</p>' +
                            '<p>Số Sao Đánh Giá: ' + starsHTML + '</p>' +
                            '<p>Nội dung: ' + comment.content + '</p>' +
                            '<hr>';
                        $('.modal-body .col-md-12').append(commentHTML);
                    }
                }else {
                    var noCommentHTML = '<p style="text-align: center"><b>Chưa có đánh giá nào từ khách hàng.</b></p>';
                    $('.modal-body .col-md-12').append(noCommentHTML);
                }

            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    // Sự kiện được kích hoạt khi modal được ẩn
    $('#yourModalId').on('hidden.bs.modal', function () {
        // Xóa dữ liệu khi modal được ẩn
        $('.modal-body .col-md-12').empty();
    });

</script>

<script src="{{ asset('client/assets/js/url-config.js') }}"></script>
<script>
    function confirmDelete(itemId) {
        Swal.fire({
            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Xác nhận xóa?</h4><p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa đi không?</p></div></div>',
            showCancelButton: true,
            confirmButtonText: "Đồng ý",
            confirmButtonClass: "btn btn-primary w-xs mx-2 mb-1",
            cancelButtonText: "Hủy",
            cancelButtonClass: "btn btn-danger w-xs mb-1",
            reverseButtons: true,
            buttonsStyling: false,
            showCloseButton: true,
            customClass: {
                confirmButton: "btn btn-primary w-xs mx-2 mb-1",
                cancelButton: "btn btn-danger w-xs mb-1",
            },
        }).then((result) => {
            var rowdelete = document.getElementById('row' + itemId);
            if (result.isConfirmed) {
                var ajaxRequest = $.ajax({
                    url: baseUrl + "/manage/trip/delete/" +
                        itemId,
                    method: "GET"
                });
                if (rowdelete) {
                    rowdelete.remove();
                }
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Xóa chuyến đi thành công!",
                    showConfirmButton: !1,
                    timer: 2e3,
                    showCloseButton: !0,
                })
            }

        });
    }
</script>

<script>
    document.getElementById('flexSwitchCheckDefault').addEventListener('change', function() {
        var numberOfDaysInput = document.getElementById('numberOfDaysInput');

        // Nếu checkbox được chọn, hiển thị ô số ngày lặp lại; ngược lại ẩn nó
        if (this.checked) {
            numberOfDaysInput.style.display = 'block';
        } else {
            numberOfDaysInput.style.display = 'none';
        }
    });
</script>

{{-- <script>
    // Gọi hàm này khi có sự thay đổi trong start_date hoặc route_id
    function handleInputChange() {
        // Lấy giá trị của start_date và route_id từ form
        const inputDate = document.getElementById('inputDate').value;
        const routeId = document.getElementById('routeSelect').value;

        // Tạo object chứa dữ liệu cần gửi đi
        const requestData = {
            start_date: inputDate,
            route_id: routeId
        };

        // Gửi yêu cầu bằng AJAX
        // Sử dụng fetch hoặc XMLHttpRequest để gửi yêu cầu tới API
        fetch('/api/getCarDriver', {
            method: 'POST', // Hoặc 'GET' tùy vào cách bạn xử lý ở phía server
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        })
        .then(response => {
            // Xử lý response từ server (nếu cần)
        })
        .catch(error => {
            // Xử lý lỗi (nếu có)
        });
    }

    // Gọi hàm handleInputChange khi có sự thay đổi trong start_date hoặc route_id
    document.getElementById('inputDate').addEventListener('change', handleInputChange);
    document.getElementById('routeSelect').addEventListener('change', handleInputChange);
</script> --}}

<script>
    $(document).ready(function() {
        // Tạo biến để kiểm tra xem đã nhập đủ thông tin hay chưa
        var inputDateEntered = false;
        var routeIdEntered = false;

        // Hàm kiểm tra xem đã nhập đủ thông tin chưa
        // function checkInputsAndSendRequest() {
        //     if (inputDateEntered && routeIdEntered) {
        //         sendAjaxRequest(); // Gửi yêu cầu khi đã nhập đủ thông tin
        //     }
        // }

        // Gửi yêu cầu khi đã nhập đủ cả inputDate và routeId
        function sendAjaxRequest() {
            var inputDate = $('#date-input').val();
            var routeId = $('#routeSelect').val();

            $.ajax({
                url: '/api/getCarDriver',
                type: 'POST',
                data: {
                    inputDate: inputDate,
                    routeId: routeId,
                },
                success: function(data) {
                    var $searchCarResults = $('#carSelect');
                    var $searchDriveResults = $('#driveSelect');
                    var $searchAssistantResults = $('#assistantSelect');

                    $searchCarResults.empty().prepend('<option value="">Chọn xe</option>');
                    $searchDriveResults.empty().prepend('<option value="">Chọn tài xế</option>');
                    $searchAssistantResults.empty().prepend(
                        '<option value="">Chọn phụ xe</option>');

                    data.cars.forEach(function(car) {
                        var output = `
                    <option value="${car.id}">${car.name}</option>
                `;
                        $searchCarResults.append(output);
                    });

                    data.userDrive.forEach(function(drive) {
                        var output = `
                    <option value="${drive.id}">${drive.name}</option>
                `;
                        $searchDriveResults.append(output);
                    });

                    data.assistantCar.forEach(function(assistant) {
                        var output = `
                    <option value="${assistant.id}">${assistant.name}</option>
                `;
                        $searchAssistantResults.append(output);
                    });
                },
                error: function() {
                    // Xử lý lỗi nếu có
                }
            });
        }

        // Kiểm tra khi có sự thay đổi trong trường input inputDate
        $('#date-input').on('input', function() {
            inputDate = $(this).val(); // Cập nhật giá trị inputDate
            sendAjaxRequest(); // Gọi hàm để kiểm tra và gửi yêu cầu
        });

        // Xử lý sự kiện khi có thay đổi ở routeSelect
        $('#routeSelect').on('change', function() {
            routeId = $(this).val(); // Cập nhật giá trị routeId
            sendAjaxRequest(); // Gọi hàm để kiểm tra và gửi yêu cầu
        });
    });
</script>


<script>
    $(document).ready(function() {
        var inputDate = $('#inputDate').val();
        var routeId = $('#inputRoute').val();

        // Gửi dữ liệu thông qua API ngay khi trang được tải
        sendData(inputDate, routeId);
    });

    // Hàm gửi dữ liệu thông qua API
    function sendData(inputDate, routeId) {
        $.ajax({
            url: '/api/get_available_drivers',
            type: 'POST',
            data: {
                inputDate: inputDate,
                routeId: routeId,
            },
            success: function(data) {
                console.log(data);
                var $searchCarResults = $('#carEdit');
                var $searchDriveResults = $('#driverEdit');
                var $searchAssistantResults = $('#assistantEdit');

                // Thêm dữ liệu từ API vào cuối dropdown
                data.car.forEach(function(car) {
                    var output = `<option value="${car.id}">${car.name}</option>`;
                    $searchCarResults.append(output);
                });

                data.userDriver.forEach(function(drive) {
                    var output = `<option value="${drive.id}">${drive.name}</option>`;
                    $searchDriveResults.append(output);
                });

                data.assistantCars.forEach(function(assistant) {
                    var output = `<option value="${assistant.id}">${assistant.name}</option>`;
                    $searchAssistantResults.append(output);
                });
            },
            error: function() {
                // Xử lý lỗi nếu có
            }
        });
    }
</script>
