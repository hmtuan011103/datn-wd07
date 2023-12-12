<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("search-Button").addEventListener('click', function(event) {
            event.preventDefault();

            // hiệu ứng box-shadow
            var myButton = document.getElementById("search-Button");

            myButton.addEventListener("mouseleave", function() {
                myButton.classList.remove("btn-search");
            });
            // end hiệu ứng

            // start validate
            var phoneNumberInput = document.getElementById("phone_number");
            var ticketCodeInput = document.getElementById("ticketCode");

            $("#phone_number").on("input", function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });


            // Reset previous validation state
            phoneNumberInput.style.borderColor = "";
            ticketCodeInput.style.borderColor = "";



            // Check if any input field is empty
            var phoneNumberValue = phoneNumberInput.value.trim();
            var ticketCodeValue = ticketCodeInput.value.trim();


            var hasError = false;

            if (ticketCodeValue === "") {
                ticketCodeInput.style.borderColor = "red";
                Toastify({
                    text: "Bạn phải nhập mã vé",
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
                hasError = true;
            }

            const phoneNumberPattern = /^(0|\+84)[2-9]\d{8,9}$/;
            if (phoneNumberValue === "") {
                phoneNumberInput.style.borderColor = "red";
                Toastify({
                    text: "Bạn phải nhập số điện thoại",
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
                hasError = true;
            } else if(!phoneNumberPattern.test(phoneNumberValue)){
                Toastify({
                    text: "Bạn phải nhập đúng định dạng số điện thoại",
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
                hasError = true;
            }

            if (hasError) {
                return; // Stop form submission
            }
            // end validate

            // start logic
            var link = 'http://127.0.0.1:8000/';
            var phone_number = phoneNumberInput.value;
            var code_ticket = ticketCodeInput.value;

            fetch(link + 'api/search_ticket_admin?phone_number=' + phone_number + '&code_ticket=' + code_ticket)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Response status: ' + response.status);
                    }
                    return response.json();
                })
                .then(function(data) {
                    console.log(data);
                    // Hiển thị kết quả trong modal
                    var modalBody = document.getElementById("resultModalBody");
                    modalBody.innerHTML = ""; // Xóa nội dung cũ
                    if (data.length > 0) {
                        // Tạo container-ticket
                        var containerTicket = document.createElement("div");
                        containerTicket.className = "container-ticket";

                        // Thêm thông tin người mua vào container-ticket
                        var ticketInfo = document.createElement("div");
                        ticketInfo.className = "table-ticket";
                        ticketInfo.innerHTML = `
            <div class="title">
              <p>THÔNG TIN VÉ</p>
            </div>
            <div class="row detail-user">
              <div class="col-md-6 text-user">
                <div class="detail-user-one">
                  <p>Họ và tên : </p>
                  <p>Số điện thoại : </p>
                  <p>Email : </p>
                </div>
                <div class="detail-user-two">
                  <p class="label-user">${data[0].user_name}</p>
                  <p class="label-user">${data[0].user_phone}</p>
                  <p class="label-user">${data[0].user_email}</p>
                </div>
              </div>
              <div class="col-md-6 text-user">
                <div class="detail-user-one">
                  <p>Tổng giá vé : </p>
                  <p>Trạng thái : </p>
                </div>
                <div class="detail-user-two">
                  <p class="label-user">${data[0].trip_price.toLocaleString("vi-VN")}đ</p>
                  <p class="label-user pttt">${data[0].status_pay === 0 ? "Chưa thanh toán" : "Đã thanh toán"}</p>
                </div>
              </div>
            </div>
          `;

                        containerTicket.appendChild(ticketInfo);
                        // Thêm các thông tin vé vào container-ticket
                        var ticketContainer = document.createElement("div");
                        ticketContainer.className = "ticket";
                        var id_ticket = [];
                        data.forEach(function(ticket) {
                            var startDate = new Date(ticket.start_date);
                            id_ticket.push(ticket.code_ticket);
                            // Định dạng ngày tháng năm
                            var formattedStartDate = startDate.toLocaleDateString();
                            var startTime = ticket.start_time;
                            var formattedStartTime = startTime.slice(0, 5);
                            var ticketElement = document.createElement("div");
                            ticketElement.innerHTML = `
              <div class="grid-ticket">
                ${ticket.ticket_status != 1 ? '<div class="overlay">Đã checkin</div>' : ''}

                <div class="detail-ticket">

                  <div class="logo">
                    <img src="{{ asset('client/assets/images/logo_web.png') }}"  alt="">
                  </div>
                  <div class="order-ticket">
                    <div class="column-ticket text">
                      <p>Tên tuyến</p>
                      <p>Thời gian</p>
                      <p>Số ghế</p>
                      <p>Điểm đón</p>
                      <p>Điểm trả </p>
                      <p>Giá vé</p>
                    </div>
                    <div class="column-ticket data">
                      <p>${ticket.start_location} - ${ticket.end_location} </p>
                      <p>${formattedStartTime} ${formattedStartDate}</p>
                      <p>${ticket.code_seat}</p>
                      <p>${ticket.pickup_location}</p>
                      <p>${ticket.pay_location}</p>
                      <p>${ticket.trip_price.toLocaleString("vi-VN")}đ</p>
                    </div>
                  </div>
                </div>
                <div class="text-footer" id="hi">
                  <p>Hãy mang mã vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít nhất 60 phút</p>
                </div>
              </div>
            `;
                            ticketContainer.appendChild(ticketElement);
                        });
                        var export_bill = `http://127.0.0.1:8000/manage/search-bill/export/` + id_ticket.join(",");
                        var ticketfooter = document.createElement("div");
                        ticketfooter.className = "ticket-footer";
                        ticketfooter.innerHTML = `
                        <div class="row text-center pt-3 pb-3" >
                          <div class="col-md-5"></div>
                          <div class="col-md-1">
                            <a href="${export_bill}"><button class="btn btn-secondary" type="submit"  id="searchButton" class="btn-search">In vé</button></a>
                          </div>
                          <div class="col-md-1">
                            <button class="btn btn-secondary" class="close" data-bs-dismiss="modal" aria-label="Close">Đóng</button>
                          </div>
                          <div class="col-md-5"></div>
                        </div>
                        `;
                        containerTicket.appendChild(ticketContainer);
                        containerTicket.appendChild(ticketfooter);
                        modalBody.appendChild(containerTicket);
                    } else {
                        modalBody.innerHTML = "Không tìm thấy kết quả.";
                    }

                    // Hiển thị modal
                    $('#resultModal').modal('show');
                })
                .catch(function(error) {
                    console.error(error);
                    // Xử lý lỗi và hiển thị thông báo lỗi ở đây
                });

        });
        // end logic
    });
</script>
