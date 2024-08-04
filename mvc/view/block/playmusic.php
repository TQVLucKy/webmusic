<link rel="stylesheet" type="text/css" href="../public/css/playmusic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<!-- <script type="text/javascript" src="../public/js/playmusic.js"></script> -->

<head>
    <!-- <script type="text/javascript" src="../public/js/playmusic.js"></script> -->
    <!-- <script type="text/javascript" src="./song.js"></script> -->
</head>
<!-- <?php
        // print_r($_GET);     
        // echo "ID: ".$_GET['url'];
        ?> -->

<div class="music">
    <div class="container">
        <div class="box-disk">
        </div>
        <div class="title">
            <span class="current-time">00:00</span>
            <span class="music-time">00:00</span>
            <input type="range" value="0" class="seek-bar" />
            <span class="current-music">tên bài</span>
            <span class="current-artist">ca sĩ</span>
            <div class="controls">
                <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
                <button class="btn-play pause">
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="contact">
    <?php
    $favorites = array_combine(array_column($data["g"], 'id'), array_column($data["g"], 'favorite'));
    echo "<button id='favorite' data-favorite='" . $favorites[$_GET['id']] . "'class='" . ($favorites[$_GET['id']] == 1 ? "btn favorited" : "btn favorite") . "'";
    echo " onclick=updateFavorite()>";
    echo "<i class='fa fa-heart'></i></button>";
    ?>
    <button class="material-icons" onclick=addMusicToLibrary()>add</button>

</div>
<!-- mini music -->
<audio src="" id="audio"></audio>
<div class="music-slider" id="music-slider" style="display: none;">
    <span class="current-time">00:00</span>
    <span class="music-time">00:00</span>
    <input type="range" value="0" class="seek-bar" />
    <span class="current-music">tên bài</span>
    <span class="current-artist">ca sĩ</span>
    <div class="controls">
        <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
        <button class="btn-play pause">
            <span></span>
            <span></span>
        </button>
        <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
    </div>
</div>

<!-- add song to library -->
<div id="list" style="display: none;">
    <?php
    foreach ($data["Lib"] as $print) {
        echo '<div class="items-list" id="idList" onclick=AddToLibrary(' . $print['IdList'] . ')>';
        echo $print['NameList'];
        echo '</div>';
    }
    ?>
</div>
<div class="artists">
    <div id="artistList"></div>
</div>
<div class="recommendation">
    <h2>Recommended</h2>
    <div id="recommendations"></div>
    <script src="../public/js/playmusic.js"></script>
</div>
<div class="popular-music-artist">
    <p>Các bản nhạc thịnh hành của</p>
    <h2 class="current-artist">ca sĩ</h2>
    <div id="recommendedByArtist"></div>
