<?php
include 'C:\xampp\htdocs\webmusic\mvc\model\FavoriteModel.php';

if (isset($_GET['action'])) {
    $favoriteModel = new test();
    $action = trim($_GET['action']);
    if ($action == "UpdateFavorite") {
        $favoriteModel->UpdateFavorite($_GET["id"]);
    }
}
if (isset($_GET['action'])) {
    $musicModel =  new MusicModel();
    $action = trim($_GET['action']);
    if ($action == "AddMusicToLibrary") {
        $musicModel->AddMusicToLibrary($_GET["idList"],$_GET["idMusic"]);
    }
}

    // Khởi tạo controller và gọi hàm xử lý
    $controller = new Home();
    $controller->uploadMusic($_FILES, $_POST['artist']);
// test.php
// Hàm xử lý form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitlist'])) {
    // Khởi tạo controller và gọi hàm xử lý 

    $controller = new Home();
    $controller->createList($_POST['namelist']);
}


?>