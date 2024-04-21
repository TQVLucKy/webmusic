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
            echo '<a href="./List?id='. $print['IdList'].'">'. $print['NameList'].'</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<div id="create" style="display: none;">
    <button id="AddMusic" onclick="AddMusic()">thêm nhạc</button><br>
    <button id="AddList" onclick="AddList()">thêm danh sách</button>
</div>
<form class="container-fluid addmusic" id="showcreate" style="display:none;" method="post" enctype="multipart/form-data">
    <label for="music">Chọn nhạc:</label>
    <input type="file" name="music"></br>
    <label for="image">Chọn hình ảnh:</label>
    <input type="file" name="image"></br>
    <label for="artist">Tên ca sĩ:</label>
    <input type="text" name="artist">
    <input type="submit" name="submitmusic" value="Tải lên">
</form>
<form class="container-fluid addlist" id="showList" style="display:none;" method="post" enctype="multipart/form-data">
    <label for="namelist">Tên danh sách:</label>
    <input type="text" name="namelist">
    <input type="submit" name="submitlist" value="Tạo">
</form>

<script>
    document.getElementById('showList').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn không cho form submit theo cách thông thường

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './model/test', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                console.log(this.responseText);
                // Xử lý kết quả trả về từ server ở đây
            }
        };

        xhr.send(new URLSearchParams(new FormData(this)).toString());
    });
    document.getElementById('showcreate').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn không cho form submit theo cách thông thường

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './model/test', true);
        xhr.setRequestHeader('X-Requested-With', 'application/x-www-form-urlencoded'); // Đặt header để xác định là AJAX request

        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                // Xử lý kết quả trả về từ server ở đây
            }
        };

        xhr.send(formData);
    });
</script>