</div>
<script>
    // artist list
    function getArtists(songId) {
        $.ajax({
            url: './model/test?action=getArtists',
            type: 'GET',
            data: {
                song_id: songId
            },
            success: function(data) {
                const getArtists = JSON.parse(data);
                getArtists.forEach(function(item) {
                    $('#artistList').append(`<img src="../img/1722584840.jpg" style="width:100px;height:100px">
                    <a class="artist-item" href="./Artist?id=${item['IdArtists']}">
                    ${item['NameArtists']}
                    </a>`);
                });
            }
        });
    }
    $(document).ready(function() {
        getArtists(<?php echo $_GET["id"] ?>);
    });

    //recommended
    function getRecommendations(userId, songId) {
        $.ajax({
            url: './model/test?action=getRecommendations',
            type: 'GET',
            data: {
                user_id: userId,
                song_id: songId
            },
            success: function(data) {
                console.log(data);
                const recommendations = JSON.parse(data);
                recommendations.forEach(function(item) {
                    $('#recommendations').append(`<a class="recommendation-item" href="./Play?id=${item['IdMusic']}">
            <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px">
            <div>
                <h5>${item['NameMusic']}</h5>
                <p style="opacity:0.8;">${item['NameArtists']}</p>
            </div>
            </a>`);
                });
            }
        });
    }
    $(document).ready(function() {
        getRecommendations(1, <?php echo $_GET["id"] ?>);
    });

    //recommended by artist
    function getRecommendedByArtist(artistId, songId) {
        $.ajax({
            url: './model/test?action=getRecommendedByArtist',
            type: 'GET',
            data: {
                artist_id: artistId,
                song_id: songId
            },
            success: function(data) {
                console.log(data);
                const recommendedByArtist = JSON.parse(data);
                recommendedByArtist.forEach(function(item) {
                    $('#recommendedByArtist').append(`<a class="recommendation-item" href="./Play?id=${item['IdMusic']}">
            <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px">
            <div>
                <h5>${item['NameMusic']}</h5>
                <p style="opacity:0.8;">${item['NameArtists']}</p>
            </div>
            </a>`);
                });
            }
        });
    }

    $(document).ready(function() {
        getRecommendedByArtist(48, <?php echo $_GET["id"] ?>);
    });

    var list = document.getElementById('list');
    var clickedList = true;

    function handleListClick() {
        if (clickedList) {
            document.getElementById('list').style.display = "none";
        }
    }
    document.addEventListener("click", handleListClick);

    function addMusicToLibrary() {
        document.getElementById('list').style.display = "block";
        document.getElementById('list').style.position = "absolute";
        if (clickedList)
            clickedList = false;
        else clickedList = true;
    };

    let songs = <?php echo json_encode($data["g"]); ?>;
    let currentSong = 0;

    const music = document.querySelector('#audio');
    const seekbar = document.querySelectorAll('.seek-bar');
    const artist = document.querySelectorAll('.current-artist');
    const songname = document.querySelectorAll('.current-music');
    const boxdisk = document.querySelector('.box-disk');
    const currenttimes = document.querySelectorAll('.current-time');
    const musictime = document.querySelectorAll('.music-time');
    const btnplay = document.querySelectorAll('.btn-play');
    const btnback = document.querySelectorAll('.btnback');
    const btnnext = document.querySelectorAll('.btnnext');

    // window.addEventListener("scroll", () => {
    //     if (document.body.scrollTop>200)
    //         document.getElementById('1').style.display = 'block';
    //     else
    //         document.getElementById('1').style.display = 'none';
    // });

    //xử lý thêm nhạc vào library
    function addToLibrary(idList) {
        $.ajax({
            type: "GET",
            url: "./model/test?action=addMusicToLibrary",
            data: {
                idList: idList,
                idMusic: <?php echo $_GET["id"] ?>
            },
            success: function(response) {
                console.log(response);
            }
        });
        clickedList = true;
        handleListClick();
    }
    //xử lý favorite
    function updateFavorite() {
        var isFavorite = document.getElementById('favorite').getAttribute('data-favorite');
        // console.log(isFavorite);
        $.ajax({
            type: "GET",
            url: './model/test?action=updateFavorite&id=' + <?php echo $_GET['id'] ?>,
            data: {
                favorite: isFavorite
            },
            success: function(response) {
                console.log(response);
            },
            error: function() {
                console.error('Có lỗi khi cập nhật trạng thái favorite.');
            }

        })
    }

    document.getElementById('favorite').addEventListener('click', function() {
        // Kiểm tra màu hiện tại và thay đổi nó
        if (this.style.color === 'red') {
            this.style.color = 'white'; // Nếu màu đỏ, chuyển sang trắng
        } else {
            this.style.color = 'red'; // Nếu không phải màu đỏ, chuyển sang đỏ
        }
    });

    window.onscroll = function() {
        myFunction();
    };

    // hiển thị mini-music
    function myFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            document.getElementById('music-slider').style.display = 'block';
        } else {
            document.getElementById('music-slider').style.display = 'none';
        }
    }

    btnplay.forEach(element => {
        element.addEventListener('click', () => {
            if (element.className.includes('pause')) {
                music.play();
            } else {
                music.pause();
            }
            btnplay.forEach(element1 => {
                element1.classList.toggle('pause');
            })
            boxdisk.classList.toggle('play');
        })
    });
    //media
    const updateCurrentMusicInfo = () => {
        songname.forEach(element => {
            element.innerHTML = songs[currentSong].name;
        });
        artist.forEach(element => {
            element.innerHTML = songs[currentSong].artist;
        })
    };
    const setSongById = (id) => {
        let index = songs.findIndex(song => song.id == id);
        if (index !== -1) {
            setSong(index);
        }
    }

    const setSong = (i) => {
        seekbar.value = 0;
        let song = songs[i];
        currentSong = i;
        updateCurrentMusicInfo();
        music.src = song.path;
        boxdisk.style.backgroundImage = 'url(../img/' + song.image + ')';

        currenttimes.innerHTML = '00:00';
        setTimeout(() => {
            seekbar.forEach(element => {
                element.max = music.duration;
            })
            musictime.forEach(element => {
                element.innerHTML = formatTimes(music.duration);
            })
        }, 300);
        

        //đang có lỗi là khi reload lại trang là không phát nhạc
        //tự động phát khi chọn/chuyển bài
        setTimeout(() => {
            if (music.paused) {
                music.play();
                btnplay.forEach(element1 => {
                element1.classList.toggle('pause');
            });
            boxdisk.classList.toggle('play');
            }
        }, 300);
    }


    var url = new URL(window.location.href);
    console.log(url);
    var id = url.searchParams.get("id");
    setSongById(id);

    const formatTimes = (time) => {
        let min = Math.floor(time / 60);
        if (min < 10)
            min = `0${min}`;

        let sec = Math.floor(time % 60);
        if (sec < 10)
            sec = `0${sec}`;
        return `${min}:${sec}`;
    }

    // set seek bar
    // seekbar.forEach(element => {
    //     currenttimes.forEach(element1 => {
    //         setInterval(() => {
    //             element.value = music.currentTime;
    //             element1.innerHTML = formatTimes(music.currentTime)
    //             if (Math.floor(music.currentTime) == Math.floor(seekbar.max)) {
    //                 btnnext.click();
    //             }
    //         }, 500);
    //         element.addEventListener('change', () => {
    //             music.currentTime = element.value;
    //         })
    //     })

    // });
    seekbar.forEach(element => {
        setInterval(() => {
            element.value = music.currentTime;
            currenttimes.forEach(element1 => {
                element1.innerHTML = formatTimes(music.currentTime);
            });
        }, 500);

        element.addEventListener('change', () => {
            music.currentTime = element.value;
        });
    });
    // Tự động chuyển bài khi kết thúc bài hiện tại
    music.addEventListener('ended', () => {
        if (btnnext.length > 0) {
        btnnext[0].click();
    }
    });


    // setInterval(() => {
    //     seekbar[0].value = music.currentTime;
    //     currenttimes.innerHTML = formatTimes(music.currentTime)
    //     if (Math.floor(music.currentTime) == Math.floor(seekbar[0].max))
    //         btnnext.click();
    // }, 500);
    // seekbar[0].addEventListener('change', () => {
    //     music.currentTime = seekbar[0].value;
    // })

    // const PlayMusic = () => {
    //     music.play();
    //     btnplay.classList.remove('pause');
    //     boxdisk.classList.add('play');
    // }

    //Next and PreView
    btnnext.forEach(element => {
        element.addEventListener('click', () => {
            boxdisk.classList.remove('play');
            console.log(boxdisk);
            if (currentSong >= songs.length - 1) {
                currentSong = 0;
            } else {
                currentSong++;
            }
            btnplay.forEach(btn => {
                btn.classList.add('pause');
            });
            setSong(currentSong);
        })
    })

    btnback.forEach(element => {
        element.addEventListener('click', () => {
            boxdisk.classList.remove('play');
            if (currentSong <= 0) {
                currentSong = songs.length + 1;
            } else {
                currentSong--;
            }
            btnplay.forEach(btn => {
                btn.classList.add('pause');
            });
            setSong(currentSong);
        })
    });

    //random music
    // btnrandom.addEventListener('click', () => {
    //     randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     while (randomSong == currentSong)
    //         randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     setSong(randomSong);
    // })
</script>