<link rel="stylesheet" type="text/css" href="../public/css/DelList.scss">
<script type="text/javascript" src="../public/js/DelList.js"></script>

<h1>Danh sách tất cả bài nhạc</h1>
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
            echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'].'" data-idArtist="'.$print['IdArtist'].'" data-idCategory="'.$print['IdCategory'].'">Play</button>';
            echo '<button onclick=DeleteMusic(this) data-idMusic="' . $print['IdMusic'].'" data-idArtist="'.$print['IdArtist'].'" data-idCategory="'.$print['IdCategory'].'">Remove</button></td>';
            echo '</tr>';
            $stt++;
        }
        ?>
    </table>
</div>