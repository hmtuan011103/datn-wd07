<script>
    // var isNotificationDisplayed = false;
    document.getElementById('changePasswordButton').addEventListener('click', function (event) {
        event.preventDefault();

        var old_Password = document.getElementById('old_Password').value;
        var new_Password = document.getElementById('new_Password').value;
        var confirm_PasswordS = document.getElementById('confirm_PasswordS').value;

        document.getElementById('oldPasswordError').textContent = '';
        document.getElementById('newPasswordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';

        var hasError = false;
        if (new_Password.length < 8) {
            document.getElementById('newPasswordError').textContent = 'Mật khẩu mới phải có ít nhất 8 ký tự.';
            hasError = true;
        }
        if (new_Password !== confirm_PasswordS) {
            document.getElementById('confirmPasswordError').textContent = 'Mật khẩu mới và xác nhận mật khẩu không khớp.';
            hasError = true;
        }
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

                if (data.status === true) {

                        window.location.href = 'pass-word';
                } else {
                    document.getElementById('old_Password').value = '';
                    document.getElementById('new_Password').value = '';
                    document.getElementById('confirm_PasswordS').value = '';

                }
            })
            .catch(error => {
                // console.log('Lỗi khi gửi yêu cầu:', error);
            });
    });

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
