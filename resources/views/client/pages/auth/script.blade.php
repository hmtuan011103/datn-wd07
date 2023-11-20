<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    const loginForm = document.getElementById("login-form");
    const loginName = document.getElementById("loginName");
    const registerName = document.getElementById("registerName");
    const registerForm = document.getElementById("register-form");

    loginForm.style.display = "block";
    loginName.style.display = "block";
    registerForm.style.display = "none";
    registerName.style.display = "none";

    function clearRegisterForm() {
        document.getElementById("register-phone").value = "";
        document.getElementById("register-name").value = "";
        document.getElementById("register-email").value = "";
        document.getElementById("register-password").value = "";
        document.getElementById("register-confirm-password").value = "";
        document.getElementById("tel-error-container").textContent = "";
        document.getElementById("name-error-container").textContent = "";
        document.getElementById("email_error").textContent = "";
        document.getElementById("password_error").textContent = "";
        document.getElementById("confirm_password_error").textContent = "";
    }

    document.getElementById("login-link").addEventListener("click", () => {
        loginForm.style.display = "block";
        loginName.style.display = "block";
        registerForm.style.display = "none";
        registerName.style.display = "none";
        clearRegisterForm();
    });

    document.getElementById("register-link").addEventListener("click", () => {
        loginName.style.display = "none";
        registerName.style.display = "block";
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        showForm(1);
    });
    document.addEventListener("DOMContentLoaded", () => {
        const registrationClicked = localStorage.getItem('registrationClicked');
        if (registrationClicked === 'true') {
            localStorage.removeItem('registrationClicked');
            document.getElementById("register-link").click();
            $(document).ready(function() {
                $("a").click(function() {
                    $("a").css("color", "black");
                    $(this).css("color", "rgba(239,82,34,.6)");
                });
                $("#login-link").css("color", "black");
                $("#register-link").css("color", "rgba(239,82,34,.6)");
            })
        }else {
            $(document).ready(function() {
                $("a").click(function() {
                    $("a").css("color", "black");
                    $(this).css("color", "rgba(239,82,34,.6)");
                });
                $("#login-link").css("color", "rgba(239,82,34,.6)");
                $("#register-link").css("color", "black");
            })
        }
    });

    $("#register-phone").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });
    const apiUrl = '/api/getAllPhone';

    document.addEventListener("DOMContentLoaded", async () => {
        try {
            const response = await fetch(apiUrl);
            const data = await response.json();

            if (data.status === true) {
                const phoneNumbers = data.phone_numbers;
                window.phoneNumbersFromAPI = phoneNumbers;
            } else {
                console.error("Lỗi khi lấy danh sách số điện thoại");
            }
        } catch (error) {
            console.error("Lỗi kết nối đến server:", error);
        }
    });
    function isPhoneNumberDuplicate(inputPhoneNumber, existingPhoneNumbers) {
        return existingPhoneNumbers.includes(inputPhoneNumber);
    }
    function showForm(formNumber) {
        document.querySelector('.form1').style.display = 'block';
        document.querySelector('.form2').style.display = 'none';
        if (formNumber === 2) {
            var phone = document.getElementById("register-phone").value;
            var name = document.getElementById("register-name").value;
            var telErrorContainer = document.getElementById("tel-error-container");
            var nameErrorContainer = document.getElementById("name-error-container");
            telErrorContainer.textContent = "";
            nameErrorContainer.textContent = "";
            var phoneRegex = /^0\d{9}$/;
            if (phone.trim() === "") {
                telErrorContainer.textContent = "Vui lòng nhập số điện thoại.";
            } else if (!phone.match(phoneRegex)) {
                telErrorContainer.textContent = "Số điện thoại không hợp lệ.";
                return;
            }

            if (isPhoneNumberDuplicate(phone.trim(), window.phoneNumbersFromAPI)) {
                telErrorContainer.textContent = "Số điện thoại đã tồn tại. Vui lòng nhập số khác.";
                return;
            }

            if (name.trim() === "") {
                nameErrorContainer.textContent = "Vui lòng nhập tên của bạn.";
                return
            }
            document.querySelector('.form1').style.display = 'none';
            document.querySelector('.form2').style.display = 'block';
        }
    }
    // apiUrl_login
    function validateForm() {
        var email = document.getElementById("login-username").value;
        var password = document.getElementById("login-password").value;
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var emailError = document.getElementById("email-error");
        var passwordError = document.getElementById("password-error");
        var errorContainer = document.getElementById("error-message");
        var isValid = true;
        const errorElement = document.getElementById("error-message");
        errorElement.style.display = "none";
        emailError.textContent = ""; // Xóa bất kỳ thông báo lỗi cũ
        passwordError.textContent = "";

        if (!email.match(emailRegex)) {
            emailError.textContent = "Vui lòng nhập địa chỉ email hợp lệ.";
            isValid = false;
        }

        if (password.length === 0) {
            passwordError.textContent = "Mật khẩu không được để trống.";
            isValid = false;
        }

        return isValid;
    }

    const apiUrl_login = 'api/login';
    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        var isValid = validateForm();

        if (isValid) {
            const username = document.getElementById("login-username").value;
            const password = document.getElementById("login-password").value;
            const data = {
                email: username,
                password: password
            };

            try {
                const response = await fetch(apiUrl_login, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const responseData = await response.json();
                if (responseData.status === true) {
                    setCookie('token', responseData.token, 10);
                    setCookie('status', true, 10);

                    // Lưu successMessage vào sessionStorage
                    const successMessage = "Đăng nhập thành công!";
                    sessionStorage.setItem('successMessage', successMessage);
                    const redirectUrl = responseData.redirect_url;
                    window.location.href = redirectUrl;
                } else if (responseData.status === false) {
                    const errorMessage = responseData.message;
                    const errorElement = document.getElementById("error-message");
                    errorElement.textContent = errorMessage;
                    errorElement.style.display = "block";
                }
            } catch (error) {
            }
        }
    });

    // apiUrl_register
    // http://127.0.0.1:8000/

    function validate_Form() {

        var email = document.getElementById("register-email").value;
        var password = document.getElementById("register-password").value;
        var confirmPassword = document.getElementById("register-confirm-password").value;
        var email_Error = document.getElementById("email_error");
        var password_Error = document.getElementById("password_error");
        var confirm_Password_Error = document.getElementById("confirm_password_error");
        email_Error.textContent = "";
        password_Error.textContent = "";
        confirm_Password_Error.textContent = "";
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var passwordRegex = /^.{8,}$/;
        const register_add = document.getElementById("register_add");
        register_add.style.display = "none";

        var isValid = true;

        if (email.trim() === '') {
            email_Error.textContent = "Vui lòng nhập địa chỉ email.";
            isValid = false;
        } else if (!email.match(emailRegex)) {
            email_Error.textContent = "Vui lòng nhập một địa chỉ email hợp lệ.";
            isValid = false;
        }

        if (password.trim() === '') {
            password_Error.textContent = "Vui lòng nhập mật khẩu.";
            isValid = false;
        } else if (!password.match(passwordRegex)) {
            password_Error.textContent = "Mật khẩu phải có ít nhất 8 ký tự.";
            isValid = false;
        }

        if (password !== confirmPassword) {
            confirm_Password_Error.textContent = "Mật khẩu không khớp. Vui lòng nhập lại mật khẩu.";
            isValid = false;
        }

        return isValid;
    }
    const apiUrl_register = 'api/register';
    registerForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        var isValid = validate_Form()
        if (isValid) {
            const phone = document.getElementById("register-phone").value;
            const name = document.getElementById("register-name").value;
            const email = document.getElementById("register-email").value;
            const password = document.getElementById("register-password").value;
            const confirm_password = document.getElementById("register-confirm-password").value;
            const data = {
                phone_number: phone,
                name: name,
                email: email,
                password: password,
                password_confirmation: confirm_password
            };
            try {
                const response = await fetch(apiUrl_register, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.status === true) {
                        window.location.href = responseData.redirect_url;
                    }
                }
            } catch (error) {
                const register_add = document.getElementById("register_add");
                register_add.style.display = "block";
            }
        }
    });

    function setCookie(name, value, minutes) {
        var expires = "";
        if (minutes) {
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
</script>


