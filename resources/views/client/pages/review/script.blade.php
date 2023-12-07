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

<script>
//    function review(event) {
//     var stars = document.querySelector('.rating input[type="radio"]:checked').value;
//     console.log(stars)
//     if (stars === '') {
//             Toastify({
//                 text: `Vui lòng chọn điểm đi`,
//                 duration: 2000,
//                 newWindow: true,
//                 close: true,
//                 gravity: "top",
//                 position: "right",
//                 stopOnFocus: true,
//                 style: {
//                     background: "#EF5222",
//                     padding: "20px 10px",
//                     borderRadius: '5px'
//                 },
//             }).showToast();
//             // error_start_location.textContent = "Vui lòng chọn điểm đi";
//             return;
//         } 
//    }

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>