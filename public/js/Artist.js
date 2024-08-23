const artistName = document.querySelector('.artist-name');
const songPopular = document.querySelector('.song-popular');
const songHasArtist = document.querySelector('.song-has-artist');


function getArtistAll() {
    var idArtist = new URLSearchParams(window.location.search).get('id');
    $.ajax({
        url: './model/test',
        type: 'GET',
        data: {
            action: 'getArtistAll',
            idArtist: idArtist
        },
        success: function (data) {
            const getsongPopular = JSON.parse(data);
            let count = 1;
            artistName.innerHTML = getsongPopular[0]["NameArtists"];
            document.querySelector('.has-artist').innerHTML = 'Có sự xuất hiện của ' + getsongPopular[0]["NameArtists"];
            getsongPopular.forEach(function (item) {
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
$(document).ready(function () {
    getArtistAll();
});

// Khi nhấn vào album thì sẽ nhảy vào danh sách bài nhạc của album đấy.
// rồi khi nhấn vào một bài nhạc trong album đấy thì sẽ phát bài đấy thôi
// còn nhấn vào phát cả album thì sẽ phát theo album đấy
function getAlbumhHasArtist() {
    var idArtist = new URLSearchParams(window.location.search).get('id');
    $.ajax({
        url: './model/test',
        type: 'GET',
        data: {
            action: 'getAlbumhHasArtist',
            idArtist: idArtist
        },
        success: function (data) {
            console.log(data);
            const albumData = JSON.parse(data);
            let count = 1;
            artistName.innerHTML = albumData[0]["NameArtist"];
            albumData.forEach(function (item) {
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

$(document).ready(function () {
    getAlbumhHasArtist();
});