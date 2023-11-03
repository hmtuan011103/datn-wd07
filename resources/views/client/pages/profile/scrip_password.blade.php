<script>
    var isNotificationDisplayed = false;
    document.getElementById('changePasswordButton').addEventListener('click', function (event) {
        event.preventDefault();

        var old_Password = document.getElementById('old_Password').value;
        var new_Password = document.getElementById('new_Password').value;
        var confirm_PasswordS = document.getElementById('confirm_PasswordS').value;

        document.getElementById('oldPasswordError').textContent = '';
        document.getElementById('newPasswordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';

        var hasError = false;

        if (old_Password.trim() === '') {
            document.getElementById('oldPasswordError').textContent = 'Mật khẩu cũ không được để trống.';
            hasError = true;
        }
        if (old_Password === new_Password) {
            document.getElementById('newPasswordError').textContent = 'Mật khẩu cũ và mật khẩu mới không được giống nhau.';
            hasError = true;
        }
        if (new_Password.trim() === '') {
            document.getElementById('newPasswordError').textContent = 'Mật khẩu mới không được để trống.';
            hasError = true;
        }
        if (confirm_PasswordS.trim() === '') {
            document.getElementById('confirmPasswordError').textContent = 'Xác nhận mật khẩu không được để trống.';
            hasError = true;
        }

        if (hasError) {
            return;
        }
        var data = {
            oldPassword: old_Password,
            newPassword: new_Password
        };
        fetch('http://127.0.0.1:8000/api/password', {
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
                        text: "Đổi Mật Khẩu Thành Công.",
                        duration: 200000,
                        newWindow: true,
                        close: true,
                        gravity: "right",
                        position: "fixed",
                        stopOnFocus: true,
                        style: {
                            "margin-top": "140px",
                            "margin-left": "83%",
                            position: "absolute",
                            background: "#4CAF50",
                            padding: "20px 10px",
                            borderRadius: "5px",
                            zIndex: 9999 //
                        },
                    }).showToast();

                    setTimeout(() => {
                        window.location.href = 'pass-word';
                    }, 2000);
                } else if (!isNotificationDisplayed) {
                    isNotificationDisplayed = true;
                    Toastify({
                        text: "Đổi Mật Khẩu Thất Bại.",
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "left",
                        stopOnFocus: true,
                        style: {
                            "margin-top": "140px",
                            "margin-left": "83%",
                            position: "absolute",
                            background: "rgba(239, 82, 34, 0.7)",
                            padding: "20px 10px",
                            borderRadius: '5px',
                            zIndex: 9999
                        },
                    }).showToast();

                    setTimeout(() => {
                        window.location.href = 'pass-word';
                    }, 2000);
                }
            })
            .catch(error => {
                console.log('Lỗi khi gửi yêu cầu:', error);
            });
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
