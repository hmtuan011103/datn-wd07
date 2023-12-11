<script>
    // Lấy đường dẫn của trang hiện tại
var currentURL = window.location.href;

// Lấy tất cả các thẻ <a> trong menu
var menuItems = document.querySelectorAll('.nav a');

// Lặp qua từng thẻ <a> và kiểm tra nếu href của nó trùng với đường dẫn hiện tại
for (var i = 0; i < menuItems.length; i++) {
  if (menuItems[i].href === currentURL) {
    // Thêm class "active" cho thẻ <a> tương ứng
    menuItems[i].classList.add('active');
    break; // Thoát khỏi vòng lặp nếu đã tìm thấy trang hiện tại
  }
}
</script>


