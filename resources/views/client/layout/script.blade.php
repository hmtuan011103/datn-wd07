<script>
    // Lấy đường dẫn của trang hiện tại
var currentURL = window.location.href;
console.log(currentURL);

// Lấy tất cả các thẻ <a> trong menu
var menuItems = document.querySelectorAll('.nav a');

// Lặp qua từng thẻ <a> và kiểm tra nếu href của nó trùng với đường dẫn hiện tại
for (var i = 0; i < menuItems.length; i++) {
  if (menuItems[i].href === currentURL) {
    // Thêm class "active" cho thẻ <a> tương ứng
    menuItems[i].classList.add('actives');
    break; // Thoát khỏi vòng lặp nếu đã tìm thấy trang hiện tại
  }
}

// $(document).ready(function () {
//             $(".btn_menu_mobile").click(function () {
//                 $(".btn_menu_mobile").toggleClass("active");
//                 $(".menu_move").toggleClass("active");
//                 // $("body").toggleClass("active");
//             });
//         });
$(document).ready(function() {
      $(".btn_menu_mobile").click(function() {
        $(".menu_move").toggleClass("active");
        $("body").toggleClass("active");
      });

      $(document).click(function(event) {
        if (!$(event.target).closest('.btn_menu_mobile').length && !$(event.target).closest('.header_mobile').length) {
          $(".menu_move").removeClass("active");
          $("body").removeClass("active");

        }
      });
    });
</script>
