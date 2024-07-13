<link rel="stylesheet" type="text/css" href="../public/css/List.css">
<script type="text/javascript" src="../public/js/List.js"></script>
<!-- STT         Name        Artist      play        remove -->


<div class="HeaderList">
    <h1>Danh sách <?php foreach ($data["Lib"] as $print) {
                        if ($print['IdList'] == $_GET['id']) {
                            echo $print['NameList'];
                            break;
                        }
                    } ?></h1>
    <div>
        <a>Thêm nhạc vào danh sách</a>
        <button onclick="DelDanhSachPhat()">Xóa danh sách</button>
    </div>
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
            echo '</tb><td><button onclick=PlayMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Play</button> <button onclick=DeleteMusic(this) data-idMusic="' . $print['IdMusic'] . '" data-idArtist="' . $print['IdArtist'] . '" data-idCategory="' . $print['IdCategory'] . '">Remove</button></td>';
            echo '</tr>';
            $stt++;
        }
        ?>
    </table>
</div>
<script>
    var playMusic = document.querySelectorAll('.itemsList .playMusic');
    playMusic.forEach(function(item) {
        item.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            window.location.href = './Play?id=' + id;
        })
    })

    function DelDanhSachPhat() {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data:{idList:<?php echo $_GET['id'];?>},
            success: function(response){
                alert("Xóa danh sách phát thành công");
                window.location.href = './';
            }
        })
    }
</script>