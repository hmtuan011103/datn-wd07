const vnpayDiv = document.querySelector('#vnpayDiv');
const momoDiv = document.querySelector('#momoDiv');

document.querySelectorAll('input[name="type_payment"]').forEach((radio) => {
    radio.addEventListener('change', function() {
        if (this.id === 'vnpay') {
            vnpayDiv.style.border = '1px solid #EF5222';
            momoDiv.style.border = '';
            localStorage.setItem('selectedPayment', 'vnpay');
        } else if (this.id === 'momo') {
            momoDiv.style.border = '1px solid #EF5222';
            vnpayDiv.style.border = '';
            localStorage.setItem('selectedPayment', 'momo');
        }
    });
});

window.addEventListener('DOMContentLoaded', (event) => {
    const selectedPayment = localStorage.getItem('selectedPayment');
    if(selectedPayment) {
        const defaultCheckedRadio = document.querySelector(`#${selectedPayment}`);
        defaultCheckedRadio.checked = true;
        if (selectedPayment === 'vnpay') {
            vnpayDiv.style.border = '1px solid #EF5222';
        } else if (selectedPayment === 'momo') {
            momoDiv.style.border = '1px solid #EF5222';
        }
    } else {
        const defaultCheckedRadio = document.querySelector('#vnpay');
        defaultCheckedRadio.checked = true;
        vnpayDiv.style.border = '1px solid #EF5222';
    }
});

$('#checkout_for_by_step').on('submit', function (event) {
    $("#overlay").fadeIn(300);
    window.onload = function() {
        $("#overlay").fadeOut(300);
    };
});

