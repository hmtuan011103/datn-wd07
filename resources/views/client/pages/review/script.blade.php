 <!-- Javascript Requirements -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

 {!! JsValidator::formRequest('App\Http\Requests\Review\StoreReviewRequest') !!}
 <script>
     $("#phone").on("input", function() {
         $(this).val($(this).val().replace(/[^0-9]/g, ""));
     });
 </script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
