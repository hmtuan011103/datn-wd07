<script src={{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}></script>
<script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script>
<script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
{{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script> --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\Trip\StoreTripRequest') !!} --}}
<script>
    $(document).on('click', '.btn-show', function() {
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                $('label#code_order').text(response.data[0].code_bill)
                $('label#time').text(formatDateTime(response.data[0].created_at))
                $('label#user').text(response.data[0].user.name)
                $('label#type_pay').text(response.data[0].type_pay == 1 ? 'VNPAY' : '')
                $('label#status_pay').text(response.data[0].status_pay == 1 ? 'Đã thanh toán' : 'Chưa thanh toán')
                $('label#number_ticket').text(response.data[0].total_seats)
                var seat = response.data[0].seat_id.slice(1, -1).split(',');
                let seats = seat.map((item) => item.replace(/"/g, ''))
                var details_bill = '';
                var stt = 0;
                seats.forEach(seat => {
                    stt++;
                    details_bill += `
                    <tr>
                        <td>${stt}</td>
                        <td>${response.data[0].trip.route.name}</td>
                        <td>${seat}</td>
                        <td>${formatCurrency(response.data[0].trip.trip_price)}</td>
                        <td>1</td>
                        <td>${formatCurrency(response.data[0].trip.trip_price)}</td>
                    </tr>
                    `
                });
                var total = `<tr>
                                    <td colspan="5" class="fs-5 fw-bolder">Tổng tiền: </td>
                                    <td id="total">${formatCurrency(response.data[0].total_money)}</td>
                                </tr>`
                $('tbody#details_bill').html(details_bill)
                $('tbody#details_bill').append(total)
            }
        })
    });

    function formatDateTime(dateTimeString) {
        const dateTime = new Date(dateTimeString);
        const formattedDateTime = dateTime.toLocaleString('vi-VN', {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        });
        return formattedDateTime;
    }
    function formatCurrency(amount) {
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0,
        });

        var formattedCurrency = formatter.format(amount);
        return formattedCurrency;
    }
</script>
