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
    fetch('http://127.0.0.1:8000/api/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                localStorage.removeItem('token');
                localStorage.setItem('status', 'false');
                window.location.href = '/';
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

function performLogout() {
    fetch('http://127.0.0.1:8000/api/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                localStorage.removeItem('token');
                localStorage.setItem('status', 'false');
                window.location.href = '/';
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

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
