<head>
    <link rel="stylesheet" type="text/css" href="../public/css/Album.css">
    <script type="test/javascript" src="../public/js/Album.js"></script>
</head>
<h2>Album <?php echo $data['getalbum'][0]['NameAlbum']; ?></h2>
<div class="list-music row">
        <div class="items col">
            <?php
            // chỉnh sửa khi phóng to (làm sau cùng)
            foreach ($data["getalbum"] as $print) {
                    echo '<div class="item clickable" data-id="' . $print['IdMusic'] . '">';
                    echo '<img style="max-width:180px;height:180px" src= ../img/' . $print['NameImageMusic'] . '><br>';
                    echo $print['NameMusic'] . '</br>';
                    echo '<p>'.$print['NameArtist'].'</p>';
                    echo '</div>';
            }
            ?>
        </div>
    </div>
<script>
    var clickableItems = document.querySelectorAll('.clickable');

    clickableItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            window.location.href = './Play?id=' + id;
        });
    });
</script>