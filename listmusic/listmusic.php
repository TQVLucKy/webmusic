<head>
    <link rel="stylesheet" type="text/css" href="./listmusic/listmusic.scss">
</head>
<div class="top d-flex justify-content-between mt-2">
    <h2>Danh sách phát</h2>
    <p class="text-secondary">Hiện tất cả</p>
</div>
<div class="list-music row">
    <?php
    
    foreach ($results as $result) {
        echo '<div id="item-list"  class="items col-2 mb-3 mx-3">';
        echo '<img style="max-width:100%;height:100%" src= ./img/' . $result['nameimage'] . '><br>';
        echo $result['name'] . "<br>";
        echo $result['artist'] . "<br>";
        echo '</div>';
    }
    ?>
</div>