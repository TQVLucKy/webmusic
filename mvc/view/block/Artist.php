<head>
    <link rel="stylesheet" type="text/css" href="../public/css/Artist.css">
</head>
<div class="artist-name">Tên ca sĩ</div>
<div class="song-popular">
    <p>Phổ biến</p>
    <div id="songPopular"></div>
</div>
<div class="song-has-artist">
    <p>Có sự xuất hiện của Tên ca sĩ</p>
    <p>này là thuộc trong album nào => hoàn thành album mới làm</p>
    <div id="songHasArtist"></div>
</div>
<script>
    const artistName = document.querySelector('.artist-name');
    const songPopular = document.querySelector('.song-popular');
    const songHasArtist = document.querySelector('.song-has-artist');


    function getArtistAll(idArtist) {
        $.ajax({
            url: './model/test',
            type: 'GET',
            data: {
                action: 'getArtistAll',
                idArtist: idArtist
            },
            success: function(data) {
                const getsongPopular = JSON.parse(data);
                let count=1;
                artistName.innerHTML = getsongPopular[0]["NameArtists"];
                getsongPopular.forEach(function(item) {
                    $('#songPopular').append(`
                    <a class="artist-all-item" href="./Play?id=${item['IdMusic']}">
                    <div class="count">${count}</div>
                    <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px">
                    <div>
                    <h5>${item['NameMusic']}</h5>
                    </div>
                    </a>`);
                    count++;
                });
            }
        })
    }

    $(document).ready(function() {
        getArtistAll(<?php echo $_GET["id"] ?>);
    });
</script>