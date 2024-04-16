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
        $result=$musicModel->AddMusicToLibrary($_GET["idList"],$_GET["idMusic"]);
        if ($result) {
            echo "Thêm âm nhạc vào thư viện thành công!";
        } else {
            echo "Thêm âm nhạc vào thư viện thất bại!";
        }
    }
}
