<!-- listjs init -->
<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/typeuser/listjs.js') }}"></script>

<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\TypeUser\StoreTypeUserRequest') !!}

<script src={{ asset('admin/assets/js/pages/typeuser/main.js') }}></script>
