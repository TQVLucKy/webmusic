<head>
    <link rel="stylesheet" type="text/css" href="../public/css/ShowSearch.css">
</head>
<div class="search-title">Tìm kiếm với "Từ khóa"</div>
<div class="list-library">
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
    function searchText(inputVal) {
        // Thực hiện AJAX request để gửi dữ liệu đi
        $.ajax({
            url: "./model/test",
            type: "GET",
            data: {
                InputVal: inputVal
            },
            success: function(data) {
                console.log(data);
                const getSearchMusic = JSON.parse(data);
                document.querySelector('.search-title').innerHTML="Tìm kiếm với từ khóa "+inputVal;
                let count = 1;
                getSearchMusic.forEach(function(item) {
                    $('#searchResults').append(`
                    <a class="search-text-item" href="./Play?id=${item['IdMusic']}">
                    <div class="count">${count}</div>
                    <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px">
                    <div>
                    <h5>${item['NameMusic']}</h5>
                    </div>
                    </a>`);
                    count++;
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    $(document).ready(function(){
        searchText("<?php echo $_GET['name']; ?>");
    });
    
</script>