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
                var queryString = '';
                for (var i = 0; i < permissionIds.length; i++) {
                    queryString += 'permissionIds[]=' + encodeURIComponent(permissionIds[i]);
                    if (i < permissionIds.length - 1) {
                        queryString += '&';
                    }
                }
                var ajaxRequest = $.ajax({
                    url: "http://127.0.0.1:8000/manage/role_permission/api/get_permission?" +
                        queryString,
                    method: "GET",
                    success: function(response) {
                        var permissions = response[0];
                        console.log(response);
                        var container = document.getElementById('modal_permission');
                        var container_child = document.getElementById('modal_permission_child');

                        // Tạo cây danh sách bằng đệ quy
                        var ul = buildNestedList(permissions, 0);
                        var ul_child = buildNestedList_Child(permissions);
                        container.innerHTML = '';
                        container.appendChild(ul);
                        container_child.innerHTML = '';
                        container_child.appendChild(ul_child);
                    }
                });

                function buildNestedList_Child(permissions) {
                    var ul = document.createElement('ul');
                    ul.style.listStyleType = 'circle';
                    permissions.forEach(function(permission) {
                        if (permission.parent_id && !permissions.some(function(p) {
                                return p.id === permission.parent_id;
                            })) {
                            var li = document.createElement('li');
                            li.textContent = permission.description;
                            ul.appendChild(li);
                        }
                    });
                    return ul;
                }

                function buildNestedList(permissions, parentId) {
                    var ul = document.createElement('ul');
                    permissions.forEach(function(permission) {
                        if (permission.parent_id === parentId) {
                            var li = document.createElement('li');
                            li.textContent = permission.description;
                            li.style.fontSize = '16px';
                            ul.appendChild(li);

                            // Đệ quy để tạo danh sách con
                            var nestedUl = buildNestedList(permissions, permission.id);
                            if (nestedUl.children.length > 0) {
                                li.appendChild(nestedUl);
                            }
                        }
                    });

                    return ul;
                }

                $("#modal_title").text(response[0].name);
                $("#modal_role").text(response[0].name);

                $("#roleModal").css("display", "block");
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
