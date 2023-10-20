const getErrorWhenCallApi = (statusCode) => {
    switch (statusCode) {
        case 400:
            console.error('Lỗi yêu cầu không hợp lệ.');
            break;
        case 401:
            console.error('Lỗi chưa xác thực.');
            break;
        case 403:
            console.error('Lỗi không có quyền truy cập.');
            break;
        case 404:
            console.error('Lỗi tài nguyên không tồn tại.');
            break;
        case 500:
            console.error('Lỗi máy chủ.');
            break;
        default:
            console.error('Lỗi không xác định.');
    }
}

const dataDetailTrip = async () => {
    try {
        const result = await $.ajax({
            url: `${baseApiUrl}/information-detail-trip`,
            type: 'GET',
            contentType: 'application/json',
        });
        const { seatSelected, seats, locationRouteTrip, route } = result;
        return {
            'seatSelected': seatSelected,
            'seats': seats,
            'locationRouteTrip': locationRouteTrip,
            'route': route
        };
    } catch (error) {
        const statusCode = error.response.status;
        getErrorWhenCallApi(statusCode);
        return false;
    }
}

const handleDate = (date) => {
    const dateObj = new Date(date);
    const day = dateObj.getDate();
    const month = dateObj.getMonth() + 1;
    const formattedDate = `${day < 10 ? '0' : ''}${day}/${month < 10 ? '0' : ''}${month}`;
    const dayOfWeek = dateObj.getDay();
    const daysOfWeek = ["Chủ Nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"];
    const dayName = daysOfWeek[dayOfWeek];
    return ` ${dayName}, ${formattedDate} `;
}

const handleDateDetail = (date, time) => {
    const dateObj = new Date(date);
    const timeParts = time.split(":");
    const hours = timeParts[0];
    const minutes = timeParts[1];
    const getTime = `${hours}:${minutes}`;
    const day = dateObj.getDate();
    const month = dateObj.getMonth() + 1;
    const year = dateObj.getFullYear();
    const formattedDate = `${day < 10 ? '0' : ''}${day}-${month < 10 ? '0' : ''}${month}-${year}`;
    return ` ${getTime} ${formattedDate} `;
}

