const vnpayDiv = document.querySelector('#vnpayDiv');
const momoDiv = document.querySelector('#momoDiv');

window.addEventListener('DOMContentLoaded', (event) => {
    const defaultCheckedRadio = document.querySelector('input[name="type_payment"]:checked');
    if (defaultCheckedRadio && defaultCheckedRadio.id === 'vnpay') {
        vnpayDiv.style.border = '1px solid #EF5222';
    } else if (defaultCheckedRadio && defaultCheckedRadio.id === 'momo') {
        momoDiv.style.border = '1px solid #EF5222';
    }
});
document.querySelectorAll('input[name="type_payment"]').forEach((radio) => {
    radio.addEventListener('change', function() {
        if (this.id === 'vnpay') {
            vnpayDiv.style.border = '1px solid #EF5222';
            momoDiv.style.border = '';
        }
        else if (this.id === 'momo') {
            momoDiv.style.border = '1px solid #EF5222';
            vnpayDiv.style.border = '';
        }
    });
});

