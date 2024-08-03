<head>
    <link rel="stylesheet" type="text/css" href="../public/css/ShowSearch.scss">
</head>
<div class="list-library">
    <div class="items-list">
        <div class="items-list stt">
            STT
        </div>
        <div class="item-list name">
            Tên
        </div>
        <div class="item-list artist">
            Nghệ sĩ
        </div>
        <div class="item-list play">
            
        </div>
        <div class="item-list remove">
            
        </div>
    </div>
    <div id="searchResults"><!-- Đây là nơi hiển thị kết quả tìm kiếm --></div>
</div>
<script>
    // var playMusic = document.querySelectorAll('.playMusic');
    // playMusic.forEach(function(item) {
    //     item.addEventListener('click', function() {
    //         var id = this.getAttribute('data-id');
    //         window.location.href = './Play?id=' + id;
    //     })
    // })
    var inputVal = "<?php echo $_GET['name']; ?>";
    {
        // Thực hiện AJAX request để gửi dữ liệu đi
        $.ajax({
            url: "./model/test",
            type: "GET",
            data: {
                InputVal: inputVal
            },
            success: function(data) {

                $("#searchResults").html(data);
                $('.playMusic').click(function() {
                    var id = $(this).data('id');
                    window.location.href = './Play?id=' + id;
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>