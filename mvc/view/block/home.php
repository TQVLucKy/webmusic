<head>
    <link rel="stylesheet" type="text/css" href="../public/css/home.css">
    <script type="test/javascript" src="../public/js/home.js"></script>
</head>
<div class="col-md-12">
    <div class="top d-flex justify-content-between mt-2">
        <h2>Danh sách</h2>
        <p class="text-secondary">Hiện tất cả</p>
    </div>
    <div class="list-music row">
        <div class="items col">
            <?php
            foreach ($data["MS"] as $print) {
                    echo '<div class="item clickable" data-id="' . $print['IdMusic'] . '">';
                    echo '<img style="max-width:180px;height:180px" src= ../img/' . $print['NameImageMusic'] . '><br>';
                    echo $print['NameMusic'] . '</br>';
                    echo '<p>'.$print['NameArtist'].'</p>';
                    echo '</div>';
            }
            ?>
        </div>
    </div>
</div>