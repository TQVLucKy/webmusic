<?php
// $dirname="./img/";
// $images= glob($dirname."*.jpg");
include './connect.php';
if (isset($_POST["submit"])) {
    //đường dẫn tạm thời của tệp hình ảnh đã được gửi lên
    $imageName = addslashes($_FILES["image"]["name"]);
    $imageData = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $folder = 'img/';
    $photo = $_FILES['image'];
    $file_extension = explode('.', $photo['name'])[1];
    $file_name = time() . '.' . $file_extension;
    $path_file = $folder . $file_name;
    move_uploaded_file($photo["tmp_name"], $path_file);
    $sql = "INSERT INTO storemusic ( name,nameimage, artist) VALUES ('$imageName', '$file_name','$_POST[artist]')";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "Hình ảnh đã được tải lên thành công.";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    mysqli_query($conn, $sql);
}
$sql = "select * from storemusic";
$results = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Main music</title>
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container header align-items-center bg-dark">
            <div class="header-title">
                <h1>Music</h1>
            </div>
            <form class="header-search">
                <div class="input-group h">
                    <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search" style="width:500px">
                    <span class="mdi mdi-magnify search-icon"></span>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="account">
                <a class="DangKy btn btn-secondary" href="./account/sign.php">Đăng Ký</a>
                <a class="DangNhap btn btn-secondary" href="./account/login.php">Đăng Nhập</a>
            </div>
        </div>
        <form class="container" action="main.php" method="post" enctype="multipart/form-data">
            <label for="image">Chọn hình ảnh:</label>
            <input type="file" name="image">
            <input type="text" name="artist">
            <input type="submit" name="submit" value="Tải lên">
        </form>
        <div class="container list">
            <div class="row">
                <?php
                foreach ($results as $result) {
                    echo '<div class="col-sm">';
                    echo "<img src= ./img/" . $result['nameimage'] . "><br>";
                    echo $result['name'] . "<br>";
                    echo $result['artist'] . "<br>";
                    echo '</div>';
                }
                ?>
                <!-- <div class="col-sm">
                    <img src="./img/cut you off.jpg" alt="" width="100" height="100">
                    <p>cut you off</p>
                    <p>CHINCHILLA</p>
                </div> -->
                <!-- <div class="col-sm">
                    <img src="./img/cut you off.jpg" alt="" width="100" height="100">
                    <p>cut you off</p>
                    <p>CHINCHILLA</p>
                </div>
                <div class="col-sm">
                    <img src="./img/cut you off.jpg" alt="" width="100" height="100">
                    <p>cut you off</p>
                    <p>CHINCHILLA</p>
                </div>
                <div class="col-sm">
                    <img src="./img/cut you off.jpg" alt="" width="100" height="100">
                    <p>cut you off</p>
                    <p>CHINCHILLA</p>
                </div>
                <div class="col-sm">
                    <img src="./img/cut you off.jpg" alt="" width="100" height="100">
                    <p>cut you off</p>
                    <p>CHINCHILLA</p>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>