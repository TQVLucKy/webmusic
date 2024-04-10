<head>
    <link rel="stylesheet" type="text/css" href="../public/css/home.scss">
</head>
<div class="menu col-md-12">
    <div class="top d-flex justify-content-between mt-2">
        <h2>Danh sách phát</h2>
        <p class="text-secondary">Hiện tất cả</p>
    </div>
    <div class="list-music row">
        <div class="items col">
            <?php
            foreach ($data["MS"] as $print) {
                echo '<div class="item col-2 mb-3 mx-3 clickable" data-id="' . $print['id'] . '">';
                echo '<img style="max-width:180px;height:180px" src= ../img/' . $print['nameimage'] . '><br>';
                echo $print['name'] . "<br>";
                echo $print['artist'] . "<br>";
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<script>
    // Chọn tất cả các div có class "clickable"
    var clickableItems = document.querySelectorAll('.clickable');

    // Lặp qua từng div và thêm sự kiện click
    clickableItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Lấy ID từ thuộc tính data-id
            var id = this.getAttribute('data-id');
            // Chuyển hướng người dùng đến trang khác với ID

            //xem lại cái nhảy trang
            window.location.href = './Play?'+ id;
        });
    });
</script>