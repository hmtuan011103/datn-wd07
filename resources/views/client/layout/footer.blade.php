<footer class="pt-4">
    <div class="container pt-3">
        <div class="d-flex justify-content-between">
            <div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-uppercase fw-medium fs-15 mb-0">TRUNG TÂM TỔNG ĐÀI & CSKH</p>
                        <p class="fs-30 cl-orange fw-medium">1900 6067</p>
                    </div>
                    <div>
                        <img src="{{ asset('client/assets/images/bct.png') }}" alt="" class=""
                            style="width: 160px;">
                    </div>
                </div>
                <p class="text-uppercase fs-15 fw-medium">
                    CÔNG TY CỔ PHẦN XE KHÁCH CHIEN THANG - CHIEN THANG BUS LINES
                </p>
                <p class="fs-15 fw-medium">
                    <span class="cl-gray">Địa chỉ:</span> Số 01 Tô Hiến Thành, Phường 3, Thành phố Đà Lạt, Tỉnh Lâm
                    Đồng, Việt Nam.
                </p>
                <p class="fs-15 fw-medium">
                    <span class="cl-gray">Email:</span> hotro@chienthang.vn
                </p>
                <div class="d-flex justify-content-between">
                    <div class="fs-15 fw-medium">
                        <span class="cl-gray">Điện thoại:</span> 02838386852
                    </div>
                    <div class="fs-15 fw-medium">
                        <span class="cl-gray">Fax:</span> 02838386853
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="pe-5">
                    <p class="fw-medium cl-orange">Chien Thang Lines</p>
                    <ul class="p-0 m-0">
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Về chúng tôi</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Lịch trình</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Tuyển dụng</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Tin tức & sự kiện</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Mạng lưới văn phòng</a></li>
                    </ul>
                </div>
                <div class="ps-5">
                    <p class="fw-medium cl-orange">Hỗ trợ</p>
                    <ul class="p-0 m-0">
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Tra cứu thông tin đặt vé</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Điều khoản sử dụng</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Câu hỏi thường gặp</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Hướng dẫn đặt vé trên Web</a></li>
                        <li class="li-style-none py-1"><a href=""
                                class="fw-medium text-decoration-none cl-black fs-15">Mạng lưới văn phòng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-footer-final ta-center mt-5 py-2 fw-medium cl-white fs-15">
        © 2023 | Bản quyền thuộc về Công ty Cổ Phần Xe khách Chiến Thắng - Chien Thang Bus Lines 2023
    </div>
</footer>
<!--jquery-->
<script src={{ asset('admin/assets/libs/jquery/jquery-3.6.0.min.js') }}></script>
{{-- slickjs --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $('#popular-trip-container').slick({
        infinite: true,
        accessibility: false,
        arrows: false,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    // format time 02:30:04 => 2 giờ 30 phút or 02:30 sáng
    function formatTimeVN(timeString, byDayNight = false) {
        const [hours, minutes, seconds] = timeString.split(':');

        if (!byDayNight) {
            const formattedHours = parseInt(hours, 10) > 0 ? `${parseInt(hours, 10)} tiếng ` : '';
            const formattedMinutes = parseInt(minutes, 10) > 0 ? `${parseInt(minutes, 10)} phút` : '';
            return formattedHours + formattedMinutes;
        }

        let period = 'sáng'; // Default to morning

        // Check if the hour is in the afternoon/evening
        if (parseInt(hours, 10) >= 12) {
            period = 'chiều';
        }

        // Convert 24-hour format to 12-hour format for display with leading zeros
        const formattedHours = ('0' + (parseInt(hours, 10) > 12 ? parseInt(hours, 10) - 12 : parseInt(hours, 10)))
            .slice(-2);
        const formattedMinutes = ('0' + parseInt(minutes, 10)).slice(-2);

        return `${formattedHours}:${formattedMinutes} ${period}`;
    }

    function fetchPopularTripData() {
        $.ajax({
            url: '/api/trip/popular',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    let htmlTemplates = '';
                    let trip_price = '';
                    let interval_trip = '';
                    let start_time = '';

                    response.forEach(element => {
                        trip_price = new Intl.NumberFormat().format(element.trip_price).replace(/,/g, '.');
                        interval_trip = formatTimeVN(element.interval_trip);
                        start_time = formatTimeVN(element.start_time, true);

                        // Append the HTML templates to the slick container
                        $('#popular-trip-container').slick('slickAdd', `
                            <div class="col col-md-4">
                                <div class="card w-100">
                                    <div class="position-relative z-1">
                                        <img src="storage/${element.start_location_image}" class="card-img-top img-fluid img-responsive"
                                            alt="${element.start_location}" style="height: 170px;width:100%;object-fit: cover;object-position: center;">
                                        <div class="position-absolute z-2 route-popular-title">
                                            <span class="cl-white fw-medium fs-15">Tuyến xe từ</span>
                                            <br>
                                            <span class="cl-white fw-bold fs-20 text-capitalize">${element.start_location}</span>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush border-top">
                                        <li class="list-group-item pt-3">
                                            <a>
                                                <div class="text-decoration-none cl-black d-flex justify-content-between">
                                                    <p class="ta-left mb-1 fs-18 fw-medium text-capitalize">Tới: ${element.end_location}</p>
                                                    <p class="ta-right mb-1 fs-18 fw-bold">${trip_price} VNĐ</p>
                                                </div>
                                                <p class="fs-15 cl-gray mb-0 fw-medium">Quãng đường: ${interval_trip}</p>
                                                <p class="fs-15 cl-gray mb-0 fw-medium">Giờ xe chạy: ${start_time}</p>
                                                <p class="fs-15 pb-2 cl-gray mb-0 fw-medium">${element.total_seat_sold} người từng trải nghiệm</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        `);
                    });

                } else {
                    $('#popular-trip-container').html(
                        '<h4 class="alert alert-warning shadow shadow text-center" role="alert">Không có dữ liệu~</h4>'
                    );
                }
            },
            error: function(error) {
                // Handle AJAX error
                $('#popular-trip-container').html(
                    '<h4 class="alert alert-warning shadow shadow text-center" role="alert">Không có dữ liệu~</h4>'
                );
            }
        });
    }

    fetchPopularTripData();
</script>

@yield('script')
