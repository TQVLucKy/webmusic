<link rel="stylesheet" type="text/css" href="../public/css/List.css">
<script type="text/javascript" src="../public/js/List.js"></script>
<!-- STT         Name        Artist      play        remove -->

<div id="list">
    <!-- danh sách phát -->
    <div class="header-list">
        <h1>Danh sách <?php foreach ($data["Lib"] as $print) {
                            if ($print['IdList'] == $_GET['id']) {
                                echo $print['NameList'];
                                break;
                            }
                        } ?></h1>
        <div>
            <button id="buttonToAddList1">Thêm nhạc vào danh sách</button>
            <button onclick="delDanhSachPhat()">Xóa danh sách</button>
        </div>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="Search...">
        <div class="result"></div>
        <button onclick="playMusicFromList()">Phát tất cả</button>

    </div>
    <div class="list-library">
        <table id="song-list">
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
                echo htmlspecialchars($print['NameMusic']);
                echo '</td><td>';
                echo htmlspecialchars($print['NameArtist']);
                echo '</td><td>';
                echo htmlspecialchars($print['NameCategory']);
                echo '</tb><td>';
                if ($stt === 1) { 
                    echo '<button id="playFirstMusic" onclick="playMusic(this)" data-idMusic="' . $print['IdMusic'] . '">Play</button>';
                }
                else echo '<button  onclick="playMusic(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '" data-idArtist="' . htmlspecialchars($print['IdArtist']) . '" data-idCategory="' . htmlspecialchars($print['IdCategory']) . '">Play</button>';
                echo '<button onclick="deleteMusicFromDanhSachPhat(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '" data-idArtist="' . htmlspecialchars($print['IdArtist']) . '" data-idCategory="' . htmlspecialchars($print['IdCategory']) . '">Remove</button>';
                echo '</td></tr>';
                $stt++;
            }
            ?>
        </table>
    </div>

    <!-- album -->
    <!-- <div class="header-list">
        <h1>Danh sách <?php foreach ($data["Album"] as $print) {
                            if ($print['IdAlbum'] == $_GET['id']) {
                                echo $print['NameAlbum'];
                                break;
                            }
                        } ?></h1>
        <div>
            <button id="buttonToAddAlbum1">Thêm nhạc vào album</button>
            <button onclick="delAlbum()">Xóa album</button>
        </div>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="search...">
    </div>
    <div class="list-library">
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
            foreach ($data["getalbum"] as $print) {
                echo '<tr><td>';
                echo $stt;
                echo '</td><td>';
                echo $print['NameMusic'];
                echo '</td><td>';
                echo $print['NameArtist'];
                echo '</td><td>';
                echo $print['NameCategory'];
                echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Play</button>';
                echo '<button onclick=DeleteMusicFromAlbum(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Remove</button></td>';
                echo '</tr>';
                $stt++;
            }
            ?>
        </table>
    </div> -->
</div>

<!-- phát nhạc theo danh sách
    ý tưởng: 
    - Khi nhấn vào nút phát tất cả sẽ nhảy sang trang Play. với id: bài hát hiện tại, idList: danh sách phát
    - Nếu thế thì phải chỉnh sửa lại trong Play. Khi nào có idList ở play thì lấy giá trị đó và gọi theo ds đó.
    -->
<!-- danh sách phát -->
<div id="addmusictoDanhSachPhat" style="display:none;">
    <div class="header-list">
        <h1>Danh sách các bài nhạc</h1>
        <button id="buttonToAddList2">Trở lại danh sách phát</button>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="search...">
        <div class="result"></div>
    </div>
    <div class="list-library">
        <table id="song-all">
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
                echo htmlspecialchars($print['NameMusic']);
                echo '</td><td>';
                echo htmlspecialchars($print['NameArtist']);
                echo '</td><td>';
                echo htmlspecialchars($print['NameCategory']);
                echo '</tb><td>';
                echo '<button onclick="playMusic(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '">Play</button>';
                echo '<button onclick="addMusicToDanhSachPhat(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '">Add</button>';
                echo '</td></tr>';
                $stt++;
            }
            ?>
        </table>
    </div>
</div>

