<?php
include 'C:\xampp\htdocs\webmusic\mvc\model\UserModel.php';


if (isset($_GET['action'])) {
    $favoriteModel = new MusicModel();
    $action = trim($_GET['action']);
    if ($action == "updateFavorite") {
        $favoriteModel->updateFavorite($_GET["id"]);
    }
}
if (isset($_GET['action'])) {
    $musicModel =  new MusicModel();
    $action = trim($_GET['action']);
    if ($action == "addMusicToLibrary") {
        $musicModel->addMusicToLibrary($_GET["idList"], $_GET["idMusic"]);
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
        $_SESSION['userid'] = $result;
    } else  echo false;
}

if (isset($_GET["logout"])) {
    session_unset();
}

if (isset($_POST['submitChangePassword'])) {
    $controler = new UserModel();
    $controler->ChangePassword($_POST['userName'], $_POST['passOld'], $_POST['passNew1'], $_POST['passNew2']);
}
// need fix: it not work t think isset($_POST['submitmusic']) complete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitMusic'])) {
    $controller = new Home();
    $controller->uploadMusic($_FILES);
}

// điều hướng vào model xử lý
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitAddArtist'])) {
    $controller = new MusicModel();
    $controller->addArtist($_POST['nameArtist'], $_FILES['imageArtist']);
}
// Hàm xử lý form

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submitList'])) {
    // Khởi tạo controller và gọi hàm xử lý 
    $controller = new Home();
    $controller->createList($_GET['nameList']);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submitAlbum'])) {
    // Khởi tạo controller và gọi hàm xử lý 
    $controller = new MusicModel();
    $controller->AddAlbum($_GET['nameAlbum']);
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
    echo json_encode($musicList, JSON_UNESCAPED_UNICODE);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === "delDanhSachPhat") {
        $controller = new MusicModel();
        $controller->delDanhSachPhat($_POST['idList']);
    }
}
//Thêm nhạc vào danh sách phát
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "addMusicToDanhSachPhat") {
        $controller = new MusicModel();
        $controller->AddMusicToLibrary($_POST["idList"], $_POST["idMusic"]);
    }
}
// Xóa nhạc khỏi danh sách phát
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "deleteMusicFromDanhSachPhat") {
        $controller = new MusicModel();
        $controller->deleteMusicFromLibrary($_POST["idList"], $_POST["idMusic"]);
    }
}
//Thêm nhạc vào album
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "addMusicToAlbum") {
        $controller = new MusicModel();
        $controller->addMusicToAlbum($_POST["idAlbum"], $_POST["idMusic"]);
    }
}
// Xóa nhạc khỏi album
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == "deleteMusicFromAlbum") {
        $controller = new MusicModel();
        $controller->deleteMusicFromAlbum($_POST["idAlbum"], $_POST["idMusic"]);
    }
}

//
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["action"])) {
    if ($_GET['action'] == "getRecommendations") {
        $controler = new MusicModel();
        $recommendations = $controler->getRecommendations($_GET["user_id"], $_GET["song_id"]);
        echo json_encode($recommendations, JSON_UNESCAPED_UNICODE);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["action"])) {
    if ($_GET['action'] == "getRecommendedByArtist") {
        $controler = new MusicModel();
        $idArtist = $controler->getArtist($_GET["song_id"]);

        if ($idArtist !== null && !empty($idArtist)) {
            $recommendedByArtist = $controler->getRecommendedByArtist($idArtist['IdArtists'], $_GET["song_id"]);
            echo json_encode($recommendedByArtist, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([], JSON_UNESCAPED_UNICODE); // Trả về mảng rỗng nếu không tìm thấy nghệ sĩ
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["action"])) {
    if ($_GET['action'] == "getArtists") {
        $controler = new MusicModel();
        $getArtists = $controler->getArtists($_GET["song_id"]);
        echo json_encode($getArtists, JSON_UNESCAPED_UNICODE);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["action"])) {
    if ($_GET['action'] == "getArtistAll") {
        $controler = new MusicModel();
        $artistAll = $controler->getArtistAll($_GET["idArtist"]);
        echo json_encode($artistAll, JSON_UNESCAPED_UNICODE);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["action"])) {
    if ($_GET["action"] == "Play") {
        $controler = new MusicModel();
        if (!isset($_GET['idList']))
            $songs = $controler->getSongFromList($_GET['id']);
        else
            $songs = $controler->getSongFromList($_GET['id'], $_GET['idList']);
        echo json_encode($songs, JSON_UNESCAPED_UNICODE);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] == 'increaseViews') {
        $controler = new MusicModel();
        $controler->increaseViews($_GET['currentSongId']);
    }
}
