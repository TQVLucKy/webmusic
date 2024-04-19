<?php
include 'C:\xampp\htdocs\webmusic\mvc\model\FavoriteModel.php';

die("cc");
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

// if (isset($_POST['action'])) {
//     $musicModel =  new MusicModel();
//     $action = trim($_POST['action']);
//     if ($action == "AddMusic") {
//         $musicModel->AddMusic($_GET["idList"],$_GET["idMusic"]);
//     }
// }
