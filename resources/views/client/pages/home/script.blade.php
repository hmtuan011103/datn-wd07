<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var link = location.href;
    document.addEventListener('DOMContentLoaded', function() {
        fetch(link + 'api/location/list_client_location')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var selectstartElement = document.getElementById('mySelectstart');
                var selectendElement = document.getElementById('mySelectend');
                var list = data[0];
                list.forEach(function(item) {
                    var optionstart = document.createElement('option');
                    optionstart.value = item.name;
                    optionstart.textContent = item.name;
                    selectstartElement.appendChild(optionstart);
                    var optionend = document.createElement('option');
                    optionend.value = item.name;
                    optionend.textContent = item.name;
                    selectendElement.appendChild(optionend);
                });
            })
            .catch(function(error) {
                console.log('Error:', error);
            });
    });

    function showFormElement() {
        var one_way = document.getElementById("one-way");
        var formElement = document.getElementById("returndate");
        var element = document.getElementById("totalticket");
        if (one_way.checked) {
            formElement.style.display = 'none';
            element.classList.remove("col-4");
            element.classList.add("col");
        } else {
            formElement.style.display = 'block';
            element.classList.add("col-4");
            element.classList.remove("col");
        }
    }
    // flatpickr("#dateInput", {
    //     dateFormat: "d/m/Y",
    // });
    flatpickr("#dateInputstart", {
        minDate: "today",
        dateFormat: "d/m/Y",
        onChange: function(selectedDates, dateStr, instance) {
            // Kiểm tra ngày chọn sau khi thay đổi
            var selectedDate = selectedDates[0];
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            var error_start_time = document.getElementById("error_start_time");
            if (selectedDate < currentDate) {
                error_start_time.textContent = "Không thể chọn ngày trong quá khứ";
                // instance.clear(); // Xóa ngày đã chọn nếu không hợp lệ
            } else {
                error_start_time.textContent = "";
            }
        }
    });

    flatpickr("#dateInputend", {
        minDate: "today",
        dateFormat: "d/m/Y",
        onChange: function(selectedDates, dateStr, instance) {
            // Kiểm tra ngày chọn sau khi thay đổi
            var selectedDate = selectedDates[0];
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            var error_end_time = document.getElementById("error_end_time");
            if (selectedDate < currentDate) {
                error_end_time.textContent = "Không thể chọn ngày trong quá khứ";
                return;
                // instance.clear(); // Xóa ngày đã chọn nếu không hợp lệ
            }else {
                error_end_time.textContent = "";
            }
            
        }
    });



    function submitForm(event) {
        event.preventDefault();
        var type_ticket = document.querySelector('input[name="type-ticket"]:checked').value;
        var start_location = document.querySelector('select[name="start_location"]').value;
        var end_location = document.querySelector('select[name="end_location"]').value;
        var start_time = document.querySelector('input[name="start_time"]').value;
        var end_time = document.querySelector('input[name="end_time"]').value;
        var ticket = document.querySelector('select[name="ticket"]').value;

        var error_start_location = document.getElementById("error_start_location");
        var error_end_location = document.getElementById("error_end_location");
        var error_start_time = document.getElementById("error_start_time");
        var error_end_time = document.getElementById("error_end_time");
        var error_ticket = document.getElementById("error_ticket");
        var dateInputstart = document.getElementById("dateInputstart")._flatpickr.selectedDates[0];
        var dateInputend = document.getElementById("dateInputend")._flatpickr.selectedDates[0];
        if (start_location === '0') {
            error_start_location.textContent = "Vui lòng chọn điểm đi";
            return;
        }else{
            error_start_location.textContent = "";
        }
        if (end_location === '0') {
            error_end_location.textContent = "Vui lòng chọn điểm đến";
            return;
        }else{
            error_end_location.textContent = "";
        }
        if (start_location === end_location) {
            error_end_location.textContent = "Điểm đến phải khác điểm đi";
            return;
        }else{
            error_end_location.textContent = "";
        }
        if (start_time === '') {
            error_start_time.textContent = "Vui lòng chọn ngày đi"
            return;
        }else{
            error_start_time.textContent = ""
        }
        if (type_ticket === '2') {
            if (end_time === '') {
                error_end_time.textContent = "Vui lòng chọn ngày về";
                return;
            }else{
                error_end_time.textContent = "";
            }

            if (dateInputstart > dateInputend) {
                error_end_time.textContent = "Ngày về phải lớn hơn ngày đi";
                return;
            } else {
                error_end_time.textContent = "";
            }
        }

        if (ticket > 5) {
            error_ticket.textContent = "Số vé tối đa là 5";
            return;
        }else{
            error_ticket.textContent = "";
        }

        if (ticket < 1) {
            error_ticket.textContent = "Số vé tối thiểu là 1";
            return;
        }else{
            error_ticket.textContent = "";
        }

        var form = document.getElementById("searchForm");
        var formData = new FormData(form);
        var jsonData = {};

        // Chuyển đổi FormData thành JSON
        for (var pair of formData.entries()) {
            jsonData[pair[0]] = pair[1];
        }
        var queryString = Object.keys(jsonData).map(key => key + '=' + encodeURIComponent(jsonData[key])).join('&');
        window.location.href = link + 'tim-kiem?' + queryString;
    }
</script>
