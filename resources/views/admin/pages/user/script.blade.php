<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\User\StoreUserRequest', '#form-create-user') !!}
{!! JsValidator::formRequest('App\Http\Requests\User\UpdateUserRequest', '#form-edit-user') !!}

<!-- listjs init -->
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/src/user/listjs.js') }}"></script>

<script src={{ asset('admin/assets/js/pages/src/main.js') }}></script>

<!-- multi.js -->
<script src={{ asset('admin/assets/libs/multi.js/multi.min.js') }}></script>
<script src={{ asset('admin/assets/js/pages/src/user/multijs.js') }}></script>
