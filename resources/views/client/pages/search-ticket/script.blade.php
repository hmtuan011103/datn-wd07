<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchButton").addEventListener('click', function(event) {
            event.preventDefault();

            // hiệu ứng box-shadow
            var myButton = document.getElementById("searchButton");

            myButton.addEventListener("mouseleave", function() {
                myButton.classList.remove("btn-search");
            });
            // end hiệu ứng

            // start validate
            var phoneNumberInput = document.getElementById("phone_number");
            var ticketCodeInput = document.getElementById("ticketCode");

            // Reset previous validation state
            phoneNumberInput.style.borderColor = "";
            ticketCodeInput.style.borderColor = "";
      


            // Check if any input field is empty
            var phoneNumberValue = phoneNumberInput.value.trim();
            var ticketCodeValue = ticketCodeInput.value.trim();


            var hasError = false;

            if (ticketCodeValue === "") {
                ticketCodeInput.style.borderColor = "red";
                hasError = true;
            }

            if (phoneNumberValue === "") {
                phoneNumberInput.style.borderColor = "red";
                hasError = true;
            }

            if (hasError) {
                return; // Stop form submission
            }
            // end validate

            // start logic
            var link = 'http://127.0.0.1:8000/';
            var phone_number = phoneNumberInput.value;
            var code_bill = ticketCodeInput.value;

            fetch(link + 'api/search_ticket?phone_number=' + phone_number + '&code_bill=' + code_bill)
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
                  <p class="label-user">${data[0].name}</p>
                  <p class="label-user">${data[0].phone_number}</p>
                  <p class="label-user">${data[0].email}</p>
                </div>
              </div>
              <div class="col-md-6 text-user">
                <div class="detail-user-one">
                  <p>Tổng giá vé : </p>
                  <p>Trạng thái : </p>
                </div>
                <div class="detail-user-two">
                  <p class="label-user">${data[0].total_money}.000đ</p>
                  <p class="label-user pttt">${data[0].status_pay === 0 ? "Chưa thanh toán" : "Đã thanh toán"}</p>
                </div>
              </div>
            </div>
          `;

                        containerTicket.appendChild(ticketInfo);

                        // Thêm các thông tin vé vào container-ticket
                        var ticketContainer = document.createElement("div");
                        ticketContainer.className = "ticket";
                        data.forEach(function(ticket) {
                            var pricePerTicket = ticket.total_money / data.length;
                            var startDate = new Date(ticket.start_date);

                            // Định dạng ngày tháng năm
                            var formattedStartDate = startDate.toLocaleDateString();
                            var startTime = ticket.start_time;
                            var formattedStartTime = startTime.slice(0, 5);
                            var ticketElement = document.createElement("div");
                            ticketElement.innerHTML = `
              <div class="grid-ticket">
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
                      <p>${pricePerTicket}.000đ</p>
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

                        containerTicket.appendChild(ticketContainer);
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