<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<!-- listjs init -->
<script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{{-- validate locationRequest --}}
@yield('validateRequest');

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
            var result = confirm('Bạn có chắc chắn muốn xóa những địa điểm này')
            if (result) {
                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/location/delete/" +
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
                        title: "Xóa địa điểm thành công!",
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
                url: "http://127.0.0.1:8000/manage/location/delete/" +
                    roleId,
                method: "GET"
            });
            var modalElement = document.getElementById('modalDelete');
            var modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
            location.href = location.href;

            var row = document.getElementById('row' + roleId);
            if (row) {
                row.style.display = 'none';
            }
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Xóa địa điểm thành công!",
                showConfirmButton: !1,
                timer: 2e3,
                showCloseButton: !0,
            })
        });

    });
</script>
