<script>
    var isNotificationDisplayed = false;
    function getProfile() {
        fetch('http://127.0.0.1:8000/api/profile ', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === true) {
                    const nameContainer = document.getElementById('userNameContainer');
                    nameContainer.textContent = data.data.name;
                    const userInfor_fullName = document.getElementById('userInfor_fullName');
                    userInfor_fullName.textContent = data.data.name;
                    const userInfor_phoneNumber = document.getElementById('userInfor_phoneNumber');
                    userInfor_phoneNumber.textContent = data.data.phone_number;
                    const userInfor_email = document.getElementById('userInfor_email');
                    userInfor_email.textContent = data.data.email;
                    const userInfor_location = document.getElementById('userInfor_location');
                    userInfor_location.textContent = data.data.location;
                    const name_Profile = document.getElementById('name_Profile');
                    name_Profile.value = data.data.name;
                    const phone_Profile = document.getElementById('phone_Profile');
                    phone_Profile.value = data.data.phone_number;
                    const email_Profile = document.getElementById('email_Profile');
                    email_Profile.value = data.data.email;
                    const location_Profile = document.getElementById('location_Profile');
                    location_Profile.value = data.data.location;
                    email_Profile.setAttribute('readonly', 'true');
                } else {
                    console.error("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy hồ sơ: " + error);
            });
    }
    getProfile();
    document.getElementById('editButton').addEventListener('click', function (event) {
        event.preventDefault();

        // Lấy tham chiếu đến hai biểu mẫu
        const userInforForm = document.getElementById('userInfor');
        const editProfileForm = document.getElementById('edit_Profile');

        // Chuyển đổi tính hiển thị của các biểu mẫu
        if (userInforForm.style.display === 'none') {
            userInforForm.style.display = 'block';
            editProfileForm.style.display = 'none';
        } else {
            userInforForm.style.display = 'none';
            editProfileForm.style.display = 'block';
        }
    });
    document.getElementById('update_Profile').addEventListener('click', function (event) {
        event.preventDefault();

        var name_Profile = document.getElementById('name_Profile').value;
        var phone_Profile = document.getElementById('phone_Profile').value;
        var email_Profile = document.getElementById('email_Profile').value;
        var location_Profile = document.getElementById('location_Profile').value;
        var nameError = document.getElementById('nameError');
        var phoneError = document.getElementById('phoneError');

        nameError.textContent = '';
        phoneError.textContent = '';
        var errors = [];
        if (!name_Profile.trim()) {
            errors.push('Vui lòng nhập họ và tên.');
        }

        if (!phone_Profile.trim()) {
            errors.push('Vui lòng nhập số điện thoại.');
        }

        if (!/^(0\d{9})$/.test(phone_Profile)) {
            errors.push('Số điện thoại không hợp lệ.');
        }

        // Hiển thị tất cả các lỗi (nếu có)
        displayErrors(errors);

        if (errors.length === 0) {
            const data = {
                name: name_Profile,
                phone_number: phone_Profile,
                email: email_Profile,
                location: location_Profile
            };
            fetch('http://127.0.0.1:8000/api/update_profile', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true && !isNotificationDisplayed) {
                        isNotificationDisplayed = true;
                        Toastify({
                            text: "Thay Đổi Thông Tin Thành Công.", // Nội dung thông báo của bạn
                            duration: 200000, // Thời gian hiển thị thông báo
                            newWindow: true,
                            close: true,
                            gravity: "right", // Đặt gravity là "right" để thông báo hiển thị sát lề phải
                            position: "fixed", // Đặt vị trí là "fixed" để thông báo hiển thị ở cố định
                            stopOnFocus: true,
                            style: {
                                "margin-top": "140px",
                                "margin-left": "80%", // Đúng cú pháp và thêm dấu nháy đơn
                                position: "absolute", // Đặt position thành "absolute"
                                background: "#4CAF50", // Màu nền đỏ với độ trong suốt
                                padding: "20px 10px",
                                borderRadius: "5px",
                                zIndex: 9999 //
                            },
                        }).showToast();

                        setTimeout(() => {
                            window.location.href = 'thong-tin';
                        }, 2000);
                    } else if (!isNotificationDisplayed) {
                        isNotificationDisplayed = true;
                        Toastify({
                            text: "Thay Đổi Thông Tin Thất Bại.", // Nội dung thông báo của bạn
                            // duration: 2000, // Thời gian hiển thị thông báo
                            newWindow: true,
                            close: true,
                            gravity: "top", // Đặt gravity là "top" để thông báo hiển thị ở trên cùng
                            position: "left", // Đặt vị trí là "right" để thông báo hiển thị bên phải
                            stopOnFocus: true,
                            style: {
                                "margin-top": "140px",
                                "margin-left": "80%",
                                position: "absolute", // Đặt position thành "absolute"
                                background: "rgba(239, 82, 34, 0.7)", // Màu nền đỏ với độ trong suốt
                                padding: "20px 10px",
                                borderRadius: '5px',
                                zIndex: 9999 // Đặt z-index cao để hiển thị đè lên giao diện
                            },
                        }).showToast();
                        setTimeout(() => {
                            window.location.href = 'thong-tin';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.log('Lỗi khi gửi yêu cầu: ' + error);
                });
        }
    });

    function displayErrors(errors) {
        var nameError = document.getElementById('nameError');
        var phoneError = document.getElementById('phoneError');
        nameError.textContent = '';
        phoneError.textContent = '';

        errors.forEach(function (error) {
            if (error.includes('họ và tên')) {
                nameError.textContent = error;
            }
            if (error.includes('số điện thoại')) {
                phoneError.textContent = error;
            }
        });
    }
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
