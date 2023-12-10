<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<!-- listjs init -->
<script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script> --}}

<script src="{{ asset('client/assets/js/url-config.js') }}"></script>
<script>
    function deleteMultiples() {
        var checkboxes = document.getElementsByName('rowCheckbox');
        var selectedRows = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedRows.push(checkboxes[i].value);
            }
        }
        var result = '';
        if (selectedRows.length > 0) {
            var result = confirm('Bạn có chắc chắn muốn xóa những tuyến đường này')
            if (result) {
                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/route/delete/" +
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
                        title: "Xóa tuyến đường thành công!",
                        showConfirmButton: !1,
                        timer: 2e3,
                        showCloseButton: !0,
                    })
                }
            } else {

            }

        } else {
            Swal.fire({
                title: "Vui lòng chọn ít nhất 1 vai trò",
                confirmButtonClass: "btn btn-danger",
                confirmButtonColor: '#d33',
            });
        }
    }
</script>
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
                    url: baseUrl + "/manage/route/delete/" +
                        itemId,
                    method: "GET"
                });
                if (rowdelete) {
                    rowdelete.remove();
                }
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Xóa tuyến đường thành công!",
                    showConfirmButton: !1,
                    timer: 2e3,
                    showCloseButton: !0,
                })

            }

        });
    }
</script>
<script>
    function showDetails(roleId) {
        // console.log('ok')
        // var roleId = $(this).data("role-id");
        // console.log(roleId);

        $.ajax({
            url: "http://127.0.0.1:8000/manage/route/details/" +
                roleId,
            method: "GET",
            success: function(response) {
                const name_detail = document.getElementById('name_detail');
                const start_location_detail = document.getElementById('start_location_detail');
                const end_location_detail = document.getElementById('end_location_detail');
                const start_time_detail = document.getElementById('start_time_detail');
                const price_detail = document.getElementById('price_detail');
                const interval_detail = document.getElementById('interval_detail');
                const driver_detail = document.getElementById('driver_detail');
                const assistant_detail = document.getElementById('assistant_detail');
                const car_detail = document.getElementById('car_detail');
                const status_detail = document.getElementById('status_detail');
                const drivers = JSON.parse(response[0].driver_id);
                const assistants = JSON.parse(response[0].assistantCar_id);
                const cars = JSON.parse(response[0].car_id);

                const driver_name = [];
                for (let i = 0; i < drivers.length; i++) {
                    const dr = response[1].find(item => item.id == drivers[i]);
                    if (dr) {
                        driver_name.push(dr.name);
                    }
                }

                const assistant_name = [];
                for (let i = 0; i < assistants.length; i++) {
                    const dr = response[2].find(item => item.id == assistants[i]);
                    if (dr) {
                        assistant_name.push(dr.name);
                    }
                }

                const car_name = [];
                for (let i = 0; i < cars.length; i++) {
                    const dr = response[3].find(item => item.id == cars[i]);
                    if (dr) {
                        car_name.push(dr.name);
                    }
                }
                

                name_detail.innerHTML = response[0].name;
                start_location_detail.innerHTML = response[0].start_location;
                end_location_detail.innerHTML = response[0].end_location;
                start_time_detail.innerHTML = response[0].start_time;
                price_detail.innerHTML = formatCurrency(response[0].trip_price);
                interval_detail.innerHTML = response[0].interval_trip;
                driver_detail.innerHTML = driver_name;
                assistant_detail.innerHTML = assistant_name;
                car_detail.innerHTML = car_name;
                status_detail.innerHTML = response[0].status;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
<script src="{{ asset('admin/assets/js/pages/hummingbird-treeview.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/hummingbird-treeview.min.js') }}"></script>
<script>
    try {
        fetch(
                new Request(
                    "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
                        method: "HEAD",
                        mode: "no-cors"
                    }
                )
            )
            .then(function(response) {
                return true;
            })
            .catch(function(e) {
                var carbonScript = document.createElement("script");
                carbonScript.src =
                    "//cdn.carbonads.com/carbon.js?serve=CE7DC2JW&placement=wwwcssscriptcom";
                carbonScript.id = "_carbonads_js";
                document.getElementById("carbon-block").appendChild(carbonScript);
            });
    } catch (error) {
        console.log(error);
    }
</script>
{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}


<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>
<script>
    $('#carSelect').selectpicker();
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

    function formatCurrency(amount) {
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0,
        });

        var formattedCurrency = formatter.format(amount);
        return formattedCurrency;
    }
</script>
{{-- <!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> --}}

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{!! JsValidator::formRequest('App\Http\Requests\Route\StoreRouteRequest') !!}
{!! JsValidator::formRequest('App\Http\Requests\Route\UpdateRouteRequest') !!}
