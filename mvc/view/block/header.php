<head>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css">
    <!-- <script type="text/javascript" src="../public/js/header.js"></script> -->
    <script type="text/javascript" src="../search/search.js"></script>
</head>
<div class="header">
    <div class="header-title">
        <a class="h1" href="../Home/">Music</a>
    </div>
    <div class="back-next">
        <button onclick="back()" class="btn btnprev"><i class="fa fa-chevron-left"></i></button>
        <button onclick="next()" class="btn btncont"><i class="fa fa-chevron-right"></i></button>
    </div>
    <form class="header-search">
        <div class="input-group h">
            <input type="text" class="form-control dropdown-toggle" placeholder="Search..." autocomplete="off">
            <span class="mdi mdi-magnify search-icon"></span>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
            <div class="result"></div>
        </div>
    </form>
    <!-- <?php if (isset($_SESSION["loginedin"]) && $_SESSION['loginedin'] == true)
                echo "success";
            else echo "false";
            ?> -->
    <!-- kiểm tra lại login và hiển thị khi đã login, làm đăng xuất,đăng ký -->
    <div class="account" style="<?php if (!empty($_SESSION['loginedin'])) { ?>  display: none; <?php } ?>">
        <button class="dang-ky btn btn-secondary" onclick="signUp()">Đăng Ký</button>
        <button class="dang-nhap btn btn-secondary" onclick="showLogin()">Đăng Nhập</button>
    </div>
    <div class="account-login" style="<?php if (empty($_SESSION['loginedin'])) { ?> display: none; <?php } ?>">
        <img style="width:50px;height:50px;border-radius: 50%;" src=../img/1702540646.jpg>
        <div class="account-info" id="info" style="display: none;">
            <button class="change-password" onclick="FormChangePassword()">Đổi mật khẩu</button></br>
            <button class="log-out" onclick="Logout()">Đăng xuất</button>
        </div>
    </div>
</div>
<div class="musicForm login" id="login" style="display:none">
    <h2 class="text-center">Login my website</h2>
    <form id="loginForm" method="POST">
        <label for="loginName">Tên đăng nhập:</label>
        <input type="text" name="loginName" placeholder="Nhập tên đăng nhập"></br>
        <laber for="loginPassword">Nhập mật khẩu:</laber>
        <input type="password" name="loginName" placeholder="Nhập mật khẩu">
        <button type="submit" class="login-button" name="submitLogin">Đăng Nhập</button>
    </form>
</div>
<!-- làm tiếp register và sau đó tối ưu lại đn, đk, đx.  -->
<div class="musicForm sign-up" id="signUp" style="display:none">
    <h2 class="text-center">Register my website</h2>
    <form id="signUpForm" method="POST">
        <label for="signUpName">Tên đăng nhập:</label>
        <input type="text" name="signUpName" placeholder="Nhập tên đăng nhập"></br>
        <laber for="signUpPassWord">Nhập mật khẩu:</laber>
        <input type="password" name="signUpPassWord" placeholder="Nhập mật khẩu">
        <button type="submit" class="login-button" name="submitSignUp">Đăng Ký</button>
    </form>
</div>

<div id="overlay"></div>

