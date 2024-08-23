<head>
    <link rel="stylesheet" type="text/css" href="../public/css/Category.css">
    <script type="test/javascript" src="../public/js/Category.js"></script>
</head>
<h2><?php echo $data['getCategory'][0]['NameCategory']; ?></h2>
<div class="list-music row">
    <div class="items col">
        <?php
        // chỉnh sửa khi phóng to (làm sau cùng)
        foreach ($data["getCategory"] as $print) {
            echo '<div class="item clickable" data-id="' . $print['IdMusic'] . '">';
            echo '<img style="max-width:180px;height:180px" src= ../img/' . $print['NameImageMusic'] . '><br>';
            echo $print['NameMusic'] . '</br>';
            echo '<p>' . $print['NameArtist'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>
