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
    
}
$sql = "select * from storemusic";
$results = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Main music</title>
</head>

<body>
    <div class="container-fluid">
        <div class="container-fluid header border-0 bg-dark">
            <div class="header-title">
                <a class="h1" href="./main.php">Music</a>
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
        <form class="container-fluid" action="main.php" method="post" enctype="multipart/form-data">
            <label for="image">Chọn hình ảnh:</label>
            <input type="file" name="image">
            <input type="text" name="artist">
            <input type="submit" name="submit" value="Tải lên">
        </form>
        <div class="container-fluid main row">
            <div class="container-fluid library d-flex col-md-2 pt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book-fill " viewBox="0 0 16 16">
                    <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
                <h2>Thư Viện</h2>
                <i class="material-icons">add</i>
            </div>
            <div class="list col-md-10">
                <div class="top d-flex justify-content-between mt-2">
                    <h2>Danh sách phát</h2>
                    <p class="text-secondary">Hiện tất cả</p>
                </div>
                <div class="list-music row">
                    <?php
                    foreach ($results as $result) {
                        echo '<div class="items col-2 mb-3 mx-3">';
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
    </div>
</body>

</html>