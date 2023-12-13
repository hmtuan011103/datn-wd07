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

                    // Kiểm tra nếu có các mã giảm giá và là một đối tượng
                    if (typeof discounts === 'object' && discounts !== null) {
                        const discountContainer = document.querySelector('.discount-container');
                        let anyDiscountDisplayed = false;

                        // Duyệt qua từng mã giảm giá
                        Object.values(discounts).forEach(discount => {
                            const discountItem = document.createElement('div');
                            discountItem.classList.add('discount-item');

                            displayField(discountItem, "Mã Giảm Giá", discount.code);
                            displayField(discountItem, "Tên Giảm Giá", discount.name);
                            displayField(discountItem, "Thời Gian Kết Thúc", discount.end_time);
                            displayField(discountItem, "Giá Trị Giảm Giá", discount.value + '%');

                            // Kiểm tra số ghế và id của mã giảm giá

                            // Append each discountItem to discountContainer
                            discountContainer.appendChild(discountItem);
                            anyDiscountDisplayed = true;
                        });

                        if (!anyDiscountDisplayed) {
                            const noDiscountMessage = document.createElement('div');
                            noDiscountMessage.textContent = 'Kho Mã Giảm Giá Trống';
                            noDiscountMessage.classList.add('no-discount-message'); // Thêm lớp cho CSS

                            discountContainer.appendChild(noDiscountMessage);
                        }
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
    document.addEventListener("DOMContentLoaded", function () {
        var currentPath = window.location.pathname.split('/').pop();
        if (currentPath === 'ma-giam-gia') {
            document.getElementById("discount_menu").classList.add("highlighted-text");
        }
    });
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
