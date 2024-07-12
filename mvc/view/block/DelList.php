<link rel="stylesheet" type="text/css" href="../public/css/DelList.scss">
<script type="text/javascript" src="../public/js/DelList.js"></script>

<h1>Danh sách tất cả bài nhạc</h1>
<!-- <div class="ListMusic">
    <div class="itemsList">
        <div class="iTemList STT">STT</div>
        <div class="iTemList NameMusic">Tên</div>
        <div class="iTemList Artist">Nghệ sĩ</div>
        <div class="iTemList Play">Play</div>
        <div class="iTemList Remove">Xóa</div>
    </div>
    <?php
    $stt = 1;
    foreach ($data["MS"] as $print) {
        echo '<div class="itemsList">';
        echo '<div class="itemList STT">';
        echo $stt;
        echo '</div>';
        echo '<div class="itemList NameMusic">';
        echo $print['NameMusic'];
        echo '</div>';
        echo '<div class="itemList Artist">';
        echo $print['NameArtist'];
        echo '</div>';
        echo '<div class="itemList PlayMusic" data-id="' . $print['IdMusic'] . '">';
        echo 'Play'; // Đặt nút Play ở đây
        echo '</div>';
        echo '<div class="itemList RemoveMusic">';
        echo 'Remove'; // Đặt nút Remove ở đây
        echo '</div>';
        echo '</div>';
        $stt++;
    }
    ?>
</div> -->
<div class="ListMusic">
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
            echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'].'" data-idArtist="'.$print['IdArtist'].'" data-idCategory="'.$print['IdCategory'].'">Play</button> <button onclick=DeleteMusic(this) data-idMusic="' . $print['IdMusic'].'" data-idArtist="'.$print['IdArtist'].'" data-idCategory="'.$print['IdCategory'].'">Remove</button></td>';
            echo '</tr>';
            $stt++;
        }
        ?>
    </table>
</div>