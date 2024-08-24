<link rel="stylesheet" type="text/css" href="../public/css/List.scss">

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
                        echo '<button id="playFirstMusic" onclick="playMusic(this)" data-idMusic="' .htmlspecialchars($print['IdMusic']) . '">Play</button>';
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
<script type="text/javascript" src="../public/js/List.js"></script>
