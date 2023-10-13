<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\User\StoreUserRequest', '#form-create-user') !!}
{!! JsValidator::formRequest('App\Http\Requests\User\UpdateUserRequest', '#form-edit-user') !!}

<script src={{ asset('admin/assets/js/pages/typeuser/main.js') }}></script>

<!-- multi.js -->
<script src={{ asset('admin/assets/libs/multi.js/multi.min.js') }}></script>
<script src={{ asset('admin/assets/js/pages/typeuser/user.js') }}></script>
