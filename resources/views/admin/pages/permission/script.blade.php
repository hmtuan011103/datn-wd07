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
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    @yield('validateRequest')

    <!-- Data Table  -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('client/assets/js/url-config.js') }}"></script>
    <script>
        new DataTable('#flight-route');
    </script>
{{--
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
                var result = confirm('Bạn có chắc chắn muốn xóa những quyền này')
                if (result) {
                    for (let a = 0; a < selectedRows.length; a++) {
                        var ajaxRequest = $.ajax({
                            url: "http://127.0.0.1:8000/manage/permission/delete/" +
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
                            title: "Xóa quyền thành công!",
                            showConfirmButton: !1,
                            timer: 2e3,
                            showCloseButton: !0,
                        })
                    }
                } else {

                }

            } else {
                Swal.fire({
                    title: "Vui lòng chọn ít nhất 1 quyền",
                    confirmButtonClass: "btn btn-danger",
                    confirmButtonColor: '#d33',
                });
            }
        }
    </script> --}}





    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.getElementsByClassName('btn-remove');
            console.log(deleteButtons);
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
                    url: "http://127.0.0.1:8000/manage/permission/delete/" +
                        roleId,
                    method: "GET"
                });
                var modalElement = document.getElementById('modalDelete');
                var modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
                var row = document.getElementById('row' + roleId);
                if (row) {
                    row.style.display = 'none';
                }
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Xóa vai trò thành công!",
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
                        url: baseUrl + "/manage/permission/delete/" +
                            itemId,
                        method: "GET"
                    });
                    if (rowdelete) {
                        rowdelete.remove();
                        location.reload();
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