<!-- album -->
<!-- <div id="addMusicToAlbum" style="display:none;">
    <div class="header-list">
        <h1>Danh sách các bài nhạc</h1>
        <button id="buttonToAddAlbum2">Trở lại album</button>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="Search...">
    </div>
    <div class="list-library">
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
                echo '</tb><td><button onclick=playMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Play</button>';
                echo '<button onclick=addMusicToAlbum(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Add</button></td>';
                echo '</tr>';
                $stt++;
            }
            ?>
        </table>
    </div>
</div> -->
<script>
    $(document).ready(function() {
        var idList = "<?php echo $_GET['id']; ?>";
        var originalContent = $("#song-list").html(); //Lưu nội dung ban đầu của danh sách
        $('.search input[type="text"]').on("keyup input", function() {
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("../search/ListSearch.php", {
                    term: inputVal,
                    idList: idList
                }).done(function(data) {
                    // Display the returned data in browser
                    $("#song-list").find("tr:gt(0)").remove();
                    $("#song-list").append(data);
                });
            } else {
                $("#song-list").html(originalContent);
            }
        });

    });

    $(document).ready(function() {
        var idList = "<?php echo $_GET['id']; ?>";
        var originalContent = $("#song-all").html(); //Lưu nội dung ban đầu của danh sách
        $('.search input[type="text"]').on("keyup input", function() {
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("../search/SearchAll.php", {
                    term: inputVal,
                    idList: idList
                }).done(function(data) {
                    // Display the returned data in browser
                    $("#song-all").find("tr:gt(0)").remove();
                    $("#song-all").append(data);
                });
            } else {
                $("#song-all").html(originalContent);
            }
        });

    });

    // var playMusic = document.querySelectorAll('.itemsList .playMusic');
    // playMusic.forEach(function(item) {
    //     item.addEventListener('click', function() {
    //         var id = this.getAttribute('data-id');
    //         window.location.href = './Play?id=' + id;
    //     })
    // })
    function playMusicFromList(){
        var idFirstMusic= document.getElementById('playFirstMusic').getAttribute('data-idMusic');
        window.location.href= './Play?id='+ idFirstMusic + '&idList='+<?php echo $_GET['id']; ?>;
    }
    
    function playMusic(button) {
        var idMusic = button.getAttribute('data-idMusic');
        window.location.href = './Play?id=' + idMusic;
    }

    function delDanhSachPhat() {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "delDanhSachPhat",
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert("Xóa danh sách phát thành công");
                window.location.href = './';
            }
        })
    }
    //Thêm nhạc vào danh sách phát
    function addMusicToDanhSachPhat(button) {

        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "addMusicToDanhSachPhat",
                idMusic: button.getAttribute('data-idMusic'),
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert("Thêm thành công");
            }
        })
    }
    //Thêm nhạc vào album
    function addMusicToAlbum(button) {

        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "addMusicToAlbum",
                idMusic: button.getAttribute('data-idMusic'),
                idAlbum: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert(response);
                alert("Thêm thành công");
            }
        })
    }
    // Xóa nhạc ở danh sách phát
    function deleteMusicFromDanhSachPhat(button) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "deleteMusicFromDanhSachPhat",
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
    // Xóa nhạc ở album
    function deleteMusicFromAlbum(button) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "deleteMusicFromAlbum",
                idMusic: button.getAttribute('data-idMusic'),
                idAlbum: <?php echo $_GET['id']; ?>
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
    //danh sách phát
    document.querySelector('#buttonToAddList1').addEventListener("click", () => {
        document.getElementById('list').style.display = 'none';
        document.getElementById('addmusictoDanhSachPhat').style.display = 'block';
    })
    document.querySelector('#buttonToAddList2').addEventListener("click", () => {
        document.getElementById('list').style.display = 'block';
        document.getElementById('addmusictoDanhSachPhat').style.display = 'none';
        window.location.reload();
    })

    //album
    // document.querySelector('#buttonToAddAlbum1').addEventListener("click", () => {
    //     document.getElementById('list').style.display = 'none';
    //     document.getElementById('addMusicToAlbum').style.display = 'block';
    // })
    // document.querySelector('#buttonToAddAlbum2').addEventListener("click", () => {
    //     document.getElementById('list').style.display = 'block';
    //     document.getElementById('addMusicToAlbum').style.display = 'none';
    //     window.location.reload();
    // })
</script>