<script>
    var overlay = document.getElementById('overlay');
    overlay.addEventListener('click', function() {
        document.querySelectorAll('.musicForm').forEach(function(form) {
            form.style.display = 'none';
        });
        overlay.style.display = 'none';
        document.getElementById('create').style.display = "none";
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
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            // Ngăn chặn form gửi đi mặc định 
            event.preventDefault();
            // Lấy dữ liệu từ form
            var name = $('input[name="loginName"]').val();
            var password = $('input[name="loginName"]').val();
            // Gửi dữ liệu lên server bằng AJAX
            $.ajax({
                type: 'POST',
                url: './model/test',
                data: {
                    name: name,
                    password: password,
                    submitLogin: 'submitLogin'
                },
                success: function(response) {
                    // Xử lý kết quả trả về từ server
                    showLogin();
                    window.location.href = "";
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu có)
                    console.error(xhr.responseText);
                    alert('Đăng nhập thất bại. Vui lòng thử lại!');
                }
            });
        });
    });

    function Sign() {

    }
    //đổi mật khẩu
    function FormChangePassword() {
        let formchangepassword = document.createElement("form");
        formchangepassword.innerHTML = `
        <div class="form-change-password">
            <div class="change-password-header bg-primary mx-auto">ĐỔI MẬT KHẨU</div>
            <div class="change-password-body">
                <p>
                    <label>Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="passOld">
                </p>
                <p>
                    <label>Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="passNew1">
                </p>
                <p>
                    <label>Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" name="passNew2">
                </p>
                <p>
                    <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
                </p>
            </div>
        </div>
        `;
        overlay.style.display = 'block';

        document.body.appendChild(formchangepassword);
        // Gán sự kiện submit cho form

        overlay.addEventListener('click', function() {
            formchangepassword.remove();
            overlay.style.display = 'none';
        });

        $(formchangepassword).submit(function(event) {
            event.preventDefault();
            var userName = <?php if (isset($_SESSION["username"])) echo $_SESSION["username"];
                            else echo '-1'; ?>;
            var passOld = $('input[name="passOld"]').val();
            var passNew1 = $('input[name="passNew1"]').val();
            var passNew2 = $('input[name="passNew2"]').val();
            $.ajax({
                type: 'POST',
                url: './model/test',
                data: {
                    userName: userName,
                    passOld: passOld,
                    passNew1: passNew1,
                    passNew2: passNew2,
                    submitChangePassword: 'submitChangePassword'
                },
                success: function(response) {
                    // alert(response);
                    formchangepassword.remove();
                    overlay.style.display = 'none';
                }
            });
        });
    }

    // function test(){
    //     alert("testr");
    //         event.preventDefault();
    //         var passOld = $('input[name="passOld"]').val();
    //         var passNew1 = $('input[name="passNew1"]').val();
    //         var passNew2 = $('input[name="passNew2"]').val();
    //         $.ajax({
    //             type: 'POST',
    //             url: './model/test',
    //             data: {
    //                 passOld: passOld,
    //                 passNew1: passNew1,
    //                 passNew2: passNew2,
    //                 submitChangePass:'submitChangePass'
    //             },
    //             success: function(response) {
    //                 alert(response);
    //                 alert("cc");
    //             }
    //         });
    // }
    // $(document).ready(function() {
    //     $('#changepass-form').submit(function(event) {
    //         alert("testr");
    //         event.preventDefault();
    //         var passOld = $('input[name="passOld"]').val();
    //         var passNew1 = $('input[name="passNew1"]').val();
    //         var passNew2 = $('input[name="passNew2"]').val();
    //         $.ajax({
    //             type: 'POST',
    //             url: './model/test',
    //             data: {
    //                 passOld: passOld,
    //                 passNew1: passNew1,
    //                 passNew2: passNew2,
    //                 submitChangePass: 'submitChangePass'
    //             },
    //             success: function(response) {
    //                 alert(response);
    //                 alert("cc");
    //             }
    //         });
    //     });
    // });

    //kiểm tra lại
    //sereach form
    $(document).ready(function() {
        // Khi nhấn vào nút "Search"
        $('.btn-primary').on('click', function(event) {
            // Ngăn chặn hành động mặc định của nút submit
            event.preventDefault();
            // Lấy giá trị của phần tử input
            var inputVal = $('.input-group input[type="text"]').val();
            window.location.href = './ShowSearch?name=' + inputVal;
            // // Kiểm tra nếu có giá trị trong input
            // if (inputVal.length) {
            //     // Thực hiện AJAX request để gửi dữ liệu đi
            //     $.ajax({
            //         url: "./model/test",
            //         type: "GET",
            //         data: {
            //             InputVal: inputVal
            //         },
            //         success: function(data) {
            //             // alert(data);
            //             window.location.href= './ShowSearch/name=' +data;
            //         },
            //         error: function(xhr, status, error) {
            //             console.error(xhr.responseText);
            //         }
            //     });
            // } 
        });
    });

    function Logout() {
        alert("logout");
        $.ajax({
            url: './model/test',
            method: "GET",
            data: {
                logout: "logout"
            },
            success: function(response) {
                window.location.href = "";
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.error("Lỗi khi gọi Ajax: " + error);
            }
        });
    }
    //back and next
    function back() {
        window.history.back();
    }

    function next() {
        window.history.next();
    }

    // function info() {
    //     var form = document.getElementById("info");
    //     if (form.style.display === "none") {
    //         form.style.display = "block";
    //     } else {
    //         form.style.display = "none";
    //     }
    // }
    $(document).ready(function() {
        $('.account-login').on('click', function(event) {
            event.stopPropagation();
            var form = $('#info');
            if (form.is(':visible')) {
                form.hide();
            } else {
                form.show();
            }
        });
        $(document).on('click', function(event) {
            var form = $('#info');
            var target = $(event.target);

            // Nếu không click vào form hoặc nút login thì ẩn form
            if (!target.closest('#info').length && !target.closest('.account-login').length) {
                form.hide();
            }
        });
    });
</script>