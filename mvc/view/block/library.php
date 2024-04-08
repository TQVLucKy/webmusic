<head>
    <link rel="stylesheet" type="text/css" href="../public/css/library.css">
    <script type="text/javascript" src="../public/js/library.js"></script>
</head>
<div class="container-fluid library col-md-2 pt-1">
    <div class="title d-flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book-fill " viewBox="0 0 16 16">
            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
        </svg>
        <h2>Thư Viện</h2>
        <button class="material-icons" onclick="Show()">add</button>
    </div>
    <div class="listmusic">
        <?php
        foreach ($data["Lib"] as $print) {
            echo '<div class="itemslist">';
            echo $print['NameList'];
            echo '</div>';
        }
        ?>
    </div>
</div>
<div id="create" style="display: none;">
    <button id="AddMusic" onclick="AddMusic()">thêm nhạc</button><br>
    <button id="AddList" onclick="AddList()">thêm danh sách</button>
</div>
<form class="addmusic" id="showcreate" style="display:none;" class="container-fluid" action="main.php" method="post" enctype="multipart/form-data">
    <label for="music">Chọn nhạc:</label>
    <input type="file" name="music"></br>
    <label for="image">Chọn hình ảnh:</label>
    <input type="file" name="image"></br>
    <label for="artist">Tên ca sĩ:</label>
    <input type="text" name="artist">
    <input type="submit" name="submitmusic" value="Tải lên">
</form>
<form class="addlist" id="showList" style="display:none;" class="container-fluid" action="main.php" method="post" enctype="multipart/form-data">
    <label for="namelist">Tên danh sách:</label>
    <input type="text" name="namelist">
    <input type="submit" name="submitlist" value="Tạo">
</form>