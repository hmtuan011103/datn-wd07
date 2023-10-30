<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<!-- listjs init -->
<script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            var result = confirm('Bạn có chắc chắn muốn xóa những mã giảm giá này')
            if (result) {
                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/discount_code/delete/" +
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
                        title: "Xóa vai mã giảm giá thành công!",
                        showConfirmButton: !1,
                        timer: 2e3,
                        showCloseButton: !0,
                    })
                }
            } else {

            }

        } else {
            Swal.fire({
                title: "Vui lòng chọn ít nhất 1 mã giảm giá",
                confirmButtonClass: "btn btn-danger",
                confirmButtonColor: '#d33',
            });
        }
    }
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
                url: "http://127.0.0.1:8000/manage/discount_code/delete/" +
                    roleId,
                method: "GET"
            });
            var modalElement = document.getElementById('modalDelete');
            var modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
            var row = document.getElementById('row' + roleId);
            if (row) {
                row.remove();
                // row.style.display = 'none';
            }
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Xóa mã giảm giá thành công!",
                showConfirmButton: !1,
                timer: 2e3,
                showCloseButton: !0,
            })
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('start-date');

        flatpickr(dateInput, {
            dateFormat: 'Y-m-d',
            // Các tùy chọn khác...
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('end-date');

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

<!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{!! JsValidator::formRequest('App\Http\Requests\DiscountCode\StoreDiscountCodeRequest') !!}
{!! JsValidator::formRequest('App\Http\Requests\DiscountCode\UpdateDiscountCodeRequest') !!}
