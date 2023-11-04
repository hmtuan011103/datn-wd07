$('.logo-qr-turn').each(function(index, item) {
    const dataCode = item.getAttribute('data-code');
    new QRCode(item, {
        text: dataCode,
        width: 150,
        height: 150,
    });
    item.querySelector('canvas').style.display = 'block';
});

if($('.logo-qr-return')) {
    $('.logo-qr-return').each(function(index, item) {
        const dataCode = item.getAttribute('data-code');
        new QRCode(item, {
            text: dataCode,
            width: 150,
            height: 150,
        });
    });
    item.querySelector('canvas').style.display = 'block';
}


