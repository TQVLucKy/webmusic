<?php
require 'C:\xampp\htdocs\webmusic\mvc\model\FavoriteModel.php';

if (isset($_GET['action'])) {
    $favoriteModel = new test();
    $action = trim($_GET['action']);
    if($action == "UpdateFavorite"){
        $favoriteModel->UpdateFavorite($_GET["id"]);
    }
    
}
?>