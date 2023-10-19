<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        var isFilterSelected = false; // Biến để kiểm tra xem người dùng đã chọn bất kỳ điều kiện nào hay chưa
        // Hàm để lọc dữ liệu
        function filterData() {
            $.ajax({
                type: "GET",
                url: "resources/views/client/pages/search-route/data.json", // Đường dẫn tới tệp JSON chứa dữ liệu giả
                dataType: "json",
                success: function (data) {
                    var selectedHours = [];
                    var selectedVehicleTypes = [];
                    var selectedSeatTypes = [];

                    // Lấy giờ đi được chọn từ các checkbox
                    $("input[type='checkbox']:checked").each(function () {
                        var timeRange = $(this).val().split('-'); // Tách khoảng thời gian thành giờ bắt đầu và giờ kết thúc
                        var startHour = timeRange[0];
                        var endHour = timeRange[1];

                        selectedHours.push({ start: startHour, end: endHour });
                    });

                    // Lấy loại xe được chọn từ các button
                    $(".vehicle-type.active").each(function () {
                        selectedVehicleTypes.push($(this).data("vehicle-type"));
                    });
                    $(".seat-type.active").each(function () {
                        selectedSeatTypes.push($(this).data("seat-type"));
                    });


                    var filteredData = data.filter(function (item) {
                        // Kiểm tra xem loại xe và loại ghế nằm trong các loại đã chọn
                        return (
                            (selectedHours.length === 0 || checkTimeRange(item.hour, selectedHours)) &&
                            (selectedVehicleTypes.length === 0 || selectedVehicleTypes.includes(item.vehicleType)) &&
                            (selectedSeatTypes.length === 0 || selectedSeatTypes.includes(item.seatType))
                        );
                    });

                    // Hiển thị kết quả lọc
                    var result = "";
                    if (filteredData.length > 0) {
                        result += "<div class='result-container'>";
                        filteredData.forEach(function (item) {
                            console.log(item.hour);
                            result += "<div class='result-item'>";
                            result += "<div class='hour'>"+"Thời gian xe chạy: " + item.hour + "</div>";
                            result += "<div class='vehicle-types'>"+"Loại xe: " + item.vehicleType + "</div>";
                            result += "<div class='seat-types'>"+"Loại ghế ngồi: " + item.seatType + "</div>";
                            result += "</div>";
                        });
                        result += "</div>";
                    } else {
                        result = "Sorry, no result.";
                    }
                    $("#result").html(result);
                }
            });
        }

        // Kiểm tra xem giờ đi có nằm trong bất kỳ khoảng thời gian nào trong danh sách đã chọn
        function checkTimeRange(hour, selectedHours) {
            for (var i = 0; i < selectedHours.length; i++) {
                var timeRange = selectedHours[i];
                if (hour >= timeRange.start && hour <= timeRange.end) {
                    return true;
                }
            }
            return false;
        }

        // Sử dụng Ajax để lọc dữ liệu khi có thay đổi trong checkbox và button
        $("input[type='checkbox'], .vehicle-type, .seat-type").change(function () {
            isFilterSelected = true; // Đánh dấu là người dùng đã chọn bất kỳ điều kiện nào.
            filterData();
        });

        // Hiển thị toàn bộ dữ liệu khi người dùng chưa chọn bất kỳ điều kiện nào
        $(window).on('load', function () {
            if (!isFilterSelected) {
                filterData();
            }
        });
        $(".vehicle-type").click(function () {
            $(this).toggleClass("active");

            // Kích hoạt sự kiện change trên các checkbox và button để cập nhật kết quả lọc
            $("input[type='checkbox'], .seat-type").change();
        });
        $(".seat-type").click(function () {
            $(this).toggleClass("active");

            // Kích hoạt sự kiện change trên các checkbox và button để cập nhật kết quả lọc
            $("input[type='checkbox'], .vehicle-type").change();
        });
    });
</script>
