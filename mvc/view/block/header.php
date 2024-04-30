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
    <div class="account">
        <a class="DangKy btn btn-secondary" href="../account/sign.php">Đăng Ký</a>
        <a class="DangNhap btn btn-secondary" href="../account/login.php">Đăng Nhập</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Khi nhấn vào nút "Search"
        $('.btn-primary').on('click', function(event) {
            // Ngăn chặn hành động mặc định của nút submit
            event.preventDefault();
            // Lấy giá trị của phần tử input
            var inputVal = $('.input-group input[type="text"]').val();
            window.location.href='./ShowSearch?name='+ inputVal;
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
</script>