<!--jquery cdn-->
<script src={{ asset('admin/assets/libs/jquery/jquery-3.6.0.min.js') }}></script>
<!--sweetalert-->
<script src={{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{!! JsValidator::formRequest('App\Http\Requests\TypeUser\StoreTypeUserRequest') !!}
<script src={{ asset('admin/assets/js/pages/typeuser/main.js') }}></script>
