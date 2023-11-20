const token = getCookie('token');
const status = getCookie('status');
function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) == ' ') cookie = cookie.substring(1, cookie.length);
        if (cookie.indexOf(nameEQ) == 0) return decodeURIComponent(cookie.substring(nameEQ.length, cookie.length));
    }
    return null;
}
function setCookie(name, value, minutes) {
    var expires = "";
    if (minutes) {
        var date = new Date();
        date.setTime(date.getTime() + (minutes * 60 * 1000)); // chuyển đổi phút thành mili giây
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

$(document).ready(function () {
    $('#logoutButton').on('click', function (e) {
        e.preventDefault();
        $('#logoutModal').modal('show');
    });

    $('#confirmLogout').on('click', function () {
    $('#logoutModal').modal('hide');
    clearTimeout(autoLogoutTimer);
    performLogout();
});

    $('#cancelLogout').on('click', function () {
    $('#logoutModal').modal('hide');
});

    if (status === 'true') {
    document.getElementById("button_login").style.display = "none";
    document.getElementById("button_logout").style.display = "block";

    const autoLogoutTimeInMinutes = 5;
    const autoLogoutTimeInMillis = autoLogoutTimeInMinutes * 60 * 1000;

    autoLogoutTimer = setTimeout(function () {
    performLogout();
}, autoLogoutTimeInMillis);
}

    function performLogout() {
    fetch('http://127.0.0.1:8000/api/logout', {
    method: 'POST',
    headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'Authorization': 'Bearer ' + getCookie('token'),
},
})
    .then(response => response.json())
    .then(data => {
    if (data.status) {
    // Xóa cookies khi đăng xuất
    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "status=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.href = '/';
} else {
    console.error(data.message);
}
})
    .catch(error => console.error('Error:', error));
}
});



function passWord() {
    window.location.href = 'mat-khau';
}
document.getElementById("password").addEventListener("click", function () {
    passWord();
});
function profile() {
    window.location.href = 'thong-tin';
}
document.getElementById("profile").addEventListener("click", function () {
    profile();
});
function discount() {
    window.location.href = 'ma-giam-gia';
}
document.getElementById("discount").addEventListener("click", function () {
    discount();
});
function booking_history() {
    window.location.href = 'lich-su';
}
document.getElementById("booking_history").addEventListener("click", function () {
    booking_history();
});
$(document).ready(function () {
    $('#editButton').click(function () {
        $('#userInfor').hide();
        $('#editInfor').show();
    });
});
if (status === 'true') {
    function getProfile() {
        fetch('http://127.0.0.1:8000/api/profile ', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('token'),
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === true) {
                    const nameContainer = document.getElementById('userNameContainer');
                    nameContainer.textContent = data.data.name;
                } else {
                    console.error("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy hồ sơ: " + error);
            });
    }

    if (status === 'true') {
        getProfile();
    }
}
$(document).ready(function() {
    $('#register-link').on('click', function(e) {
        e.preventDefault();
        localStorage.setItem('registrationClicked', 'true');
        window.location.href = "{{ route('dang-nhap') }}";
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const status = getCookie('status');
    const successMessage = sessionStorage.getItem('successMessage');

    if (status === 'true' && successMessage) {
        Toastify({
            text: successMessage,
            duration: 2000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#28a745",
                padding: "20px 10px",
                borderRadius: '5px'
            },
        }).showToast();
        sessionStorage.removeItem('successMessage');
    }
});
