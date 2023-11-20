<script src="{{ asset("admin/assets/libs/gridjs/js/prism.js") }}"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/list.min.js") }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset("admin/assets/libs/gridjs/js/list.pagination.min.js") }}"></script>

<!-- listjs init -->
<script src="assets/js/pages/listjs.init.js"></script>
<script src="{{ asset("admin/assets/libs/gridjs/js/listjs.init.js") }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Javascript Requirements -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('http://127.0.0.1:8000/api/getBills', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + getCookie('token'),
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === true) {
                    // Lấy tbody của bảng để chèn dữ liệu
                    let tableBody = document.getElementById('customerTableBody');

                    // Xóa bất kỳ dữ liệu cũ nào trong tbody
                    tableBody.innerHTML = '';

                    // Duyệt qua mỗi hóa đơn và thêm vào tbody
                    data.data.forEach(bill => {
                        let row = tableBody.insertRow();

                        // Cập nhật các ô trong hàng với dữ liệu từ API
                        let cell1 = row.insertCell(0);
                        let startLocation = bill.trip.start_location;
                        let endLocation = bill.trip.end_location;
                        cell1.textContent = `${startLocation} đến ${endLocation}`;

                        let cell2 = row.insertCell(1);
                        cell2.textContent = bill.total_seats;
                        let cell3 = row.insertCell(2);
                        let startDate = new Date(bill.trip.start_date);
                        let formattedStartDate = startDate.getDate() + '/' + (startDate.getMonth() + 1) + '/' + startDate.getFullYear();
                        cell3.textContent = formattedStartDate;

                        let cell4 = row.insertCell(3);

                        let totalMoney = parseFloat(bill.total_money_after_discount);
                        let formattedTotalMoney = totalMoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                        cell4.textContent = formattedTotalMoney + " Đ";


                    });
                } else {
                    console.error("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy hồ sơ: " + error);
            });
    });
</script>
<script>
    function profile() {
        window.location.href = 'thong-tin';
    }
    document.getElementById("profile_menu").addEventListener("click", function () {
        profile();
    });
    function discount() {
        window.location.href = 'ma-giam-gia';
    }
    document.getElementById("discount_menu").addEventListener("click", function () {
        discount();
    });
    function booking_history() {
        window.location.href = 'lich-su';
    }
    document.getElementById("booking_history_menu").addEventListener("click", function () {
        booking_history();
    });
    function passWord() {
        window.location.href = 'mat-khau';
    }
    document.getElementById("password_menu").addEventListener("click", function () {
        passWord();
    });
</script>