$(function() {
    dataDetailTrip().then(res => {
        console.log(res);
        const seats = res.seats;
        const route = res.route;
        const seatSelected = res.seatSelected;
        const locationRouteTrip = res.locationRouteTrip;

        let amountSeatTurn = 0;
        let amountSeatReturn = 0;
        let codeSeatTurn = [];
        let codeSeatReturn = [];
        let totalTurn = 0;
        let totalReturn = 0;
        let totalMoney = totalTurn + totalReturn;
        let flag = 0;
        let flagTurn = 0;
        let flagReturn = 0;

        // Hiển thị ghế và click để chọn ghế
        const maxSeatsPerLayer = 24;
        if(route.length === 2) {
            const getSeatTurn = seats
                .filter(item => item.key === 'turn')
                .map(item => [item.id, item.code]);

            const getSeatReturn = seats
                .filter(item => item.key === 'return')
                .map(item => [item.id, item.code]);
            const totalSeatsTurn = getSeatTurn.length;
            const totalSeatsReturn = getSeatReturn.length;

            if(totalSeatsTurn <= maxSeatsPerLayer) {
                showSingleLayer(getSeatTurn, "3");
            } else {
                showDoubleLayer(getSeatTurn);
            }
            if(totalSeatsReturn <= maxSeatsPerLayer) {
                showSingleLayer(getSeatReturn, "4");
            } else {
                showDoubleLayer(getSeatReturn);
            }
        } else {
            const totalSeats = seats.length;
            if (totalSeats <= maxSeatsPerLayer) {
                showSingleLayer(seats);
            } else {
                showDoubleLayer(seats);
            }
        }

        function showSingleLayer(seats, indexParent) {
            if(route.length === 2) {
                const borderRight = indexParent === "3" ? 'border-right-2' : ''
                const nameRoute = indexParent === "3" ? "Chuyến đi, " : "Chuyến về, ";
                const startDate = indexParent === "3" ?
                    handleDate(route[0].start_date) :
                    handleDate(route[1].start_date);
                const routeNew = indexParent === "3" ? route[0] : route[1];
                let amountSeatNew = indexParent === "3" ? amountSeatTurn : amountSeatReturn;
                let codeSeatNew = indexParent === "3" ? codeSeatTurn : codeSeatReturn;
                let totalMoneyNew = indexParent === "3" ? totalTurn : totalReturn;
                let flagNew = indexParent === "3" ? flagTurn : flagReturn;

                const showSeatForTrip = $(`
                    <div class="col-6 ${borderRight}" id="title-header-content-${indexParent}">
                        <table class="d-flex justify-content-center">
                            <tbody id="show-seat-${indexParent}"></tbody>
                        </table>
                    </div>
                `);
                $('#show-seat-for-trip').append(showSeatForTrip);
                $(`#title-header-content-${indexParent}`).prepend(`
                    <div class="choose-seat-title d-flex align-items-center justify-content-between">
                        <p class="fs-18 fw-medium">Chọn ghế</p>
                        <p class="fs-15 cl-blue-light text-decoration-underline cursor fw-medium">Thông tin xe</p>
                    </div>
                    <p class="fs-14 fw-medium">${nameRoute} ${startDate}</p>
                `);
                const nameKeySelectedSeats = indexParent === "3" ? "turn" : "return";
                const arraySeatSelected = seatSelected
                    .filter(item => item[0] === nameKeySelectedSeats)
                    .map(item => item[1]);
                seats.forEach((seat, index) => {
                    const sttSeat = index + 1;
                    if (sttSeat % 4 === 1) {
                        $(`#show-seat-${indexParent}`).append(`
                            <tr class="d-flex align-items-center justify-content-center">

                            </tr>
                        `);
                    }

                    const isSeatSelected = arraySeatSelected.includes(seat[0]);

                    const seatHtml = `
                        <td class="position-relative ${isSeatSelected ? 'cursor-not-allowed' : 'cursor'}">
                            <img src="${baseImageUrl}/${isSeatSelected ? 'seat_disabled' : 'seat_active'}.svg" alt="" class="w-100">
                            <span
                                data-code="${seat[1]}"
                                class="position-absolute fs-10 text-uppercase fw-bold code-seat ${isSeatSelected ? 'seat-disabled' : 'seat-active'}">
                                ${seat[1]}
                            </span>
                        </td>
                    `;

                    const $seat = $(seatHtml);

                    const lastRow = $(`#show-seat-${indexParent}`).find("tr:last-child");
                    lastRow.append($seat);
                    if (sttSeat % 4 === 0) {
                        const secondTd = lastRow.find("td:eq(1)");
                        const spacingTd = $('<td class="gap-1 w-32 h-32"></td>');
                        secondTd.after(spacingTd);
                    }

                    $seat.on('click', function () {
                        const codeSeat = $(this).find('span');
                        const imageSeat = $(this).find('img');
                        if (codeSeat.hasClass('seat-active')) {
                            if (codeSeatNew.length < 5) {
                                amountSeatNew++;
                                totalMoneyNew += routeNew.trip_price;
                                totalMoneyNew += routeNew.trip_price;
                                codeSeatNew.push(codeSeatNew.data('code'));
                                codeSeatNew.removeClass('seat-active').addClass('seat-selecting');
                                imageSeat.attr('src', `${baseImageUrl}/seat_selecting.svg`);
                            }
                            flagNew++;
                        } else if (codeSeat.hasClass('seat-selecting')) {
                            flagNew < 6 ? flagNew-- : flagNew = 4;
                            amountSeatNew > 0 ? amountSeatNew-- : 0;
                            totalMoneyNew > 0 ? totalMoneyNew -= routeNew.trip_price : 0;
                            totalMoneyNew -= routeNew.trip_price;
                            codeSeatNew = codeSeatNew.filter(value => value !== codeSeatNew.data('code'));
                            codeSeatNew.removeClass('seat-selecting').addClass('seat-active');
                            imageSeat.attr('src', `${baseImageUrl}/seat_active.svg`);
                        }
                        if (codeSeatNew.length < 6) {
                            $(`#amount-seat-turn-${indexParent}`).text(`${amountSeatNew} Ghế`);
                            $(`#total-money-turn-${indexParent}`).text(`${totalMoneyNew.toLocaleString("vi-VN")}đ`);
                            $(`#price-money-ticket-turn-${indexParent}`).text(`${totalMoneyNew.toLocaleString("vi-VN")}đ`);
                            $(`#total-money-ticket-trip-${indexParent}`).text(`${totalMoneyNew.toLocaleString("vi-VN")}đ`);
                            $(`#show-total-detail-price-trip-checkout-${indexParent}`).text(`${totalMoneyNew.toLocaleString("vi-VN")}đ`);

                            const showCodeSeatTurn = codeSeatNew.map(item => {
                                return `
                                    ${item}
                                `;
                            });
                            $('#code-seat-turn').html(showCodeSeatTurn.join(', '));
                        }
                        if (
                            codeSeatNew.length === 5 && flagNew > 5 &&
                            codeSeat.hasClass('seat-active')
                        ) {
                            Toastify({
                                text: "Bạn không được chọn quá 5 ghế",
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
                    });
                });
                $(`#show-seat-${indexParent}`).append(`
                        <tr class="gap-1 d-flex align-items-center justify-content-center header-car">
                            <td colspan="2">
                                <span class="fs-10 p-2 fw-medium border-start">
                                    Cửa lên
                                </span>
                            </td>
                            <td class="w-32 h-32">

                            </td>
                            <td colspan="2">
                                <span class="fs-10 p-2 fw-medium border border-1">
                                    Tài xế
                                </span>
                            </td>
                        </tr>
                    `);
            } else {
                $('#show-seat-for-trip').before(`
                    <div class="choose-seat-title d-flex align-items-center justify-content-between">
                        <p class="fs-18 fw-medium">Chọn ghế</p>
                        <p class="fs-15 cl-blue-light text-decoration-underline cursor fw-medium">Thông tin xe</p>
                    </div>
                `)
                const showSeatForTrip = $('<table class="col-4"><tbody id="show-seat-0"></tbody></table>');
                showSeatForTrip.before(`
                    <div class="choose-seat-title d-flex align-items-center justify-content-between">
                        <p class="fs-18 fw-medium">Chọn ghế</p>
                        <p class="fs-15 cl-blue-light text-decoration-underline cursor fw-medium">Thông tin xe</p>
                    </div>
                `)
                $('#show-seat-for-trip').append(showSeatForTrip);

                seats.forEach((seat, index) => {
                    const sttSeat = index + 1;
                    if (sttSeat % 4 === 1) {
                        $('#show-seat-0').append(`
                    <tr class="d-flex align-items-center justify-content-center">

                    </tr>
                `);
                    }

                    const isSeatSelected = seatSelected.includes(seat.id);

                    const seatHtml = `
                <td class="position-relative ${isSeatSelected ? 'cursor-not-allowed' : 'cursor'}">
                <img src="${baseImageUrl}/${isSeatSelected ? 'seat_disabled' : 'seat_active'}.svg" alt="" class="w-100">
                <span
                    data-code="${seat.code}"
                    class="position-absolute fs-10 text-uppercase fw-bold code-seat ${isSeatSelected ? 'seat-disabled' : 'seat-active'}">
                    ${seat.code}
                </span>
            </td>
            `;

                    const $seat = $(seatHtml);

                    const lastRow = $('#show-seat-0').find("tr:last-child");
                    lastRow.append($seat);
                    if (sttSeat % 4 === 0) {
                        const secondTd = lastRow.find("td:eq(1)");
                        const spacingTd = $('<td class="gap-1 w-32 h-32"></td>');
                        secondTd.after(spacingTd);
                    }

                    $seat.on('click', function () {
                        const codeSeat = $(this).find('span');
                        const imageSeat = $(this).find('img');
                        if (codeSeat.hasClass('seat-active')) {
                            if (codeSeatTurn.length < 5) {
                                amountSeatTurn++;
                                totalTurn += route.trip_price;
                                totalMoney += route.trip_price;
                                codeSeatTurn.push(codeSeat.data('code'));
                                codeSeat.removeClass('seat-active').addClass('seat-selecting');
                                imageSeat.attr('src', `${baseImageUrl}/seat_selecting.svg`);
                            }
                            flag++;
                        } else if (codeSeat.hasClass('seat-selecting')) {
                            flag < 6 ? flag-- : flag = 4;
                            amountSeatTurn > 0 ? amountSeatTurn-- : 0;
                            totalTurn > 0 ? totalTurn -= route.trip_price : 0;
                            totalMoney -= route.trip_price;
                            codeSeatTurn = codeSeatTurn.filter(value => value !== codeSeat.data('code'));
                            codeSeat.removeClass('seat-selecting').addClass('seat-active');
                            imageSeat.attr('src', `${baseImageUrl}/seat_active.svg`);
                        }
                        if (codeSeatTurn.length < 6) {
                            $('#amount-seat-turn').text(`${amountSeatTurn} Ghế`);
                            $('#total-money-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                            $('#price-money-ticket-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                            $('#total-money-ticket-trip').text(`${totalMoney.toLocaleString("vi-VN")}đ`);
                            $('#show-total-detail-price-trip-checkout').text(`${totalMoney.toLocaleString("vi-VN")}đ`);

                            const showCodeSeatTurn = codeSeatTurn.map(item => {
                                return `
                        ${item}
                    `;
                            });
                            $('#code-seat-turn').html(showCodeSeatTurn.join(', '));
                        }
                        if (
                            codeSeatTurn.length === 5 && flag > 5 &&
                            codeSeat.hasClass('seat-active')
                        ) {
                            Toastify({
                                text: "Bạn không được chọn quá 5 ghế",
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
                    });
                });

                $('#show-seat-0').append(`
            <tr class="gap-1 d-flex align-items-center justify-content-center header-car">
                <td colspan="2">
                    <span class="fs-10 p-2 fw-medium border-start">
                        Cửa lên
                    </span>
                </td>
                <td class="w-32 h-32">

                </td>
                <td colspan="2">
                    <span class="fs-10 p-2 fw-medium border border-1">
                        Tài xế
                    </span>
                </td>
            </tr>
        `);
                $('#show-seat-for-trip').addClass('justify-content-center');
            }
        }


        function showDoubleLayer(seats) {
            $('#show-seat-for-trip').before(`
                <div class="choose-seat-title d-flex align-items-center justify-content-between">
                    <p class="fs-18 fw-medium">Chọn ghế</p>
                    <p class="fs-15 cl-blue-light text-decoration-underline cursor fw-medium">Thông tin xe</p>
                </div>
            `)
            const showSeatForTripLayer1 = $('<table class="col-6"><tbody id="show-seat-1"></tbody></table>');
            showSeatForTripLayer1.prepend('<p class="layer-name fs-13 fw-medium ta-center">Tầng 1</p>');
            $('#show-seat-for-trip').append(showSeatForTripLayer1);

            seats.slice(0, maxSeatsPerLayer).forEach((seat, index) => {
                const sttSeat = index + 1;
                if (sttSeat % 4 === 1) {
                    $('#show-seat-1').append(`
                <tr class="d-flex align-items-center justify-content-center">

                </tr>
            `);
                }

                const isSeatSelected = seatSelected.includes(seat.id);

                const seatHtml = `
            <td class="position-relative ${isSeatSelected ? 'cursor-not-allowed' : 'cursor'}">
                <img src="${baseImageUrl}/${isSeatSelected ? 'seat_disabled' : 'seat_active'}.svg" alt="" class="w-100">
                <span
                    data-code="${seat.code}"
                    class="position-absolute fs-10 text-uppercase fw-bold code-seat ${isSeatSelected ? 'seat-disabled' : 'seat-active'}">
                    ${seat.code}
                </span>
            </td>
        `;

                const $seat = $(seatHtml);

                const lastRow = $('#show-seat-1').find("tr:last-child");
                lastRow.append($seat);
                if (sttSeat % 4 === 0) {
                    const secondTd = lastRow.find("td:eq(1)");
                    const spacingTd = $('<td class="gap-1 w-32 h-32"></td>');
                    secondTd.after(spacingTd);
                }

                $seat.on('click', function() {
                    const codeSeat = $(this).find('span');
                    const imageSeat = $(this).find('img');
                    if (codeSeat.hasClass('seat-active')) {
                        if(codeSeatTurn.length < 5) {
                            amountSeatTurn++;
                            totalTurn += route.trip_price;
                            totalMoney += route.trip_price;
                            codeSeatTurn.push(codeSeat.data('code'));
                            codeSeat.removeClass('seat-active').addClass('seat-selecting');
                            imageSeat.attr('src', `${baseImageUrl}/seat_selecting.svg`);
                        }
                        flag++;
                    } else if (codeSeat.hasClass('seat-selecting')) {
                        flag < 6 ? flag-- : flag = 4;
                        amountSeatTurn > 0 ? amountSeatTurn-- : 0;
                        totalTurn > 0 ? totalTurn -= route.trip_price : 0;
                        totalMoney -= route.trip_price;
                        codeSeatTurn = codeSeatTurn.filter(value => value !== codeSeat.data('code'));
                        codeSeat.removeClass('seat-selecting').addClass('seat-active');
                        imageSeat.attr('src', `${baseImageUrl}/seat_active.svg`);
                    }
                    if(codeSeatTurn.length < 6) {
                        $('#amount-seat-turn').text(`${amountSeatTurn} Ghế`);
                        $('#total-money-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                        $('#price-money-ticket-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                        $('#total-money-ticket-trip').text(`${totalMoney.toLocaleString("vi-VN")}đ`);
                        $('#show-total-detail-price-trip-checkout').text(`${totalMoney.toLocaleString("vi-VN")}đ`);

                        const showCodeSeatTurn = codeSeatTurn.map(item => {
                            return `
                        ${item}
                    `;
                        });
                        $('#code-seat-turn').html(showCodeSeatTurn.join(', '));
                    }
                    if(
                        codeSeatTurn.length === 5 && flag > 5 &&
                        codeSeat.hasClass('seat-active')
                    ) {
                        Toastify({
                            text: "Bạn không được chọn quá 5 ghế",
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
                });
            });
            $('#show-seat-1').append(`
            <tr class="gap-1 d-flex align-items-center header-car justify-content-center">
                <td colspan="2">
                    <span class="fs-10 p-2 fw-medium border-start">
                        Cửa lên
                    </span>
                </td>
                <td class="w-32 h-32">

                </td>
                <td colspan="2">
                    <span class="fs-10 p-2 fw-medium border border-1">
                        Tài xế
                    </span>
                </td>
            </tr>
        `);

            const showSeatForTripLayer2 = $('<table class="col-6 spacing-floor-second"><tbody id="show-seat-2"></tbody></table>');
            showSeatForTripLayer2.prepend('<p class="layer-name spacing-floor-second-title ta-center fs-13 fw-medium">Tầng 2</p>');
            $('#show-seat-for-trip').append(showSeatForTripLayer2);

            seats.slice(maxSeatsPerLayer, maxSeatsPerLayer * 2).forEach((seat, index) => {
                const sttSeat = index + 1;
                if (sttSeat % 4 === 1) {
                    $('#show-seat-2').append(`
                <tr class="d-flex align-items-center justify-content-center">

                </tr>
            `);
                }

                const isSeatSelected = seatSelected.includes(seat.id);

                const seatHtml = `
            <td class="position-relative ${isSeatSelected ? 'cursor-not-allowed' : 'cursor'}">
                <img src="${baseImageUrl}/${isSeatSelected ? 'seat_disabled' : 'seat_active'}.svg" alt="" class="w-100">
                <span
                    data-code="${seat.code}"
                    class="position-absolute fs-10 text-uppercase fw-bold code-seat ${isSeatSelected ? 'seat-disabled' : 'seat-active'}">
                    ${seat.code}
                </span>
            </td>
        `;

                const $seat = $(seatHtml);

                const lastRow = $('#show-seat-2').find("tr:last-child");
                lastRow.append($seat);
                if (sttSeat % 4 === 0) {
                    const secondTd = lastRow.find("td:eq(1)");
                    const spacingTd = $('<td class="gap-1 w-32 h-32"></td>');
                    secondTd.after(spacingTd);
                }

                $seat.on('click', function() {
                    const codeSeat = $(this).find('span');
                    const imageSeat = $(this).find('img');
                    if (codeSeat.hasClass('seat-active')) {
                        if(codeSeatTurn.length < 5) {
                            amountSeatTurn++;
                            totalTurn += route.trip_price;
                            totalMoney += route.trip_price;
                            codeSeatTurn.push(codeSeat.data('code'));
                            codeSeat.removeClass('seat-active').addClass('seat-selecting');
                            imageSeat.attr('src', `${baseImageUrl}/seat_selecting.svg`);
                        }
                        flag++;
                    } else if (codeSeat.hasClass('seat-selecting')) {
                        flag < 6 ? flag-- : flag = 4;
                        amountSeatTurn > 0 ? amountSeatTurn-- : 0;
                        totalTurn > 0 ? totalTurn -= route.trip_price : 0;
                        totalMoney -= route.trip_price;
                        codeSeatTurn = codeSeatTurn.filter(value => value !== codeSeat.data('code'));
                        codeSeat.removeClass('seat-selecting').addClass('seat-active');
                        imageSeat.attr('src', `${baseImageUrl}/seat_active.svg`);
                    }
                    if(codeSeatTurn.length < 6) {
                        $('#amount-seat-turn').text(`${amountSeatTurn} Ghế`);
                        $('#total-money-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                        $('#price-money-ticket-turn').text(`${totalTurn.toLocaleString("vi-VN")}đ`);
                        $('#total-money-ticket-trip').text(`${totalMoney.toLocaleString("vi-VN")}đ`);
                        $('#show-total-detail-price-trip-checkout').text(`${totalMoney.toLocaleString("vi-VN")}đ`);

                        const showCodeSeatTurn = codeSeatTurn.map(item => {
                            return `
                        ${item}
                    `;
                        });
                        $('#code-seat-turn').html(showCodeSeatTurn.join(', '));
                    }
                    if(
                        codeSeatTurn.length === 5 && flag > 5 &&
                        codeSeat.hasClass('seat-active')
                    ) {
                        Toastify({
                            text: "Bạn không được chọn quá 5 ghế",
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
                });

            });
        }

        $('#show-seat-for-trip').append(`
                <div class="my-auto col-12 d-flex justify-content-center pt-4">
                    <div class="d-flex align-items-center mb-3 ms-4">
                        <img src="${baseImageUrl}/seat_disabled.svg" alt="" class="w-14">
                        <p class="fs-13 fw-medium mb-1 ps-2">Đã bán</p>
                    </div>
                    <div class="d-flex align-items-center mb-3 ms-4">
                        <img src="${baseImageUrl}/seat_active.svg" alt=""  class="w-14">
                        <p class="fs-13 fw-medium mb-1 ps-2">Còn trống</p>
                    </div>
                    <div class="d-flex align-items-center mb-3 ms-4">
                        <img src="${baseImageUrl}/seat_selecting.svg" alt=""  class="w-14">
                        <p class="fs-13 fw-medium mb-1 ps-2">Đang chọn</p>
                    </div>
                </div>
            `);

        // Hiển thị ghế và click để chọn ghế

        // Hiển thị thông tin chuyến đi
        const informationTripSearch = $("#information-trip-search");
        if(route.length === 2 ) {
            const startDateTurn = handleDate(route[0].start_date);
            const startDateReturn = handleDate(route[1].start_date);
            informationTripSearch.append(`
                <h3 class="">${route[0].start_location} - ${route[0].end_location}</h3>
                <p class="fw-medium ta-center">${startDateTurn} - ${startDateReturn}</p>
            `);
        } else {
            const startDate = handleDate(route.start_date);
            informationTripSearch.append(`
                <h3 class="">${route.start_location} - ${route.end_location}</h3>
                <p class="fw-medium ta-center">${startDate}</p>
            `);
        }

        const infoBookTicket = $('#info-book-ticket');
        const detailPriceTrip = $('#detail-price-trip');
        const totalDetailPriceTripCheckout = $('#total-detail-price-trip-checkout');

        // Validate form thông tin người dùng
        $("#phone").on("input", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
        });

        $(function() {
            $("#form-forward-checkout").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        phoneVN: true
                    },
                    policy: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Họ và tên không được trống"
                    },
                    email: {
                        required: "Email không được trống",
                        email: "Email không hợp lệ"
                    },
                    phone: {
                        required: "Số điện thoại không được trống"
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") !== "policy") {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    if (element.name === "policy") {
                        Toastify({
                            text: "Bạn phải chấp nhận điều khoản",
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
                },
                submitHandler: function(form) {
                    alert('hehe');
                }
            });

            $.validator.addMethod("phoneVN", function(value, element) {
                const phoneNumberPattern = /^(0|\+84)[2-9]\d{8,9}$/;
                return this.optional(element) || phoneNumberPattern.test(value);
            }, "Số điện thoại không hợp lệ");
        });
        // Validate form thông tin người dùng

        if(route.length === 2 ) {
            route.forEach((item, index) => {
                const nameRoute = index === 0 ? "lượt đi" : "lượt về";
                const totalTurnReturn = index === 0 ? totalTurn : totalReturn;
                const idFollow = index === 0 ? index + 3 : index + 4;
                const dateDepart = handleDateDetail(item.start_date, item.start_time);
                let amountSeatNew = idFollow === 3 ? amountSeatTurn : amountSeatReturn;
                let totalMoneyNew = idFollow === 3 ? totalTurn : totalReturn;
                infoBookTicket.append(`
                    <div class="border border-1 rounded-3 mb-4 py-4 ">
                        <div class="choose-seat-title d-flex align-items-center justify-content-between px-4">
                            <p class="fs-18 fw-medium">Thông tin ${nameRoute}</p>
                        </div>
                        <div class="px-4">
                            <div class="d-flex justify-content-between mb-1">
                                <p class="cl-gray fs-15 fw-medium mb-1" >Tuyến xe</p>
                                <p class="fw-medium fs-15 mb-1">${item.start_location} ⇒ ${item.end_location}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="cl-gray fs-15 fw-medium mb-1" >Thời gian</p>
                                <p class="fw-medium fs-15 mb-1">${dateDepart}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="cl-gray fs-15 fw-medium mb-1" >Số lượng ghế</p>
                                <p class="fw-medium fs-15 mb-1" id="amount-seat-turn-${idFollow}">${amountSeatNew} Ghế</p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="cl-gray fs-15 fw-medium mb-1" >Số ghế</p>
                                <p class="fw-medium fs-15 mb-1">
                                    <span id="code-seat-turn-${idFollow}"></span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="cl-gray fs-15 fw-medium" >Tổng tiền ${nameRoute}</p>
                                <p class="fw-medium fs-15">
                                    <span class="cl-orange" id="total-money-turn-${idFollow}">${totalMoneyNew}đ</span>
                                </p>
                            </div>
                        </div>
                    </div>
                `);
                detailPriceTrip.append(`
                     <div class="d-flex justify-content-between mb-1">
                        <p class="cl-gray fs-15 fw-medium mb-1" >Giá vé ${nameRoute}</p>
                        <p class="fw-medium fs-15 cl-orange mb-1" id="price-money-ticket-turn-${index}">
                            ${totalTurnReturn}đ
                        </p>
                    </div>
                `);
            });
            detailPriceTrip.append(`
                <div class="d-flex justify-content-between mb-1 border-bottom">
                    <p class="cl-gray fs-15 fw-medium mb-3" >Phí thanh toán</p>
                    <p class="fw-medium fs-15 mb-1">0đ</p>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <p class="cl-gray fs-15 fw-medium mb-1" >Tổng tiền</p>
                    <p class="fw-medium fs-15 cl-orange mb-1" id="total-money-ticket-trip">${totalMoney}đ</p>
                </div>
            `);

        } else {
            const dateDepart = handleDateDetail(route.start_date, route.start_time);
            infoBookTicket.append(`
                <div class="border border-1 rounded-3 mb-4 py-4 ">
                    <div class="choose-seat-title d-flex align-items-center justify-content-between px-4">
                        <p class="fs-18 fw-medium">Thông tin lượt đi</p>
                    </div>
                    <div class="px-4">
                        <div class="d-flex justify-content-between mb-1">
                            <p class="cl-gray fs-15 fw-medium mb-1" >Tuyến xe</p>
                            <p class="fw-medium fs-15 mb-1">${route.start_location} ⇒ ${route.end_location}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <p class="cl-gray fs-15 fw-medium mb-1" >Thời gian</p>
                            <p class="fw-medium fs-15 mb-1">${dateDepart}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <p class="cl-gray fs-15 fw-medium mb-1" >Số lượng ghế</p>
                            <p class="fw-medium fs-15 mb-1" id="amount-seat-turn">${amountSeatTurn} Ghế</p>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <p class="cl-gray fs-15 fw-medium mb-1" >Số ghế</p>
                            <p class="fw-medium fs-15 mb-1">
                                <span id="code-seat-turn"></span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <p class="cl-gray fs-15 fw-medium" >Tổng tiền lượt đi</p>
                            <p class="fw-medium fs-15">
                                <span class="cl-orange" id="total-money-turn">${totalTurn}đ</span>
                            </p>
                        </div>
                    </div>
                </div>
            `);
            detailPriceTrip.append(`
                 <div class="d-flex justify-content-between mb-1">
                    <p class="cl-gray fs-15 fw-medium mb-1" >Giá vé lượt đi</p>
                    <p class="fw-medium fs-15 cl-orange mb-1" id="price-money-ticket-turn">${totalTurn}đ</p>
                </div>
                <div class="d-flex justify-content-between mb-1 border-bottom">
                    <p class="cl-gray fs-15 fw-medium mb-3" >Phí thanh toán</p>
                    <p class="fw-medium fs-15 mb-1">0đ</p>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <p class="cl-gray fs-15 fw-medium mb-1" >Tổng tiền</p>
                    <p class="fw-medium fs-15 cl-orange mb-1" id="total-money-ticket-trip">${totalMoney}đ</p>
                </div>
            `);
        }
        totalDetailPriceTripCheckout.append(`
            <p class="fs-22 fw-medium mb-0">
                Tổng tiền: <span class="cl-gray" id="show-total-detail-price-trip-checkout">${totalMoney}đ</span>
            </p>
        `);

        if(route.length === 2 ) {
            route.forEach((routeNameCg, index) => {
                const nameRoute = index === 0 ? "Chuyến đi, " : "Chuyến về, ";
                const classNameRoute = index === 0 ? "place-turning-returning" : "";
                const startDate = handleDate(routeNameCg.start_date);
                $('#info-turn-return').append(`
                    <div class="col-12 ${classNameRoute}">
                        <div class="px-4">
                            <div class="infor-place-title d-flex align-items-center">
                                <p class="fs-18 fw-medium">Thông tin đón trả</p>
                                <p>
                                    <i class="fa-solid fa-circle-exclamation fs-16 ps-2 cursor cl-orange">
                                    </i>
                                </p>
                            </div>
                            <p class="fs-14 fw-medium">${nameRoute} ${startDate}</p>
                        </div>
                        <div class="px-4 d-flex align-items-center justify-content-between">
                            <div class="w-50">
                                <p class="fw-medium mb-1">ĐIỂM ĐÓN</p>
                                <select class="form-select w-100 cursor"
                                    id="place-start-turn-${index}" aria-label="place_start_${index}"
                                >
                                </select>
                            </div>
                            <div class="between-place-solid mx-4">
                            </div>
                            <div class="w-50">
                                <p class="fw-medium mb-1">ĐIỂM TRẢ</p>
                                <select class="form-select w-100 cursor"
                                    id="place-end-turn-${index}" aria-label="place_end_${index}"
                                >
                                </select>
                            </div>
                        </div>
                    </div>
                `);
                locationRouteTrip.forEach(item => {
                    if(index === 0) {
                        if(item.key === "start_location") {
                            $(`#place-start-turn-${index}`).append(`
                            <option value="${item.id}">${item.name}</option>
                        `);
                        } else if(item.key === "end_location") {
                            $(`#place-end-turn-${index}`).append(`
                            <option value="${item.id}">${item.name}</option>
                        `);
                        }
                    } else {
                        if(item.key === "end_location") {
                            $(`#place-start-turn-${index}`).append(`
                            <option value="${item.id}">${item.name}</option>
                        `);
                        } else if(item.key === "start_location") {
                            $(`#place-end-turn-${index}`).append(`
                            <option value="${item.id}">${item.name}</option>
                        `);
                        }
                    }
                });
            });

        } else {
            $('#info-turn-return').append(`
                <div class="col-12">
                    <div class="px-4">
                        <div class="infor-place-title d-flex align-items-center">
                            <p class="fs-18 fw-medium">Thông tin đón trả</p>
                            <p><i class="fa-solid fa-circle-exclamation fs-16 ps-2 cursor cl-orange"></i></p>
                        </div>
                    </div>
                    <div class="px-4 d-flex align-items-center justify-content-between">
                        <div class="w-50">
                            <p class="fw-medium mb-1">ĐIỂM ĐÓN</p>
                            <select class="form-select w-100 cursor" id="place-start-turn" aria-label="place_start">
                            </select>
                        </div>
                        <div class="between-place-solid mx-4">
                        </div>
                        <div class="w-50">
                            <p class="fw-medium mb-1">ĐIỂM TRẢ</p>
                            <select class="form-select w-100 cursor"  id="place-end-turn" aria-label="place_end">
                            </select>
                        </div>
                    </div>
                </div>
            `);
            locationRouteTrip.forEach(item => {
                if(item.key === "start_location") {
                    $('#place-start-turn').append(`
                    <option value="${item.id}">${item.name}</option>
                `);
                } else if(item.key === "end_location") {
                    $('#place-end-turn').append(`
                    <option value="${item.id}">${item.name}</option>
                `);
                }
            });
        }
    });
});


