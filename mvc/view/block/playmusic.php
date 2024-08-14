<link rel="stylesheet" type="text/css" href="../public/css/playmusic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- <script type="text/javascript" src="../public/js/playmusic.js"></script> -->

<head>
    <!-- <script type="text/javascript" src="../public/js/playmusic.js"></script> -->
    <!-- <script type="text/javascript" src="./song.js"></script> -->
</head>
<!-- <?php
        // print_r($_GET);     
        // echo "ID: ".$_GET['url'];
        ?> -->


<!-- bắt đầu phân chia session,cookie các chức năng của người dùng, admin
thêm lượt xem và dựa vào lượt xem sửa lại đề xuất một chút  -->
<!-- thêm các nút tắt ở các bảng -->
<div class="playmusic">
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
                <span class="current-view">view</span>
                <div class="controls">
                    <div class="btn-control">
                        <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn-play pause">
                            <span></span>
                            <span></span>
                        </button>
                        <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
                        <div class="volume-container">
                            <button class="volume-button"><i class="fa-solid fa-volume-high volume-icon" style="color: #ffffff;"></i></button>
                            <input type="range" class="volume-slider" min="0" max="100" value="50">
                        </div>
                    </div>
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
        <button class="material-icons" onclick=showLibrary()>add</button>
        <div id="list" style="display: none;">
            <?php
            foreach ($data["Lib"] as $print) {
                echo '<div class="items-list" id="idList" onclick="addToLibrary(' . $print['IdList'] . ')">';
                echo $print['NameList'];
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <!-- add song to library -->

    <!-- mini music -->
    <audio src="" id="audio"></audio>
    <div class="music-slider" id="music-slider" style="display: none;">
        <span class="current-time">00:00</span>
        <span class="music-time">00:00</span>
        <input type="range" value="0" class="seek-bar" />
        <span class="current-music">tên bài</span>
        <span class="current-artist">ca sĩ</span>
        <div class="controls-mini">
            <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
            <button class="btn-play pause">
                <span></span>
                <span></span>
            </button>
            <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
            <div class="volume-container">
                <button class="volume-button"><i class="fa-solid fa-volume-high volume-icon" style="color: #ffffff;"></i></button>
                <input type="range" class="volume-slider" min="0" max="100" value="50" orient="vertical">
            </div>
        </div>
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
    </div>
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
                if (getArtists && Array.isArray(getArtists)) {
                    getArtists.forEach(function(item) {
                        $('#artistList').append(`<img src="../img/1722584840.jpg" style="width:100px;height:100px">
                    <a class="artist-item" href="./Artist?id=${item['IdArtists']}">
                    ${item['NameArtists']}
                    </a>`);
                    });
                } else console.log("Không tìm thấy nghệ sĩ cho bài hát này.");
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
            <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px;">
            <div>
                <h5>${item['NameMusic']}</h5>
                <p style="opacity:0.8;">${item['NameArtists']}</p>
            </div>
            <span class="song-view">${item['View']}</span>
            </a>`);
                });
            }
        });
    }
    $(document).ready(function() {
        getRecommendations(1, <?php echo $_GET["id"] ?>);
    });

    //recommended by artist
    function getRecommendedByArtist(songId) {
        $.ajax({
            url: './model/test?action=getRecommendedByArtist',
            type: 'GET',
            data: {
                song_id: songId
            },
            success: function(data) {
                console.log("Kiem tra:" + data);
                const recommendedByArtist = JSON.parse(data);
                if (recommendedByArtist && Array.isArray(recommendedByArtist)) {
                    if (recommendedByArtist[0]['NameArtists']) {
                        $('.popular-music-artist').append(`
                        <p>Các bản nhạc thịnh hành của</p>
                        <div class="famous-artist"></div>
                        <div id="recommendedByArtist"></div>`);
                        $('.famous-artist').append(`<h2 class="current-artist-famous">${recommendedByArtist[0]['NameArtists']}</h2>`)
                        recommendedByArtist.forEach(function(item) {

                            $('.popular-music-artist').append(`
                    <a class="recommendation-item" href="./Play?id=${item['IdMusic']}">
                        <img src="../img/${item['NameImageMusic']}" style="width:50px;height:50px">
                        <div>
                            <h5>${item['NameMusic']}</h5>
                            <p style="opacity:0.8;">${item['NameArtists']}</p>
                        </div>
                        <span class="song-view">${item['View']}</span>
                    </a>`);
                        });
                    }
                } else console.log("Không tìm thấy bài hát đề xuất.");
            }
        });
    }

    $(document).ready(function() {
        getRecommendedByArtist(<?php echo $_GET["id"] ?>);
    });



    function showLibrary() {
        var list = document.getElementById('list');
        if (list.style.display === "none") {
            list.style.display = "block";
        } else
            list.style.display = "none";
    };

    let songs = <?php echo json_encode($data["g"]); ?>;
    let currentSong = 1;

    const music = document.querySelector('#audio');
    const seekbar = document.querySelectorAll('.seek-bar');
    const artist = document.querySelectorAll('.current-artist');
    const songname = document.querySelectorAll('.current-music');
    const currentview = document.querySelector('.current-view');
    const boxdisk = document.querySelector('.box-disk');
    const currenttimes = document.querySelectorAll('.current-time');
    const musictime = document.querySelectorAll('.music-time');
    const btnplay = document.querySelectorAll('.btn-play');
    const btnback = document.querySelectorAll('.btnback');
    const btnnext = document.querySelectorAll('.btnnext');
    const volumeSlider = document.querySelectorAll('.volume-slider');
    const volumeButton = document.querySelectorAll('.volume-button');
    const volumeIcon = document.querySelectorAll('.volume-icon');
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

    myFunction();
    // hiển thị mini-music
    function myFunction() {
        const overFlowElement = document.getElementsByClassName('playmusic')[0];
        overFlowElement.addEventListener('scroll', function() {
            if (overFlowElement.scrollTop > 200) {
                document.getElementById('music-slider').style.display = 'block';
            } else {
                document.getElementById('music-slider').style.display = 'none';
            }
        })

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
        currentview.innerHTML = songs[currentSong].view
    };
    const setSongById = (id) => {
        let index = songs.findIndex(song => song.id == id);
        if (index !== -1) {
            setSong(index);
        }
    }

    const setSong = (i) => {
        let song = songs[i];
        currentSong = i;
        seekbar.value = 0;

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

            if (music.paused) {
                music.play();
                btnplay.forEach(btn => {
                    btn.classList.toggle('pause');
                });
                boxdisk.classList.toggle('play');
            }
        }, 300);

        //tự động phát khi chọn/chuyển bài

    }


    window.addEventListener('load', () => {
        if (music.paused) {
            music.play();
            btnplay.forEach(element1 => {
                element1.classList.toggle('pause');
            });
            boxdisk.classList.toggle('play');
        }
    });
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

    function increaseViews() {
        const currentSongId = songs[currentSong].id;
        $.ajax({
            type: 'GET',
            url: './model/test?action=increaseViews',
            data: {
                currentSongId: currentSongId
            }
        })
      
    }
    // Tự động chuyển bài khi kết thúc bài hiện tại
    music.addEventListener('ended', () => {
        if (btnnext.length > 0) {
            increaseViews();
            // btnnext[0].click();
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

    // đổi lại: khi next hoặc prev sẽ thay đổi thông tin của tác giả, recommended, các bài nhạc của tác giả.
    // hoặc là sẽ reload lại trang luôn? (COMPLITE)

    // Nếu còn thời gian thì chỉnh sửa lại cái tên của các bài nhạc
    // ý tưởng sửa là thêm 1 cái cột có tên là NumberNameSong và cho số random như cái ảnh
    // sau khi 

    //nhóm trang thêm số thứ tự(đại loại vậy), khi mà phát theo nhóm hay gì đó sẽ dựa vào đó để lấy ra (complite)
    // ví dụ như phát bài tiếp theo theo danh sách thể loại, tác giả, hoặc random luôn  (việc lấy ra như thế nào thì hên xui chưa biết)
    // thế thì phải thêm nút chuyển sang trạng cái random.



    //Về sau nhớ thêm chế độ random bài hát không theo trình tự.
    btnnext.forEach(element => {
        element.addEventListener('click', async () => {
            let nextSongId;

            // Lấy id của bài tiếp theo từ server hoặc cơ sở dữ liệu
            if (currentSong >= songs.length - 1) {
                let nextSong = await fetchNextSong(songs[currentSong].id);
                nextSongId = nextSong.id;
            } else {
                nextSongId = songs[currentSong + 1].id;
            }
            btnplay.forEach(btn => btn.classList.add('pause'));
            // Điều hướng đến trang mới với id của bài hát tiếp theo
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?id=' + nextSongId;
            window.location.href = newUrl;
        });
    })

    btnback.forEach(element => {
        element.addEventListener('click', async () => {
            let prevSongId;

            // Lấy id của bài trước đó từ server hoặc cơ sở dữ liệu
            if (currentSong <= 0) {
                let prevSong = await fetchPreviousSong(songs[currentSong].id);
                prevSongId = prevSong.id;
            } else {
                prevSongId = songs[currentSong - 1].id;
            }
            btnplay.forEach(btn => btn.classList.add('pause'));
            // Điều hướng đến trang mới với id của bài hát trước đó
            let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?id=' + prevSongId;
            window.location.href = newUrl;
        });
    });


    var url = new URL(window.location.href);
    console.log(url);
    var id = url.searchParams.get("id");
    setSongById(id);


    //random music
    // btnrandom.addEventListener('click', () => {
    //     randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     while (randomSong == currentSong)
    //         randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     setSong(randomSong);
    // })

    let prevVolume = music.volume;
    let isMuted = false;

    function updateVolumeIcon(volume) {
        volumeIcon.forEach(icon => {
            if (volume >= 0.5) {
                icon.classList.remove('fa-volume-mute', 'fa-volume-low');
                icon.classList.add('fa-volume-high');
            } else if (volume > 0) {
                icon.classList.remove('fa-volume-mute', 'fa-volume-high');
                icon.classList.add('fa-volume-low');
            } else {
                icon.classList.remove('fa-volume-low', 'fa-volume-high');
                icon.classList.add('fa-volume-mute');
            }
        })
    }

    volumeSlider.forEach(slider => {
        slider.addEventListener('input', function() {
            music.volume = slider.value / 100;
            previousVolume = music.volume;
            updateVolumeIcon(music.volume)
        });
    });
    volumeButton.forEach(button => {
        button.addEventListener('click', function() {
            if (isMuted) {
                music.volume = prevVolume;
                volumeSlider.forEach(slider => {
                    slider.value = prevVolume * 100;
                });
            } else {
                prevVolume = music.volume;
                music.volume = 0;
                volumeSlider.forEach(slider => {
                    slider.value = 0;
                });
            }
            isMuted = !isMuted;
            updateVolumeIcon(music.volume);
        });
    })
</script>