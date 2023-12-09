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
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + getCookie('token'),
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {

                if (data.status === true) {
                        localStorage.setItem('message', 'success');
                        window.location.href = 'mat-khau';

                } else {

                    document.getElementById('old_Password').value = '';
                    document.getElementById('new_Password').value = '';
                    document.getElementById('confirm_PasswordS').value = '';
                    Toastify({
                        text: "Mật Khẩu Cũ Không Đúng.",
                        duration: 2000,
                        newWindow: true,
                        close: true,
                        gravity: "right",
                        position: "absolute",
                        stopOnFocus: true,
                        style: {
                            "margin-top": "10px",
                            "right": "10px",
                            "background": "#EF5222",
                            "padding": "20px 10px",
                            "border-radius": "5px",
                            "z-index": "9999",
                            "position": "absolute",
                        }
                    }).showToast();

                }
            })
            .catch(error => {
                // console.log('Lỗi khi gửi yêu cầu:', error);
            });
    });
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    const message = localStorage.getItem('message');

    // Kiểm tra và hiển thị thông báo
    if (message === 'success') {
        Toastify({
            text: "Đổi Mật Khẩu Thành Công.",
            duration: 2000,
            newWindow: true,
            close: true,
            gravity: "right",
            position: "absolute",
            stopOnFocus: true,
            style: {
                "margin-top": "10px",
                "right": "10px",
                "background": "#28a745",
                "padding": "20px 10px",
                "border-radius": "5px",
                "z-index": "9999",
                "position": "absolute",
            }
        }).showToast();

        // Xóa giá trị thông báo từ localStorage sau khi sử dụng
        localStorage.removeItem('message');
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var currentPath = window.location.pathname.split('/').pop();
        if (currentPath === 'mat-khau') {
            document.getElementById("password_menu").classList.add("highlighted-text");
        }
    });
    function profile() {
        window.location.href = 'thong-tin';
    }
    document.getElementById("profile_menu").addEventListener("click", function () {
        profile();
    });
    function discount() {
        window.location.href = 'ma-giam-gia';
    }
    document.getElementById("discount_menu").addEventListener("click", function () {
        discount();
    });
    function booking_history() {
        window.location.href = 'lich-su';
    }
    document.getElementById("booking_history_menu").addEventListener("click", function () {
        booking_history();
    });
    function passWord() {
        window.location.href = 'mat-khau';
    }
    document.getElementById("password_menu").addEventListener("click", function () {
        passWord();
    });
</script>
