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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.3/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

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

{{-- show detail --}}
{{-- <script
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}

<script>
    $(document).ready(function() {
        $('.btn-show').click(function() {
            var url = $(this).attr('data-url');
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
                    $('label#interval_trip').text(convertTime(response.data[0].interval_trip));

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })
    })
</script>

<script>
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
            location.href = location.href;

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
    function formatTime() {
        var input = document.getElementById("timeInput");
        var value = input.value;

        if (value.length === 4) {
            var hour = value.substr(0, 2);
            var minute = value.substr(2);
            var formattedTime = hour + "giờ " + minute + "phút";
            input.value = formattedTime;
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
