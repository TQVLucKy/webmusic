<head>
    <link rel="stylesheet" type="text/css" href="../public/css/header.css">
    <script type="text/javascript" src="../public/js/header.js"></script>
</head>
<div class="header">
    <div class="header-title">
        <a class="h1" href="../view/block/home.php">Music</a>
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
    <div class="account">
        <a class="DangKy btn btn-secondary" href="./account/sign.php">Đăng Ký</a>
        <a class="DangNhap btn btn-secondary" href="./account/login.php">Đăng Nhập</a>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('.input-group input[type="text"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/backend-search.php", {
                term: inputVal
            }).done(function(data) {
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function() {
        $(this).parents(".input-group").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>