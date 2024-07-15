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
    echo " onclick='" . ($favorites[$_GET['id']] == 1 ? "AddFavorite()" : "DelFavorite()") . "'>";
    echo "<i class='fa fa-heart'></i></button>";
    ?>
    <button class="material-icons" onclick=AddMusicToLibrary()>add</button>

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
<div id="List" style="display: none;">
    <?php
    foreach ($data["Lib"] as $print) {
        echo '<div class="itemslist" id="IDList" onclick=AddToLibrary(' . $print['IdList'] . ')>';
        echo $print['NameList'];
        echo '</div>';
    }
    ?>
</div>
<!-- <h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>

<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1>
<h1>CC</h1> -->

<script>
    var List = document.getElementById('List');
    var clickedList = true;

    function handleListClick() {
        if (clickedList) {
            document.getElementById('List').style.display = "none";
        }
    }
    document.addEventListener("click", handleListClick);

    function AddMusicToLibrary() {
        document.getElementById('List').style.display = "block";
        document.getElementById('List').style.position = "absolute";
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
    function AddToLibrary(IdList) {
        $.ajax({
            type: "GET",
            url: "./model/test?action=AddMusicToLibrary",
            data: {
                idList: IdList,
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
    function UpdateFavorite() {
        var isFavorite = document.getElementById('favorite').getAttribute('data-favorite');
        // console.log(isFavorite);
        $.ajax({
            type: "GET",
            url: './model/test?action=UpdateFavorite&id=' + <?php echo $_GET['id'] ?>,
            data: {
                favorite: isFavorite
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
    seekbar.forEach(element => {
        currenttimes.forEach(element1 => {
            setInterval(() => {
                element.value = music.currentTime;
                element1.innerHTML = formatTimes(music.currentTime)
                if (Math.floor(music.currentTime) == Math.floor(seekbar.max))
                    {btnnext.click();
                    alert("done");
                    }
            }, 500);
            element.addEventListener('change', () => {
                music.currentTime = element.value;
            })
        })

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