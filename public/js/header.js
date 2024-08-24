
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('showCategoryBtn').addEventListener('click', function () {
        document.getElementById('CategoryList').classList.toggle('hidden');
    });
});
const categoryItems = document.querySelectorAll('.CategoryItem');
categoryItems.forEach(item => {
    item.addEventListener('click', function () {
        const id = item.getAttribute('data-id');
        window.location.href = `Category?id=${id}`;
    })
})

var overlay = document.getElementById('overlay');
overlay.addEventListener('click', function () {
    document.querySelectorAll('.musicForm').forEach(function (form) {
        form.style.display = 'none';
    });
    overlay.style.display = 'none';
    document.getElementById('create').style.display = "none";
});

document.getElementById('show-register').addEventListener('click', function () {
    document.getElementById('login').style.display = 'none';
    document.getElementById('signUp').style.display = 'block';
});

document.getElementById('show-login').addEventListener('click', function () {
    document.getElementById('login').style.display = 'block';
    document.getElementById('signUp').style.display = 'none';
});
document.getElementById('showPasswordLogin').addEventListener('change', function () {
    var passwordField = document.getElementById('loginPassword');
    if (this.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});
document.getElementById('showPassworSignUp').addEventListener('change', function () {
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirmPassword');

    if (this.checked) {
        password.type = 'text';
        confirmPassword.type = 'text';
    } else {
        password.type = 'password';
        confirmPassword.type = 'password';
    }
});

function showLogin() {
    var form = document.getElementById("login");
    if (form.style.display === "none") {
        form.style.display = "block";
        overlay.style.display = 'block';

    } else {
        form.style.display = "none";
    }
}
// login form
$(document).ready(function () {
    $('#loginForm').submit(function (event) {
        // Ngăn chặn form gửi đi mặc định 
        event.preventDefault();
        // Lấy dữ liệu từ form
        var name = $('input[name="loginName"]').val();
        var password = $('input[name="loginPassword"]').val();
        // Gửi dữ liệu lên server bằng AJAX
        $.ajax({
            type: 'POST',
            url: './model/test',
            data: {
                name: name,
                password: password,
                submitLogin: 'submitLogin'
            },
            success: function (response) {
                // Xử lý kết quả trả về từ server
                if (response !== "Tên đăng nhập hoặc mật khẩu không đúng")
                    window.location.reload();
                else alert(response);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.error(xhr.responseText);
                alert('Đăng nhập thất bại. Vui lòng thử lại!');
            }
        });
    });
});

function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var message = document.getElementById("message");

    if (password === confirmPassword) {
        message.style.color = "green";
        message.innerHTML = "Mật khẩu khớp.";
        return true;
    } else {
        message.style.color = "red";
        message.innerHTML = "Mật khẩu không khớp.";
        return false;
    }
}
function checkChangePassword() {
    var password = document.getElementById("passNew1").value;
    var confirmPassword = document.getElementById("passNew2").value;
    var message = document.getElementById("messageChangePassword");

    if (password === confirmPassword) {
        message.style.color = "green";
        message.innerHTML = "Mật khẩu khớp.";
        return true;
    } else {
        message.style.color = "red";
        message.innerHTML = "Mật khẩu không khớp.";
        return false;
    }
}
function signUp() {
    var form = document.getElementById("signUp");
    if (form.style.display === "none") {
        form.style.display = "block";
        overlay.style.display = 'block';
    } else {
        form.style.display = "none";
    }
}
// đăng ký
$(document).ready(function () {
    $('#signUpForm').submit(function (event) {
        event.preventDefault();
        var name = $('input[name="signUpName"]').val();
        var password = $('input[name="signUpPassWord"]').val();
        $.ajax({
            type: 'POST',
            url: './model/test',
            data: {
                name: name,
                password: password,
                submitSignUp: 'submitSignUp'
            },
            success: function (response) {
                alert(response);
                // Xử lý kết quả trả về từ server
                window.location.href = "";
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.error(xhr.responseText);
                alert('Đăng nhập thất bại. Vui lòng thử lại!');
            }
        });
    });
});
//đổi mật khẩu
function FormChangePassword() {
    let formchangepassword = document.createElement("form");
    formchangepassword.innerHTML = `
        <div class="form-change-password">
            <div class="change-password-header text-center">ĐỔI MẬT KHẨU</div>
            <div class="change-password-body">
                <div class="input-group">
                    <label>Mật khẩu cũ</label>
                    <input type="password" id="passOld" class="form-control" name="passOld" required>
                </div>
                <div class="input-group">
                    <label>Mật khẩu mới:</label>
                    <input type="password" class="form-control" id="passNew1" name="passNew1"  required>
                </div>
                <div class="input-group">
                    <label>Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" id="passNew2" name="passNew2" oninput="checkChangePassword()" name="confirmPassword" required>
                    <div class="password-toggle">
                    <label class="show-password" for="showPassword">Hiển thị mật khẩu</label>
                    <input type="checkbox" id="showChangePassword">
                    </div>
                </div>
                <span id="messageChangePassword" class="error"></span><br><br>
                <button type="submit">Đổi mật khẩu</button>
            </div>
        </div>
        `;
    overlay.style.display = 'block';

    document.body.appendChild(formchangepassword);
    // Gán sự kiện submit cho form
    document.getElementById('showChangePassword').addEventListener('change', function () {
        var passOld = document.getElementById('passOld');
        var passNew1 = document.getElementById('passNew1');
        var passNew2 = document.getElementById('passNew2');
        if (this.checked) {
            passOld.type = 'text';
            passNew1.type = 'text';
            passNew2.type = 'text';
        } else {
            passOld.type = 'password';
            passNew1.type = 'password';
            passNew2.type = 'password';
        }
    });
    overlay.addEventListener('click', function () {
        formchangepassword.remove();
        overlay.style.display = 'none';
    });

    $(formchangepassword).submit(function (event) {
        event.preventDefault();
        var userConfirmation = confirm("bạn có chắn chắn muốn đổi mật khẩu không?");
        if (userConfirmation) {
            var passOld = $('input[name="passOld"]').val();
            var passNew1 = $('input[name="passNew1"]').val();
            var passNew2 = $('input[name="passNew2"]').val();
            $.ajax({
                type: 'POST',
                url: './model/test',
                data: {
                    passOld: passOld,
                    passNew1: passNew1,
                    passNew2: passNew2,
                    submitChangePassword: 'submitChangePassword'
                },
                success: function (response) {
                    console.log(response);
                    formchangepassword.remove();
                    overlay.style.display = 'none';
                }
            });
        }
    });
}

//kiểm tra lại
//sereach form
$(document).ready(function () {
    // Khi nhấn vào nút "Search"
    $('.btn-primary').on('click', function (event) {
        // Ngăn chặn hành động mặc định của nút submit
        event.preventDefault();
        // Lấy giá trị của phần tử input
        var inputVal = $('.header-search-input input[type="text"]').val();
        window.location.href = './ShowSearch?name=' + inputVal;
    });
});

function Logout() {
    var userConfirmation = confirm("bạn có chắn chắn đăng xuất không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            method: "GET",
            data: {
                logout: "logout"
            },
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.error("Lỗi khi gọi Ajax: " + error);
            }
        });
    }
}

$(document).ready(function () {
    $('.account-login').on('click', function (event) {
        event.stopPropagation();
        var form = $('#info');
        if (form.is(':visible')) {
            form.hide();
        } else {
            form.show();
        }
    });
    $(document).on('click', function (event) {
        var form = $('#info');
        var target = $(event.target);

        // Nếu không click vào form hoặc nút login thì ẩn form
        if (!target.closest('#info').length && !target.closest('.account-login').length) {
            form.hide();
        }
    });
});