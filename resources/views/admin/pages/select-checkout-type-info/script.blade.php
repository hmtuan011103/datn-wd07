<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    const baseUrl = 'http://127.0.0.1:8000';
    const baseApiUrl = `${baseUrl}/api`;
    const baseImageUrl = `${baseUrl}/client/assets/images`;

    const vnpayDiv = document.querySelector('#vnpayDiv');
    const momoDiv = document.querySelector('#momoDiv');

    window.addEventListener('DOMContentLoaded', (event) => {
        const defaultCheckedRadio = document.querySelector('input[name="type_payment"]:checked');
        if (defaultCheckedRadio && defaultCheckedRadio.id === 'vnpay') {
            vnpayDiv.style.border = '1px solid #4B38B3';
        } else if (defaultCheckedRadio && defaultCheckedRadio.id === 'momo') {
            momoDiv.style.border = '1px solid #4B38B3';
        }
    });
    document.querySelectorAll('input[name="type_payment"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            if (this.id === 'vnpay') {
                vnpayDiv.style.border = '1px solid #4B38B3';
                momoDiv.style.border = '';
            }
            else if (this.id === 'momo') {
                momoDiv.style.border = '1px solid #4B38B3';
                vnpayDiv.style.border = '';
            }
        });
    });
</script>
</script>
<script>
    const notificationDiscount = (message) => {
        Toastify({
            text: message,
            duration: 2000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#EF5222",
                padding: "20px 10px",
                borderRadius: '5px'
            },
        }).showToast();
    }


    $('.btn-execute-code-discount').on('click',async (e) => {
        e.preventDefault();
        const discountCode = $('.discount_code_value').val();
        if(discountCode.trim() !== "") {
            const result = await $.ajax({
                url: `${baseApiUrl}/get-discount-ticket/${discountCode}`,
                type: 'GET',
                contentType: 'application/json',
            });
            const {data} = result;
            const totalBeforeFirst = parseInt($('.total_money_first').text().replace(/\./g, ''));
            if(data.length === 0) {
                notificationDiscount('Mã giảm giá không có hiệu lực');
                $('.value_discount_fill').text('0');
                $('.total_money_final').text(totalBeforeFirst.toLocaleString("vi-VN"));
            }
            if(data.length === 1){
                const informationCode = data[0];
                if(informationCode.id_type_discount_code === 1) {
                    const moneyAfterReduce = (totalBeforeFirst * informationCode.value) / 100;
                    const value = totalBeforeFirst - moneyAfterReduce;
                    $('.value_discount_fill').text(`-${informationCode.value}%`);
                    $('.total_money_final').text(value.toLocaleString("vi-VN"));
                }
                if(informationCode.id_type_discount_code === 2) {
                    const value = totalBeforeFirst - informationCode.value;
                    $('.value_discount_fill').text(`-${(informationCode.value).toLocaleString("vi-VN")}đ`);
                    $('.total_money_final').text(value.toLocaleString("vi-VN"));
                }
            }
        }
    });
    let typingTimer;
    const doneTypingInterval = 1000;
    $('.discount_code_value').on('input', function (){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(async () => {
            const totalBeforeFirst = parseInt($('.total_money_first').text().replace(/\./g, ''));
            const discountCode = $(this).val().trim();

            if(discountCode === "") {
                $('.value_discount_fill').text('0');
                $('.total_money_final').text(`${totalBeforeFirst.toLocaleString("vi-VN")}`);
                return;
            }
            try {
                const result = await $.ajax({
                    url: `${baseApiUrl}/get-discount-ticket/${discountCode}`,
                    type: 'GET',
                    contentType: 'application/json',
                });

                const { data } = result;
                if (data.length === 0) {
                    $('.value_discount_fill').text('0');
                    $('.total_money_final').text(`${totalBeforeFirst.toLocaleString("vi-VN")}`);
                }
            } catch (error) {
                console.error('Lỗi khi gọi API:', error);
            }
        }, doneTypingInterval);
    });
</script>
