<link rel="stylesheet" type="text/css" href="../public/css/playmusic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- <script type="text/javascript" src="../public/js/playmusic.js"></script> -->
<script type="text/javascript" src="../public/js/playmusic.js"></script>



<div class="playmusic">
    <div class="music">
        <div class="container">
            <div class="box-disk">
            </div>
            <div class="title">
                <span class="current-time">00:00</span>
                <span class="music-time">00:00</span>
                <input type="range" value="0" class="seek-bar" />
                <span class="current-music">tên bài</span>
                <span class="current-artist">ca sĩ</span>
                <span class="current-view">view</span>
                <div class="controls">
                    <div class="btn-control">
                        <button class="btn btn-random"><i class="fa-solid fa-shuffle"></i></button>
                        <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn-play pause">
                            <span></span>
                            <span></span>
                        </button>
                        <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
                        <div class="volume-container">
                            <button class="volume-button"><i class="fa-solid fa-volume-high volume-icon" style="color: #ffffff;"></i></button>
                            <input type="range" class="volume-slider" min="0" max="100" value="50">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="contact">
        <?php
        $favorites = array_combine(array_column($data["g"], 'id'), array_column($data["g"], 'favorite'));
        echo "<button id='favorite' data-favorite='" . $favorites[$_GET['id']] . "'class='" . ($favorites[$_GET['id']] == 1 ? "btn favorited" : "btn favorite") . "'";
        echo " onclick=updateFavorite()>";
        echo "<i class='fa fa-heart'></i></button>";
        ?>
        <button class="material-icons" <?php if (isset($_SESSION['loginedin'])) {
                                            if (!empty($data["Lib"])) echo "onclick=showLibrary()";
                                            else echo 'onclick="addList()"';
                                        } else echo 'onclick="showLogin()"'; ?>>add</button>
        <div id="list" style="display: none;">
            <?php
            foreach ($data["Lib"] as $print) {
                echo '<div class="items-list" id="idList" onclick="addToLibrary(' . $print['Id'] . ')">';
                echo $print['Name'];
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <!-- add song to library -->

    <!-- mini music -->
    <audio src="" id="audio"></audio>
    <div class="music-slider" id="music-slider" style="display: none;">
        <span class="current-time">00:00</span>
        <span class="music-time">00:00</span>
        <input type="range" value="0" class="seek-bar" />
        <span class="current-music">tên bài</span>
        <span class="current-artist">ca sĩ</span>
        <div class="controls-mini">
            <div class="btn-control">
                <button class="btn btn-random"><i class="fa-solid fa-shuffle"></i></button>
                <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
                <button class="btn-play pause">
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
                <div class="volume-container">
                    <button class="volume-button"><i class="fa-solid fa-volume-high volume-icon" style="color: #ffffff;"></i></button>
                    <input type="range" class="volume-slider" min="0" max="100" value="50" orient="vertical">
                </div>
            </div>
        </div>
    </div>


    <div class="artists">
        <div id="artistList"></div>
    </div>
    <div class="recommendation">
        <h2>Recommended</h2>
        <div id="recommendations"></div>
        <script src="../public/js/playmusic.js"></script>
    </div>
    <div class="popular-music-artist">
    </div>
</div>
<?php
$jsonData = json_encode($data["g"]);
?>
<script>
    window.songs = <?php echo $jsonData ?>;
</script>