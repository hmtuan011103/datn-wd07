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
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        arrows: true,
        nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="cursor-pointer bi bi-chevron-right slick-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
        prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="cursor-pointer bi bi-chevron-left slick-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
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
                    arrows: false,
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 550,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#recent-news-container').slick({
        infinite: true,
        accessibility: false,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        arrows: true,
        nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="cursor-pointer bi bi-chevron-right slick-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
        prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="cursor-pointer bi bi-chevron-left slick-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
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
                    arrows: false,
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 550,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // format time 02:30:04 => 2 giờ 30 phút or 02:30 sáng
    function formatTimeVN(timeString, byDayNight = false, byDMY = false) {
        const [hours, minutes, seconds] = timeString.split(':');

        if (byDMY) {
            // Create a Date object from the original timestamp
            const date = new Date(timeString);

            // Format the date as per the desired format (DD/MM/YYYY)
            const day = date.getDate().toString().padStart(2, '0'); // Get day and pad with '0' if needed
            const month = (date.getMonth() + 1).toString().padStart(2,
                '0'); // Note: January is 0 in JavaScript Date object
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

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
                        trip_price = new Intl.NumberFormat().format(element.trip_price).replace(
                            /,/g, '.');
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

    function fetchRecentNewsData() {
        $.ajax({
            url: '/api/news/recent',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    let htmlTemplates = '';
                    let formatCreatedAtTime = '';

                    response.forEach(element => {
                        formatCreatedAtTime = formatTimeVN(element.created_at, false, true);

                        // Append the HTML templates to the slick container
                        $('#recent-news-container').slick('slickAdd', `
                            <div class="col col-md-4">
                                <a href="#" class="d-block border border-1 rounded-3">
                                    <img src="storage/${element.image}" alt="blog-image"
                                        class="w-100 d-block border border-1 rounded-3">
                                </a>
                                <a class="text-uppercase fw-bold pt-2 pb-3 d-block text-decoration-none cl-black show-three-dot-text" href="#">
                                    ${element.title}
                                </a>
                                <div class="d-flex justify-content-between">
                                    <p class="cl-gray fw-medium fs-14">
                                        ${formatCreatedAtTime}
                                    </p>
                                    <a href="#" class="d-block text-decoration-none cl-orange fs-14 fw-medium">
                                        Chi tiết
                                    </a>
                                </div>
                            </div>
                        `);
                    });

                } else {
                    $('#recent-news-container').html(
                        '<h4 class="alert alert-warning shadow shadow text-center" role="alert">Không có dữ liệu~</h4>'
                    );
                }
            },
            error: function(error) {
                // Handle AJAX error
                $('#recent-news-container').html(
                    '<h4 class="alert alert-warning shadow shadow text-center" role="alert">Không có dữ liệu~</h4>'
                );
            }
        });
    }

    fetchPopularTripData();
    fetchRecentNewsData();
</script>

@yield('script')
