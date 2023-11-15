<!-- Page level plugins -->

<script src="{{ asset("admin/assets/libs/gridjs/js/prism.js") }}"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/list.min.js") }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset("admin/assets/libs/gridjs/js/list.pagination.min.js") }}"></script>

<!-- listjs init -->
<script src="assets/js/pages/listjs.init.js"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/listjs.init.js") }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\Car\StoreCarRequest') !!}
{!! JsValidator::formRequest('App\Http\Requests\Car\UpdateCarRequest' ) !!}
<script>
    function deleteMultiples() {
        var checkboxes = document.getElementsByName('rowCheckbox');
        var selectedRows = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedRows.push(checkboxes[i].value);
            }
        }

        if (selectedRows.length > 0) {
            var result = confirm('Bạn có chắc chắn muốn xóa những xe này');
            if (result) {
                var promises = [];

                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/car/destroy_all/" + selectedRows[a],
                        method: "GET"
                    });

                    var row = document.getElementById('row' + selectedRows[a]);

                    if (row) {
                        promises.push(
                            new Promise(function(resolve) {
                                ajaxRequest.done(function() {
                                    row.style.display = 'none';
                                    resolve();
                                });
                            })
                        );
                    }
                }

                Promise.all(promises).then(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Xóa xe thành công!",
                        showConfirmButton: false,
                        timer: 2000,
                        showCloseButton: true,
                    });

                    // Load lại trang ở đây
                    location.reload();
                });
            }
        } else {
            Swal.fire({
                title: "Vui lòng chọn ít nhất 1 xe",
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
                var roleId = this.dataset.roleId;
                var roleIdElement = document.getElementById('role-id');
                roleIdElement.textContent = roleId;
            });
        });
        document.getElementById('delete-record').addEventListener('click', function() {
            var roleId = document.getElementById('role-id').textContent;
            var ajaxRequest = $.ajax({
                url: "http://127.0.0.1:8000/manage/car/destroy/" + roleId,
                method: "GET"
            });
            var modalElement = document.getElementById('modalDelete');
            modalElement.style.display = 'none';
            location.href = location.href;

            ajaxRequest.done(function(response) {
                var row = document.getElementById('row' + roleId);
                if (row) {
                    row.style.display = 'none';
                }
            });

        });
    });
</script>


