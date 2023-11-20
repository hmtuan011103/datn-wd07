<!-- Page level plugins -->
<script src="{{ asset('client/assets/js/url-config.js') }}"></script>
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

{!! JsValidator::formRequest('App\Http\Requests\TypeCar\StoreTypeCarRequest') !!}

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
            var result = confirm('Bạn có chắc chắn muốn xóa những loại xe này');
            if (result) {
                var promises = [];

                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/typecar/destroy_all/" + selectedRows[a],
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
                        title: "Xóa loại xe thành công!",
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
                title: "Vui lòng chọn ít nhất 1 loại xe",
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
                    url: baseUrl + "/manage/typecar/destroy/" +
                        itemId,
                    method: "GET"
                });
                if (rowdelete) {
                    rowdelete.remove();
                }
                location.reload();
                // Swal.fire({
                //     position: "center",
                //     icon: "success",
                //     title: "Xóa Loại Xe thành công!",
                //     showConfirmButton: !1,
                //     timer: 2e3,
                //     showCloseButton: !0,
                // })

            }

        });
    }
</script>
