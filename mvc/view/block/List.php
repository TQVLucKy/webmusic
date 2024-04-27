<link rel="stylesheet" type="text/css" href="../public/css/List.css">



<!-- STT         Name        Artist      play        remove -->

<h1>Danh sách <?php foreach ($data["getlist"] as $print) {
        if ($print['IdList'] == $_GET['id']) {
            echo $print['NameList'];
            break;
        }} ?></h1>
<div class="ListLibrary">
    <div class="itemsList">
        <div class="itemList stt">
            STT
        </div>
        <div class="itemList name">
            Tên
        </div>
        <div class="itemList artist">
            Nghệ sĩ
        </div>
        <div class="itemList play">
            Play
        </div>
        <div class="itemList remove">
            Remove
        </div>
    </div>
    <?php
    $stt = 1; // Bắt đầu từ 1 thay vì 0
    foreach ($data["getlist"] as $print) {
        if ($print['IdList'] == $_GET['id']) {
            echo '<div class="itemsList">';
            echo '<div class="itemList stt">';
            echo $stt;
            echo '</div>';
            echo '<div class="itemList name">';
            echo $print['name'];
            echo '</div>';
            echo '<div class="itemList artist">';
            echo $print['artist'];
            echo '</div>';
            echo '<div class="itemList play">';
            echo 'Play'; // Đặt nút Play ở đây
            echo '</div>';
            echo '<div class="itemList remove">';
            echo 'Remove'; // Đặt nút Remove ở đây
            echo '</div>';
            echo '</div>';
            $stt++;
        }
    }
    ?>
</div>