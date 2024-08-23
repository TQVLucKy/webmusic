<?php
include 'C:\xampp\htdocs\webmusic\mvc\model\UserModel.php';
// include 'C:\xampp\htdocs\webmusic\mvc\model\MusicModel.php';

$musicModel = new MusicModel();
$userModel = new UserModel();
//  GET 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = trim($_GET['action']);
    switch ($action) {
        case "getAll":
            echo json_encode($data["g"]);
            break;
        case "updateFavorite":
            $musicModel->updateFavorite($_GET["id"]);
            break;
        case "addMusicToLibrary":
            $musicModel->addMusicToLibrary($_GET["idList"], $_GET["idMusic"]);
            break;
        case "getRecommendations":
            $recommendations = $musicModel->getRecommendations($_GET["song_id"]);
            echo json_encode($recommendations, JSON_UNESCAPED_UNICODE);
            break;
        case "getRecommendedByArtist":
            $idArtist = $musicModel->getArtist($_GET["song_id"]);
            $recommendedByArtist = $idArtist ? $musicModel->getRecommendedByArtist($idArtist['IdArtists'], $_GET["song_id"]) : [];
            echo json_encode($recommendedByArtist, JSON_UNESCAPED_UNICODE);
            break;
        case "getArtists":
            $getArtists = $musicModel->getArtists($_GET["song_id"]);
            echo json_encode($getArtists, JSON_UNESCAPED_UNICODE);
            break;
        case "getArtistAll":
            $artistAll = $musicModel->getArtistAll($_GET["idArtist"]);
            echo json_encode($artistAll, JSON_UNESCAPED_UNICODE);
            break;
        case "getAlbumhHasArtist":
            $albumHasArtist = $musicModel->getAlbumhHasArtist($_GET["idArtist"]);
            echo json_encode($albumHasArtist, JSON_UNESCAPED_UNICODE);
            break;
        case "albumOrList":
            $userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
            echo json_encode(['userId' => $userId]);
            break;
        case "Play":
            $songs = isset($_GET['idList'])
                ? $musicModel->getSongFromList($_GET['id'], $_GET['idList'])
                : $musicModel->getSongFromList($_GET['id']);
            echo json_encode($songs, JSON_UNESCAPED_UNICODE);
            break;
        case 'increaseViews':
            $musicModel->increaseViews($_GET['currentSongId']);
            break;
    }
}

//  POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitLogin'])) {
        $result = $userModel->checkUsername($_POST['name'], $_POST['password']);
        if ($result !== false) {
            $_SESSION["loginedin"] = true;
            $_SESSION["username"] = $_POST['name'];
            $_SESSION['userid'] = $result;
        } else {
            echo "Tên đăng nhập hoặc mật khẩu không đúng";
        }
    } elseif (isset($_POST['submitSignUp'])) {
        $userModel->signUp($_POST['name'], $_POST['password']);
    } elseif (isset($_POST['submitChangePassword'])) {
        $userName = isset($_SESSION["username"]) ? $_SESSION["username"] : -1;
        $userModel->ChangePassword($userName, $_POST['passOld'], $_POST['passNew1'], $_POST['passNew2']);
    } elseif (isset($_POST['submitMusic'])) {
        $musicModel->saveMusic($_POST['musicName'], $_FILES['music'], $_FILES['image'], $_POST['artist'], $_POST['category']);
    } elseif (isset($_POST['submitAddArtist'])) {
        $musicModel->addArtist($_POST['nameArtist'], $_FILES['imageArtist']);
    } elseif (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'deleteMusic':
                $musicModel->DeleteMusic($_POST['idMusic'], $_POST['idArtist'], $_POST['idCategory']);
                break;
            case 'delDanhSachPhat':
                $musicModel->delDanhSachPhat($_POST['idList']);
                break;
            case 'delAlbum':
                $musicModel->DelAlbum($_POST['idList']);
                break;
            case 'addMusicToDanhSachPhat':
                $musicModel->AddMusicToLibrary($_POST["idList"], $_POST["idMusic"]);
                break;
            case 'deleteMusicFromDanhSachPhat':
                $musicModel->deleteMusicFromLibrary($_POST["idList"], $_POST["idMusic"]);
                break;
            case 'addMusicToAlbum':
                $musicModel->addMusicToAlbum($_POST["idAlbum"], $_POST["idMusic"]);
                break;
            case 'deleteMusicFromAlbum':
                $musicModel->deleteMusicFromAlbum($_POST["idAlbum"], $_POST["idMusic"]);
                break;
        }
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action']) && $data['action'] == "randomsong") {
        $musicModel->getRandomMusic($data["IdMusic"]);
    }
}

//  logout
if (isset($_GET["logout"])) {
    session_unset();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['submitList'])) {
        $musicModel->addList($_GET['nameList']);
    } elseif (isset($_GET['submitAlbum'])) {
        $musicModel->AddAlbum($_GET['nameAlbum']);
    }
}

// search 
if (isset($_GET['InputVal'])) {
    $musicList = $musicModel->SearchText($_GET["InputVal"]);
    echo json_encode($musicList, JSON_UNESCAPED_UNICODE);
}
