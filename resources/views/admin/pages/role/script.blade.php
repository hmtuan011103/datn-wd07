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
            var result = confirm('Bạn có chắc chắn muốn xóa những vai trò này')
            if (result) {
                for (let a = 0; a < selectedRows.length; a++) {
                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/role/delete_role/" +
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
                        title: "Xóa vai trò thành công!",
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
                url: "http://127.0.0.1:8000/manage/role/delete_role/" +
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
                title: "Xóa vai trò thành công!",
                showConfirmButton: !1,
                timer: 2e3,
                showCloseButton: !0,
            })
        });

    });
</script>
<script>
    function showDetails(roleId) {
        // console.log('ok')
        // var roleId = $(this).data("role-id");
        // console.log(roleId);

        $.ajax({
            url: "http://127.0.0.1:8000/manage/role_permission/api/details/" +
                roleId,
            method: "GET",
            success: function(response) {

                var permissionIds = [];
                for (var i = 0; i < response[1].length; i++) {
                    permissionIds.push(response[1][i].permission_id);
                }
                // Lưu trữ các yêu cầu AJAX trong một mảng
                var ajaxRequests = [];
                var responseData = [];
                for (var i = 0; i < permissionIds.length; i++) {
                    var permissionId = permissionIds[i];

                    var ajaxRequest = $.ajax({
                        url: "http://127.0.0.1:8000/manage/role_permission/api/get_permission/" +
                            permissionId,
                        method: "GET"
                    });
                    ajaxRequests.push(ajaxRequest);

                }
                // Đợi tất cả các yêu cầu AJAX hoàn thành
                $.when.apply($, ajaxRequests).done(function() {
                    // Lấy kết quả từ các yêu cầu AJAX
                    for (var i = 0; i < arguments.length; i++) {
                        var response = arguments[i][0];
                        responseData.push(response);
                    }

                    // Sử dụng dữ liệu phản hồi ở đây
                    var permission = [];
                    if (permissionIds.length <= 1) {
                        var per = responseData[0];
                        permission.push(per)
                    } else {
                        for (var i = 0; i < responseData.length; i++) {
                            var per = responseData[i][0];
                            permission.push(per)
                        }
                    }
            
                    var ul = document.createElement('ul');
                    permission.forEach(function(permission) {
                        if (permission.parent_id == 0) {
                            var li = document.createElement(
                                'li');
                            li.textContent = permission.name;
                            ul.appendChild(li);
                        } else {
                            var li = document.createElement('li');
                            li.style.display = 'block';
                            ul.appendChild(li);
                            var nestedUl = document.createElement('ul');
                            // var nestedLi = document.createElement('li');
                            nestedUl.textContent = permission.name;
                            // nestedUl.appendChild(nestedLi);
                            ul.appendChild(nestedUl);
                        }

                    });

                    var container = document.getElementById('modal_permission');
                    while (container.firstChild) {
                        container.removeChild(container.firstChild);
                    }
                    container.appendChild(ul);
                    // console.log(permission);
                    // $("#modal_permission").text(permission);
                });
                $("#modal_title").text(response[0].name);
                $("#modal_role").text(response[0].name);


                $("#roleModal").css("display", "block");
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    $(document).ready(function() {

        // $(".btn-details").click(function() {
        //     console.log('ok')
        //     var roleId = $(this).data("role-id");
        //     $.ajax({
        //         url: "http://127.0.0.1:8000/manage/role_permission/api/details/" +
        //             roleId,
        //         method: "GET",
        //         success: function(response) {

        //             var permissionIds = [];
        //             for (var i = 0; i < response[1].length; i++) {
        //                 permissionIds.push(response[1][i].permission_id);
        //             }
        //             // Lưu trữ các yêu cầu AJAX trong một mảng
        //             var ajaxRequests = [];
        //             var responseData = [];
        //             for (var i = 0; i < permissionIds.length; i++) {
        //                 var permissionId = permissionIds[i];

        //                 var ajaxRequest = $.ajax({
        //                     url: "http://127.0.0.1:8000/manage/role_permission/api/get_permission/" +
        //                         permissionId,
        //                     method: "GET"
        //                 });
        //                 ajaxRequests.push(ajaxRequest);

        //             }
        //             // Đợi tất cả các yêu cầu AJAX hoàn thành
        //             $.when.apply($, ajaxRequests).done(function() {
        //                 // Lấy kết quả từ các yêu cầu AJAX
        //                 for (var i = 0; i < arguments.length; i++) {
        //                     var response = arguments[i][0];
        //                     responseData.push(response);
        //                 }

        //                 // Sử dụng dữ liệu phản hồi ở đây
        //                 // console.log(permissionIds.length);
        //                 var permission = [];
        //                 if (permissionIds.length <= 1) {
        //                     var per = responseData[0].name;
        //                     permission.push(per)
        //                 } else {
        //                     for (var i = 0; i < responseData.length; i++) {
        //                         var per = responseData[i][0].name;
        //                         permission.push(per)
        //                     }
        //                 }
        //                 var ul = document.createElement('ul');

        //                 permission.forEach(function(permission) {
        //                     var li = document.createElement(
        //                         'li');
        //                     li.textContent = permission;
        //                     ul.appendChild(li);
        //                 });

        //                 var container = document.getElementById('modal_permission');
        //                 while (container.firstChild) {
        //                     container.removeChild(container.firstChild);
        //                 }
        //                 container.appendChild(ul);
        //                 // console.log(permission);
        //                 // $("#modal_permission").text(permission);
        //             });
        //             $("#modal_title").text(response[0].name);
        //             $("#modal_role").text(response[0].name);


        //             $("#roleModal").css("display", "block");
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //         }
        //     });

        // });

        // $(".close").click(function() {
        //     $("#roleModal").css("display", "none");
        // });
    });
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
<script>
    $("#treeview").hummingbird();
    $("#checkAll").click(function() {
        $("#treeview").hummingbird("checkAll");
    });
    $("#uncheckAll").click(function() {
        $("#treeview").hummingbird("uncheckAll");
    });
    $("#collapseAll").click(function() {
        $("#treeview").hummingbird("collapseAll");
    });
    $("#checkNode").click(function() {
        $("#treeview").hummingbird("checkNode", {
            attr: "id",
            name: "node-0-2-2",
            expandParents: false,
        });
    });
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(["_setAccount", "UA-36251023-1"]);
    _gaq.push(["_setDomainName", "jqueryscript.net"]);
    _gaq.push(["_trackPageview"]);

    (function() {
        var ga = document.createElement("script");
        ga.type = "text/javascript";
        ga.async = true;
        ga.src =
            ("https:" == document.location.protocol ?
                "https://ssl" :
                "http://www") + ".google-analytics.com/ga.js";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
{{-- <!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{!! JsValidator::formRequest('App\Http\Requests\Role\StoreRoleRequest') !!}
{!! JsValidator::formRequest('App\Http\Requests\Role\UpdateRoleRequest') !!} --}}
