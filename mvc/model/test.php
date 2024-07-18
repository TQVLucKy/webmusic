<?php
include 'C:\xampp\htdocs\webmusic\mvc\model\UserModel.php';
if (isset($_GET['action'])) {
    $favoriteModel = new MusicModel();
    $action = trim($_GET['action']);
    if ($action == "UpdateFavorite") {
        $favoriteModel->UpdateFavorite($_GET["id"]);
    }
}
if (isset($_GET['action'])) {
    $musicModel =  new MusicModel();
    $action = trim($_GET['action']);
    if ($action == "AddMusicToLibrary") {
        $musicModel->AddMusicToLibrary($_GET["idList"], $_GET["idMusic"]);
    }
}

if (isset($_POST['submitLogin'])) {
    $userModel = new UserModel();
    $result = $userModel->checkUsername($_POST['name'], $_POST['password']);

    //sử dụng session để kiểm tra và trả về trang chủ.
    // unset($_SESSION);
    if ($result) {
        $_SESSION["loginedin"] = true;
        $_SESSION["username"] = $_POST['name'];
    } else  echo false;
}

if (isset($_GET["logout"])) {
    session_unset();
}

if(isset($_POST['submitChangePass'])){
    $controler= new UserModel();
    $controler->ChangePassword($_POST['userName'],$_POST['passOld'], $_POST['passNew1'], $_POST['passNew2']);
}
// need fix: it not work t think isset($_POST['submitmusic']) complete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitmusic'])) {
    // Khởi tạo controller và gọi hàm xử lý
    //print_r($_post['artist[]']);
    $controller = new Home();
    $controller->uploadMusic($_FILES);
}
// Hàm xử lý form

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submitlist'])) {
    // Khởi tạo controller và gọi hàm xử lý 
    $controller = new Home();
    $controller->createList($_GET['namelist']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'deleteMusic') {
        $controller = new MusicModel();
        $controller->DeleteMusic($_POST['idMusic'], $_POST['idArtist'], $_POST['idCategory']);
    }
}
//search theo val
if (isset($_GET['InputVal'])) {
    $musicModel =  new MusicModel();
    $musicList = $musicModel->SearchText($_GET["InputVal"]);
    $stt = 1;
    foreach ($musicList as $print) {
        echo '<div class="itemsList">';
        echo '<div class="itemList stt">';
        echo $stt;
        echo '</div>';
        echo '<div class="itemList name">';
        echo $print['name'];
        echo '</div>';
        echo '<div class="itemList artist">';
        echo $print['artist'];
        echo '</div>';
        echo '<div class="itemList playMusic" data-id="' . $print['id'] . '">';
        echo 'Play'; // Đặt nút Play ở đây
        echo '</div>';
        echo '<div class="itemList remove">';
        echo 'Remove'; // Đặt nút Remove ở đây
        echo '</div>';
        echo '</div>';
        $stt++;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === "DelDanhSachPhat") {
        $controller = new MusicModel();
        $controller->DelDanhSachPhat($_POST['idList']);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "AddMusicToDanhSachPhat") {
        $controller = new MusicModel();
        $controller->AddMusicToLibrary($_POST["idList"], $_POST["idMusic"]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "DeleteMusicFromDanhSachPhat") {
        $controller = new MusicModel();
        $controller->DeleteMusicFromLibrary($_POST["idList"], $_POST["idMusic"]);
    }
}