<link rel="stylesheet" type="text/css" href="../public/css/List.css">
<script type="text/javascript" src="../public/js/List.js"></script>
<!-- STT         Name        Artist      play        remove -->

<div id="list">
    <div class="HeaderList">
        <h1>Danh sách <?php foreach ($data["Lib"] as $print) {
                            if ($print['IdList'] == $_GET['id']) {
                                echo $print['NameList'];
                                break;
                            }
                        } ?></h1>
        <div>
            <button id="buttonToAdd1">Thêm nhạc vào danh sách</button>
            <button onclick="DelDanhSachPhat()">Xóa danh sách</button>
        </div>
    </div>
    <div class="Search">
        <input type="text" class="Search-form" placeholder="Search...">
    </div>
    <div class="ListLibrary">
        <table>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Nghệ sĩ</th>
                <th>Thể loại</th>
                <th>Thao tác</th>
            </tr>
            <?php
            $stt = 1;
            foreach ($data["getlist"] as $print) {
                echo '<tr><td>';
                echo $stt;
                echo '</td><td>';
                echo $print['NameMusic'];
                echo '</td><td>';
                echo $print['NameArtist'];
                echo '</td><td>';
                echo $print['NameCategory'];
                echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Play</button>';
                echo '<button onclick=DeleteMusicFromDanhSachPhat(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Remove</button></td>';
                echo '</tr>';
                $stt++;
            }
            ?>
        </table>
    </div>
</div>
<div id="addmusictoDanhSachPhat" style="display:none;">
    <div class="HeaderList">
        <h1>Danh sách các bài nhạc</h1>
        <button id="buttonToAdd2">Trở lại danh sách phát</button>
    </div>
    <div class="Search">
        <input type="text" class="Search-form" placeholder="Search...">
    </div>
    <div class="ListLibrary">
        <table>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Nghệ sĩ</th>
                <th>Thể loại</th>
                <th>Thao tác</th>
            </tr>
            <?php
            $stt = 1;
            foreach ($data["MS"] as $print) {
                echo '<tr><td>';
                echo $stt;
                echo '</td><td>';
                echo $print['NameMusic'];
                echo '</td><td>';
                echo $print['NameArtist'];
                echo '</td><td>';
                echo $print['NameCategory'];
                echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Play</button>';
                echo '<button onclick=AddMusicToDanhSachPhat(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Add</button></td>';
                echo '</tr>';
                $stt++;
            }
            ?>
        </table>
    </div>
</div>
<script>
    // var playMusic = document.querySelectorAll('.itemsList .playMusic');
    // playMusic.forEach(function(item) {
    //     item.addEventListener('click', function() {
    //         var id = this.getAttribute('data-id');
    //         window.location.href = './Play?id=' + id;
    //     })
    // })
    function PlayMusic(button) {
        var idMusic = button.getAttribute('data-idMusic');
        window.location.href = './Play?id=' + idMusic;
    }

    function DelDanhSachPhat() {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "DelDanhSachPhat",
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert("Xóa danh sách phát thành công");
                window.location.href = './';
            }
        })
    }
    //Thêm nhạc vào danh sách phát
    function AddMusicToDanhSachPhat(button) {

        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "AddMusicToDanhSachPhat",
                idMusic: button.getAttribute('data-idMusic'),
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert("Thêm thành công");
            }
        })
    }
    // Xóa nhạc ở danh sách phát
    function DeleteMusicFromDanhSachPhat(button) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "DeleteMusicFromDanhSachPhat",
                idMusic: button.getAttribute('data-idMusic'),
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert(response);
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        })
    }
    //Mai làm thêm nhạc vào danh sách phát và xóa nhạc trong danh sách phát.
    // Chuyển qua lại giữa 2 bảng danh sách và thêm.
    document.querySelector('#buttonToAdd1').addEventListener("click", () => {
        document.getElementById('list').style.display = 'none';
        document.getElementById('addmusictoDanhSachPhat').style.display = 'block';
    })
    document.querySelector('#buttonToAdd2').addEventListener("click", () => {
        document.getElementById('list').style.display = 'block';
        document.getElementById('addmusictoDanhSachPhat').style.display = 'none';
        window.location.reload();
    })
</script>