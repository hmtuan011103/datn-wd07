<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('http://127.0.0.1:8000/api/discounts', {
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
                    const discounts = data.data.discounts;
                    const totalSeats = parseInt(data.data.total_seats);

                    // Kiểm tra nếu có các mã giảm giá và là một đối tượng
                    if (typeof discounts === 'object' && discounts !== null) {
                        const discountContainer = document.querySelector('.discount-container');

                        // Duyệt qua từng mã giảm giá
                        Object.values(discounts).forEach(discount => {
                            const discountItem = document.createElement('div');
                            discountItem.classList.add('discount-item');

                            displayField(discountItem, "Mã Giảm Giá", discount.code);
                            displayField(discountItem, "Tên Giảm Giá", discount.name);
                            displayField(discountItem, "Thời Gian Kết Thúc", discount.end_time);
                            displayField(discountItem, "Giá Trị Giảm Giá", discount.value + '%');

                            // Kiểm tra số ghế và id của mã giảm giá
                            if (totalSeats >= 1 && totalSeats < 6 && discount.name === 'Khách Hàng Vip 1') {
                                discountContainer.appendChild(discountItem);
                            } else if (totalSeats >= 6 && totalSeats < 11 && (discount.name === 'Khách Hàng Vip 1' || discount.name === 'Khách Hàng Vip 2')) {
                                discountContainer.appendChild(discountItem);
                            } else if (totalSeats >= 11 && totalSeats < 16 && (discount.name === 'Khách Hàng Vip 1' || discount.name === 'Khách Hàng Vip 2' || discount.name === 'Khách Hàng Vip 3')) {
                                discountContainer.appendChild(discountItem);
                            }else if (totalSeats >= 16 && totalSeats < 20 && (discount.name === 'Khách Hàng Vip 1' || discount.name === 'Khách Hàng Vip 2' || discount.name === 'Khách Hàng Vip 3' || discount.name === 'Khách Hàng Vip 4')) {
                                discountContainer.appendChild(discountItem);
                            }
                        });
                    } else {
                        console.error("Dữ liệu không hợp lệ: discounts không phải là một đối tượng");
                    }
                } else {
                    console.error("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy hồ sơ: " + error);
            });
    });

    // Hàm hiển thị trường cụ thể
    function displayField(parentElement, label, value) {
        const labelElement = document.createElement('div');
        labelElement.classList.add('discount-label');
        labelElement.textContent = label + ':';

        const valueElement = document.createElement('div');
        valueElement.classList.add('discount-value');
        valueElement.textContent = value;

        parentElement.appendChild(labelElement);
        parentElement.appendChild(valueElement);
    }
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
