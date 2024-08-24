<head>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css?v=1.1">
</head>
<div class="header">
    <div class="header-title">
        <a class="h1" href="../Home/">Music</a>
    </div>
    <!-- <div class="back-next">
        <button onclick="back()" class="btn btnprev"><i class="fa fa-chevron-left"></i></button>
        <button onclick="next()" class="btn btncont"><i class="fa fa-chevron-right"></i></button>
    </div> -->

    <div class="category-list">
        <button id="showCategoryBtn">Thể Loại</button>
        <div id="CategoryList" class="hidden">
            <?php foreach ($data['Category'] as $print): ?>
                <div class="CategoryItem" data-id="<?php echo $print['IdCategory']; ?>">
                    <?php echo htmlspecialchars($print['NameCategory']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <form class="header-search">
        <div class="input-group header-search-input">
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
        <!-- <button class="dang-ky btn btn-secondary" onclick="signUp()">Đăng Ký</button> -->
        <button class="dang-nhap btn btn-secondary" onclick="showLogin()">Đăng Nhập</button>
    </div>
    <div class="account-login" style="<?php if (empty($_SESSION['loginedin'])) { ?> display: none; <?php } ?>">
        <img style="width:50px;height:50px;border-radius: 50%;" src=../img/1722581702.jpg>
        <div class="account-info" id="info" style="display: none;">
            <button class="change-password" onclick="FormChangePassword()">Đổi mật khẩu</button></br>
            <button class="log-out" onclick="Logout()">Đăng xuất</button>
        </div>
    </div>
</div>
<div class="container">
    <div class="musicForm login" id="login" style="display:none">
        <h2 class="text-center">Đăng nhập</h2>
        <form id="loginForm" method="POST">
            <div class="input-group">
                <label for="loginName">Tên đăng nhập:</label><br>
                <input type="text" name="loginName" placeholder="Nhập tên đăng nhập" required><br>
            </div>
            <div class="input-group">
                <label for="loginPassword">Nhập mật khẩu:</label><br>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Nhập mật khẩu" required><br>
                <div class="password-toggle">
                    <label class="show-password" for="showPassword">Hiển thị mật khẩu</label>
                    <input type="checkbox" id="showPasswordLogin">
                </div>
            </div>
            <button type="submit" class="login-button" name="submitLogin">Đăng Nhập</button>
        </form>
        <p class="switch-form">Chưa có tài khoản? <a href="#" id="show-register">Đăng Ký</a></p>
    </div>
    <div class="musicForm sign-up" id="signUp" style="display:none" onsubmit="return checkPasswordMatch()">
        <h2 class="text-center">Đăng ký</h2>
        <form id="signUpForm" method="POST">
            <div class="input-group">
                <label for="signUpName">Tên đăng nhập:</label>
                <input type="text" name="signUpName" placeholder="Nhập tên đăng nhập" required><br>
            </div>
            <div class="input-group">
                <label for="signUpPassWord">Nhập mật khẩu:</label>
                <input type="password" id="password" name="signUpPassWord" placeholder="Nhập mật khẩu" required><br>
                
            </div>
            <div class="input-group">
                <label for="confirmPassword">Xác nhận mật khẩu:</label>
                <input type="password" id="confirmPassword" oninput="checkPasswordMatch()" name="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                <div class="password-toggle">
                    <label class="show-password" for="showPassword">Hiển thị mật khẩu</label>
                    <input type="checkbox" id="showPassworSignUp">
                </div>
            </div>
            <span id="message" class="error"></span><br><br>
            <button type="submit" class="login-button" name="submitSignUp">Đăng Ký</button>
        </form>
        <p class="switch-form">Đã có tài khoản? <a href="#" id="show-login">Đăng Nhập</a></p>
    </div>
</div>
<div id="overlay"></div>
<script type="text/javascript" src="../public/js/header.js"></script>
<script type="text/javascript" src="../public/js/search.js"></script>