<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    const baseUrl = 'http://127.0.0.1:8000';
    const baseApiUrl = `${baseUrl}/api`;
    const baseImageUrl = `${baseUrl}/client/assets/images`;

    const vnpayDiv = document.querySelector('#vnpayDiv');
    const momoDiv = document.querySelector('#momoDiv');
    const directDiv = document.querySelector('#directDiv');

    window.addEventListener('DOMContentLoaded', (event) => {
        const defaultCheckedRadio = document.querySelector('input[name="type_payment"]:checked');
        if (defaultCheckedRadio && defaultCheckedRadio.id === 'vnpay') {
            vnpayDiv.style.border = '1px solid #4B38B3';
        } else if (defaultCheckedRadio && defaultCheckedRadio.id === 'momo') {
            momoDiv.style.border = '1px solid #4B38B3';
        } else if (defaultCheckedRadio && defaultCheckedRadio.id === 'direct') {
            directDiv.style.border = '1px solid #4B38B3';
        }
    });
    document.querySelectorAll('input[name="type_payment"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            if (this.id === 'vnpay') {
                vnpayDiv.style.border = '1px solid #4B38B3';
                momoDiv.style.border = '';
                directDiv.style.border = '';
            }
            else if (this.id === 'momo') {
                momoDiv.style.border = '1px solid #4B38B3';
                vnpayDiv.style.border = '';
                directDiv.style.border = '';
            }
            else if (this.id === 'direct') {
                directDiv.style.border = '1px solid #4B38B3';
                momoDiv.style.border = '';
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
            close: false,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#EF5222",
                padding: "20px",
                borderRadius: '5px'
            },
        }).showToast();
    }

    $('.btn-execute-code-discount').on('click', async (e) => {
        e.preventDefault();
        $("#overlay").fadeIn(300);
        const discountCode = $('.discount_code_value').val();
        if (discountCode.trim() !== "") {
            try {
                const result = await $.ajax({
                    url: `${baseApiUrl}/get-discount-ticket/${discountCode}`,
                    type: 'GET',
                    contentType: 'application/json',
                });
                const { data } = result;
                const totalBeforeFirst = parseInt($('.total_money_first').text().replace(/\./g, ''));
                if (data.length === 0) {
                    notificationDiscount('Mã giảm giá không có hiệu lực');
                    $('.value_discount_fill').text('0');
                    $('.total_money_final').text(totalBeforeFirst.toLocaleString("vi-VN"));
                }
                if (data.length === 1) {
                    const informationCode = data[0];
                    if (informationCode.id_type_discount_code === 1) {
                        const moneyAfterReduce = (totalBeforeFirst * informationCode.value) / 100;
                        const value = totalBeforeFirst - moneyAfterReduce;
                        const moneyTurn = $('input[name="money_turn"]');
                        const moneyReturn = $('input[name="money_return"]');
                        if(moneyReturn.val() === ""){
                            moneyTurn.val(value);
                        }
                        $('.value_discount_fill').text(`-${informationCode.value}%`);
                        $('.total_money_final').text(value.toLocaleString("vi-VN"));
                        $('input[name="discount_code_id"]').val(informationCode.id);
                    }
                    if (informationCode.id_type_discount_code === 2) {
                        const value = totalBeforeFirst - informationCode.value;
                        const moneyTurn = $('input[name="money_turn"]');
                        const moneyReturn = $('input[name="money_return"]');
                        if(moneyReturn.val() === ""){
                            moneyTurn.val(value);
                        }
                        $('.value_discount_fill').text(`-${(informationCode.value).toLocaleString("vi-VN")}đ`);
                        $('.total_money_final').text(value.toLocaleString("vi-VN"));
                        $('input[name="discount_code_id"]').val(informationCode.id);
                    }
                }
            } catch (error) {
                console.error('Error fetching discount:', error);
            } finally {
                setTimeout(function () {
                    $("#overlay").fadeOut(300);
                }, 1000);
            }
        } else {
            setTimeout(function () {
                $("#overlay").fadeOut(300);
                notificationDiscount("Bạn chưa nhập mã giảm giá nào");
            }, 1000);
        }
    });

    let typingTimer;
    const doneTypingInterval = 1000;
    $('.discount_code_value').on('input', function (){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(async () => {
            $("#overlay").fadeIn(300);
            const totalBeforeFirst = parseInt($('.total_money_first').text().replace(/\./g, ''));
            const discountCode = $(this).val().trim();
            if (discountCode === "") {
                const moneyTurn = $('input[name="money_turn"]');
                const moneyReturn = $('input[name="money_return"]');
                if(moneyReturn.val() === ""){
                    moneyTurn.val(totalBeforeFirst);
                }
                $('.value_discount_fill').text('0');
                $('.total_money_final').text(`${totalBeforeFirst.toLocaleString("vi-VN")}`);
                $('input[name="discount_code_id"]').val("");
                $("#overlay").fadeOut(300);
                return;
            }

            try {
                const result = await $.ajax({
                    url: `${baseApiUrl}/get-discount-ticket/${discountCode}`,
                    type: 'GET',
                    contentType: 'application/json',
                });

                const { data } = result;
                if (data.length === 0 || data.length === 1) {
                    const moneyTurn = $('input[name="money_turn"]');
                    const moneyReturn = $('input[name="money_return"]');
                    if(moneyReturn.val() === ""){
                        moneyTurn.val(totalBeforeFirst);
                    }
                    $('.value_discount_fill').text('0');
                    $('.total_money_final').text(`${totalBeforeFirst.toLocaleString("vi-VN")}`);
                    $('input[name="discount_code_id"]').val("");
                }
            } catch (error) {
                console.error('Lỗi khi gọi API:', error);
            } finally {
                setTimeout(function () {
                    $("#overlay").fadeOut(300);
                }, 1000);
            }
        }, doneTypingInterval);
    });

</script>
