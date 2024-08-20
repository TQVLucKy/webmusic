<link rel="stylesheet" type="text/css" href="../public/css/List.scss">
<!-- <script type="text/javascript" src="../public/js/List.js"></script> -->
<!-- STT         Name        Artist      play        remove -->
<div id="list">
    <?php if ($_SESSION['userid'] != 1): ?>

        <!-- danh sách phát -->
        <div class="header-list">
            <h1>Danh sách <?php foreach ($data["Lib"] as $print) {
                                if ($print['Id'] == $_GET['id']) {
                                    echo $print['Name'];
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
                    } else echo '<button  onclick="playMusic(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '">Play</button>';
                    echo '<button onclick="deleteMusicFromDanhSachPhat(this)" data-idMusic="' . htmlspecialchars($print['IdMusic']) . '">Remove</button>';
                    echo '</td></tr>';
                    $stt++;
                }
                ?>
            </table>
        </div>

        <!-- phát nhạc theo danh sách
         ý tưởng: 
        - Khi nhấn vào nút phát tất cả sẽ nhảy sang trang Play. với id: bài hát hiện tại, idList: danh sách phát
        - Nếu thế thì phải chỉnh sửa lại trong Play. Khi nào có idList ở play thì lấy giá trị đó và gọi theo ds đó.
        -->
    <?php else: ?>
        <!-- album -->
        <div class="header-list">
            <h1>Danh sách <?php foreach ($data["Album"] as $print) {
                                if ($print['Id'] == $_GET['id']) {
                                    echo $print['Name'];
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
            <div class="result"></div>
        </div>
        <div class="list-library">
            <table id="song-album">
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Nghệ sĩ</th>
                    <th>Thể loại</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                if (count($data["getalbum"]) > 0) {
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
                        echo '</tb><td><button onclick=playMusic(this) data-idMusic="' . $print['IdMusic'] . '" >Play</button>';
                        echo '<button onclick=deleteMusicFromAlbum(this) data-idMusic="' . $print['IdMusic'] . '">Remove</button></td>';
                        echo '</tr>';
                        $stt++;
                    }
                } else {
                    echo "hãy thêm những bài hát đầu tiên vào album";
                }
                ?>
            </table>
        </div>
    <?php endif; ?>
</div>
<!-- danh sách phát -->
<div id="addMusicToDanhSachPhat" style="display:none;">
    <div class="header-list">
        <h1>Danh sách các bài nhạc</h1>
        <button id="buttonToAddList2">Trở lại danh sách phát</button>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="search...">
        <div class="result"></div>
    </div>
    <div class="list-library">
        <table id="song-all-list">
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
<div id="addMusicToAlbum" style="display:none;">
    <div class="header-list">
        <h1>Danh sách các bài nhạc</h1>
        <button id="buttonToAddAlbum2">Trở lại album</button>
    </div>
    <div class="search">
        <input type="text" class="search-form" placeholder="Search...">
        <div class="result"></div>
    </div>
    <div class="list-library">
        <table id="song-all-album">
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
                echo '</tb><td><button onclick=playMusic(this) data-idMusic="' . $print['IdMusic'] . '">Play</button>';
                echo '<button onclick=addMusicToAlbum(this) data-idMusic="' . $print['IdMusic'] . '">Add</button></td>';
                echo '</tr>';
                $stt++;
            }
            ?>
        </table>
    </div>
</div>

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
        var originalContent = $("#song-album").html(); //Lưu nội dung ban đầu của danh sách
        $('.search input[type="text"]').on("keyup input", function() {
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("../search/ListSearch.php", {
                    term: inputVal,
                    idList: idList
                }).done(function(data) {
                    // Display the returned data in browser
                    $("#song-album").find("tr:gt(0)").remove();
                    $("#song-album").append(data);
                });
            } else {
                $("#song-album").html(originalContent);
            }
        });

    });

    $(document).ready(function() {
        var idList = "<?php echo $_GET['id']; ?>";
        var originalContent = $("#song-all-list").html(); //Lưu nội dung ban đầu của danh sách
        $('.search input[type="text"]').on("keyup input", function() {
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("../search/SearchAll.php", {
                    term: inputVal,
                    idList: idList
                }).done(function(data) {
                    // Display the returned data in browser
                    $("#song-all-list").find("tr:gt(0)").remove();
                    $("#song-all-list").append(data);
                });
            } else {
                $("#song-all-list").html(originalContent);
            }
        });

    });

    $(document).ready(function() {
        var idList = "<?php echo $_GET['id']; ?>";
        var originalContent = $("#song-all-album").html(); //Lưu nội dung ban đầu của danh sách
        $('.search input[type="text"]').on("keyup input", function() {
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("../search/SearchAll.php", {
                    term: inputVal,
                    idList: idList
                }).done(function(data) {
                    // Display the returned data in browser
                    $("#song-all-album").find("tr:gt(0)").remove();
                    $("#song-all-album").append(data);
                });
            } else {
                $("#song-all-album").html(originalContent);
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
    function playMusicFromList() {
        var idFirstMusic = document.getElementById('playFirstMusic').getAttribute('data-idMusic');
        window.location.href = './Play?id=' + idFirstMusic + '&idList=' + <?php echo $_GET['id']; ?>;
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

    function delAlbum() {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "delAlbum",
                idList: <?php echo $_GET['id']; ?>
            },
            success: function(response) {
                alert("Xóa album thành công");
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
    //danh sách phát


    //album
    document.addEventListener("DOMContentLoaded", () => {
        if (<?php echo $_SESSION['userid']; ?> != 1) {
            document.querySelector('#buttonToAddList1').addEventListener("click", () => {
                document.getElementById('list').style.display = 'none';
                document.getElementById('addMusicToDanhSachPhat').style.display = 'block';
            });
            document.querySelector('#buttonToAddList2').addEventListener("click", () => {
                document.getElementById('list').style.display = 'block';
                document.getElementById('addMusicToDanhSachPhat').style.display = 'none';
                window.location.reload();
            });
        } else {
            document.querySelector('#buttonToAddAlbum1').addEventListener("click", () => {
                document.getElementById('list').style.display = 'none';
                document.getElementById('addMusicToAlbum').style.display = 'block';
            });
            document.querySelector('#buttonToAddAlbum2').addEventListener("click", () => {
                document.getElementById('list').style.display = 'block';
                document.getElementById('addMusicToAlbum').style.display = 'none';
                window.location.reload();
            });
        }
    });
</script>