<!-- Page level plugins -->

<script src="{{ asset("admin/assets/libs/gridjs/js/prism.js") }}"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/list.min.js") }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset("admin/assets/libs/gridjs/js/list.pagination.min.js") }}"></script>

<!-- listjs init -->
<script src="assets/js/pages/listjs.init.js"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/listjs.init.js") }}"></script>

<!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\Car\StoreCarRequest') !!}
{!! JsValidator::formRequest('App\Http\Requests\Car\UpdateCarRequest' ) !!}


