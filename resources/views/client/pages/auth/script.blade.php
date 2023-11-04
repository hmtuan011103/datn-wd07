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
    $(document).ready(function() {
        $("a").click(function() {
            $("a").css("color", "black");
            $(this).css("color", "rgba(239,82,34,.6)");
        });
        $("#login-link").css("color", "rgba(239,82,34,.6)");
        $("#register-link").css("color", "black");
    })
    $("#register-phone").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });
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
            }else if(!phone.match(phoneRegex)){
                telErrorContainer.textContent = "Số điện thoại không hợp lệ.";
                return;
            }if (name.trim() === "") {
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
        const login_add = document.getElementById("login_add");
        login_add.style.display = "none";
        emailError.textContent = ""; // Xóa bất kỳ thông báo lỗi cũ
        passwordError.textContent = "";

        if (!email.match(emailRegex)) {
            emailError.textContent = "Vui lòng nhập một địa chỉ email hợp lệ.";
            isValid = false;
        }

        if (password.length < 8) {
            passwordError.textContent = "Mật khẩu phải có ít nhất 8 ký tự.";
            isValid = false;
        }

        return isValid;
    }

    const apiUrl_login = 'http://127.0.0.1:8000/api/login';
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
                    localStorage.setItem('token', responseData.token);
                    localStorage.setItem('status', true);
                    window.location.href = responseData.redirect_url;
                } else if (responseData.status === false) {
                    const errorMessage = responseData.message;
                    const errorElement = document.getElementById("error-message");
                    errorElement.textContent = errorMessage;
                }
            } catch (error) {
                const login_add = document.getElementById("login_add");
                login_add.style.display = "block";
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

        var isValid = true; // Tạo biến để theo dõi tính hợp lệ

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

        return isValid; // Trả về giá trị true nếu dữ liệu hợp lệ, false nếu có lỗi.
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

</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script
