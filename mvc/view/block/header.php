<head>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css">
    <!-- <script type="text/javascript" src="../public/js/header.js"></script> -->
    <script type="text/javascript" src="../search/search.js"></script>
</head>
<div class="header">
    <div class="header-title">
        <a class="h1" href="../Home/">Music</a>
    </div>
    <form class="header-search">
        <div class="input-group h">
            <input type="text" class="form-control dropdown-toggle" placeholder="Search..." autocomplete="off" style="width:500px">
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
        <a class="DangKy btn btn-secondary" onclick="Register()">Đăng Ký</a>
        <a class="DangNhap btn btn-secondary" onclick="Login()">Đăng Nhập</a>
    </div>
    <div class="accountlogin" style="<?php if (empty($_SESSION['loginedin'])) { ?> display: none; <?php } ?>">
        <img onclick="Info()" style="max-width:50px;height:50px;border-radius: 50%;" src=../img/1702540646.jpg>
        <div class="info" id="info" style="display: none;">
            <a class="DangXuat" onclick="Logout()">Đăng Xuất</a>
        </div>
    </div>
</div>
<div class="login" id="login" style="display:none">
    <h2 class="text-center">Login my website</h2>
    <form id="loginForm" method="POST">
        <label for="name">Tên đăng nhập:</label>
        <input type="text" name="name" placeholder="Nhập tên đăng nhập"></br>
        <laber for="passWord">Nhập mật khẩu:</laber>
        <input type="password" name="passWord" placeholder="Nhập mật khẩu">
        <button type="submit" class="login-button" name="submitLogin">Đăng Nhập</button>
    </form>
</div>
<!-- làm tiếp register và sau đó tối ưu lại đn, đk, đx.  -->
<div class="register" id="register" style="display:none">
    <h2 class="text-center">Register my website</h2>
    <form id="registerForm" method="POST">
        <label for="name">Tên đăng nhập:</label>
        <input type="text" name="name" placeholder="Nhập tên đăng nhập"></br>
        <laber for="passWord">Nhập mật khẩu:</laber>
        <input type="password" name="passWord" placeholder="Nhập mật khẩu">
        <button type="submit" class="login-button" name="submitLogin">Đăng Nhập</button>
    </form>
</div>
<script>
    function Login() {
        var form = document.getElementById("login");
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
    //
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            // Ngăn chặn form gửi đi mặc định
            event.preventDefault();

            // Lấy dữ liệu từ form
            var name = $('input[name="name"]').val();
            var password = $('input[name="passWord"]').val();
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
                    Login();
                    window.location.href="";
                    // else alert("Đăng nhập thất bại!");
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

    function Logout(){
        alert("logout");
        $.ajax({
            url: './model/test', 
            method: "GET",
            data:{logout:"logout"}, 
            success: function(response) {
                window.location.href = "";
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi (nếu có)
                console.error("Lỗi khi gọi Ajax: " + error);
            }
        });
    }
    function Info(){
        var form = document.getElementById("info");
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>