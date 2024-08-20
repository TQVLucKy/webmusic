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

    // Khi nhấn vào album thì sẽ nhảy vào danh sách bài nhạc của album đấy.
    // rồi khi nhấn vào một bài nhạc trong album đấy thì sẽ phát bài đấy thôi
    // còn nhấn vào phát cả album thì sẽ phát theo album đấy
    function getAlbumhHasArtist(idArtist) {
        $.ajax({
            url: './model/test',
            type: 'GET',
            data: {
                action: 'getAlbumhHasArtist',
                idArtist: idArtist
            },
            success: function(data) {
                console.log("ket qua" +data)
                const albumData = JSON.parse(data);
                let count=1;
                artistName.innerHTML = albumData[0]["NameArtist"];
                albumData.forEach(function(item) {
                    $('#songHasArtist').append(`
                    <a class="artist-all-item" href="./Album?id=${item['IdAlbum']}">
                    <div class="count">${count}</div>
                    <h5>${item['NameAlbum']}</h5>
                    </a>`);
                    count++;
                });
            }
        })
    }
    
    $(document).ready(function() {
        getAlbumhHasArtist(<?php echo $_GET["id"] ?>);
    });
</script>