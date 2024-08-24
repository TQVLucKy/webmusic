<head>
    <link rel="stylesheet" type="text/css" href="../public/css/library.css">
</head>

<div class="container-fluid library col-md-2 pt-1">
    <div class="title d-flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book-fill " viewBox="0 0 16 16">
            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
        </svg>
        <?php if (isset($_SESSION['userid'])) {
            if ($_SESSION['userid'] == 1)
                echo "<h2>Album</h2>";
            else echo "<h2>Thư viện</h2>";
        } else echo "<h2>Thư viện</h2>";
        ?>
        <button class="material-icons"
            <?php if (isset($_SESSION["loginedin"])) echo 'onclick="Show()"';
            else echo 'onclick="showLogin()"' ?>>add</button>
        <div id="create" style="display: none;">
            <?php if ($_SESSION['userid'] == 1): ?>
                <button class="musicBtn" id="addMusic" onclick="addMusic()">Thêm bài nhạc</button><br>
                <button class="musicBtn" id="delMusic" onclick="delMusic()">Xóa bài nhạc</button><br>
                <button class="musicBtn" id="addAlbum" onclick="addAlbum()">Thêm album</button><br>
                <button class="musicBtn" id="addList" onclick="addList()">Thêm danh sách</button><br>
                <button class="musicBtn" id="addArtist" onclick="addArtist()">Thêm ca sĩ</button>
            <?php else: ?>
                <button class="musicBtn" id="addList" onclick="addList()">Thêm danh sách</button><br>
            <?php endif; ?>
        </div>

    </div>
    <div class="listmusic">
        <?php
        if (isset($_SESSION["loginedin"])) {
            if (!empty($data["Lib"])) {
                foreach ($data["Lib"] as $print) {
                    echo '<div class="items-list">';
                    echo '<a href="./List?id=' . $print['Id'] . '">' . $print['Name'] . '</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>Hãy tạo danh sách phát đầu tiên của bạn!</p>";
            }
        } else
            echo "<p>Hãy thêm danh sách phát cho chính mình!</p>";
        ?>
    </div>
    <!-- <div class="title d-flex">
        <svg xmlns="http://www.w3.org/2000Z/svg" width="25" height="25" fill="currentColor" class="bi bi-book-fill " viewBox="0 0 16 16">
            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
        </svg>
        <h2>Album</h2>
        <button class="material-icons" onclick="Show()">add</button>
    </div>
    <div class="list-album">
        <?php
        foreach ($data["Album"] as $print) {
            echo '<div class="items-list">';
            echo '<a href="./List?id=' . $print['IdAlbum'] . '">' . $print['NameAlbum'] . '</a>';
            echo '</div>';
        }
        ?>
    </div> -->
</div>

<!-- show create music -->
<div class="musicForm add-music" id="showCreate" style="display:none;" >
    <h2 class="text-center">Tải bài hát lên</h2>
    <form method="post" id="addMusicToDB" enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class="input-group">
            <label for="musicName">Tên bài hát:</label><br>
            <input type="text" name="musicName" placeholder="Nhập tên bài hát" required><br>
        </div>
        <div class="input-group">
            <label for="music">Chọn nhạc:</label><br>
            <input type="file" name="music" id="musicAddMusic"><br>
        </div>
        <div class="input-group">
            <label for="image">Chọn hình ảnh:</label><br>
            <input type="file" name="image" id="imageAddMusic"><br>
        </div>
        <div class="input-group">
            <label for="category">Thể loại:</label><br>
            <input type="text" name="category" placeholder="Nhập thể loại"required><br>
        </div>
        <button type="button" id="addArtistButton">Thêm ca sĩ</button><br>
        <div id="artistContainer">
            <div class="input-group">
                <label for="artist">Tên ca sĩ:</label><br>
                <input type="text" name="artist[]" placeholder="Nhập tên ca sĩ" required><br>
            </div>
        </div>
        <input type="submit" class="login-button" name="submitMusic" value="tải lên"></input>
    </form>
</div>
<!-- show list -->
<form class="musicForm add-list" id="showList" style="display:none;" method="get" >
    <h2 class="text-center">Thêm danh sách</h2>
    <div class="input-group">
        <label for="nameList">Tên danh sách:</label>
        <input type="text" name="nameList" required>
    </div>
    <input type="submit" name="submitList" value="Tạo">
</form>

<!-- show album -->
<form class="musicForm add-album" id="showAlbum" style="display:none;" method="get">
    <h2 class="text-center">Thêm album</h2>
    <div class="input-group">
        <label for="nameAlbum">Tên Album:</label>
        <input type="text" name="nameAlbum" required>
    </div>
    <input type="submit" name="submitAlbum" value="Tạo">
</form>

<!-- show add artist -->
<form class="musicForm add-artist" id="showAddArtist" style="display: none;" method="Post">
    <h2 class="text-center">Thêm ca sĩ</h2>
    <div class="input-group">
        <label for="nameArtist">Tên ca sĩ:</label></br>
        <input type="text" name="nameArtist" required></br>
    </div>
    <div class="input-group">
        <label for="imageArtist">Chọn ảnh đại diện:</label></br>
        <input type="file" name="imageArtist"></br>
    </div>
    <input type="submit" name="submitAddArtist" value="Thêm">
</form>


<div id="overlay"></div>
<script type="text/javascript" src="../public/js/library.js"></script>