const token = localStorage.getItem('token');
const status = localStorage.getItem('status');
if (status === 'true') {
    document.getElementById("button_login").style.display = "none";
    document.getElementById("button_logout").style.display = "block";
    document.getElementById("logoutButton").addEventListener("click", function () {
        clearTimeout(autoLogoutTimer); // Xóa bỏ timer nếu đăng xuất thủ công
        performLogout();
    });

    const autoLogoutTimeInMinutes = 5;
    const autoLogoutTimeInMillis = autoLogoutTimeInMinutes * 60 * 1000;

    const autoLogoutTimer = setTimeout(function () {
        performAutoLogout();
    }, autoLogoutTimeInMillis);
}

function performAutoLogout() {
    localStorage.removeItem('token');
    localStorage.setItem('status', 'false');
    window.location.href = '/';
}

function performLogout() {
    localStorage.removeItem('token');
    localStorage.setItem('status', 'false');
    window.location.href = '/';
}
function passWord() {
    window.location.href = 'pass-word';
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
document.getElementById("logoutButton").addEventListener("click", function () {
    performLogout();
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
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
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

    getProfile();
}
