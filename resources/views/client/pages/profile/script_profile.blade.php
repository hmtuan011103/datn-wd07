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
        document.getElementById('nameError').textContent = '';
        document.getElementById('phoneError').textContent = '';
        var hasError = false;
        if (name_Profile.trim() === '') {
            nameError.textContent = 'Họ và tên không được để trống.';
            hasError = true;
        }
        if (!/^(0\d{9})$/.test(phone_Profile)) {
            phoneError.textContent = 'Số điện thoại không hợp lệ.';
            hasError = true;
        }

        if (hasError) {
            return;
        }

            var data = {
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
                        window.location.href = 'thong-tin';
                    } else if (!isNotificationDisplayed) {
                        isNotificationDisplayed = true;
                    }
                })
                .catch(error => {
                    console.log('Lỗi khi gửi yêu cầu: ' + error);
                });
    });
    $("#phone_Profile").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
