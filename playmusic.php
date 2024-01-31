<link rel="stylesheet" type="text/css" href="playmusic.scss">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />


<div class="detail">
    <div class="backnext">
        <button class="btn btnback"><i class="fa fa-chevron-left"></i></button>
        <button class="btn btnnext"><i class="fa fa-chevron-right"></i></button>
    </div>
    <div class="container">
        <div class="box-disk">

        </div>
        <span class="current-music">tên bài</span>
        <span class="current-artist">ca sĩ</span>
    </div>
</div>

<!-- mini music -->
<audio src="" id="audio"></audio>
<div class="music-slider">
    <span class="current-time">00:00</span>
    <span class="music-time">00:00</span>
    <input type="range" value="0" class="seek-bar"/>
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
<script src="song.js"></script>
<script>
    let currentSong = 0;

    const music = document.querySelector('#audio');
    const seekbar = document.querySelector('.seek-bar');
    const artist = document.querySelectorAll('.current-artist');
    const songname = document.querySelectorAll('.current-music');
    const boxdisk = document.querySelector('.box-disk');
    const currenttimes = document.querySelector('.current-time');
    const musictime = document.querySelector('.music-time');
    const btnplay = document.querySelector('.btn-play');
    const btnback = document.querySelector('.btnback');
    const btnnext = document.querySelector('.btnnext');


    btnplay.addEventListener('click', () => {
        if (btnplay.className.includes('pause')) {
            music.play();
        } else {
            music.pause();
        }
        btnplay.classList.toggle('pause');
        boxdisk.classList.toggle('play');
    });

    const updateCurrentMusicInfo = () => {
        songname.forEach(element => {
            element.innerHTML = songs[currentSong].name;
        });
        artist.forEach(element => {
            element.innerHTML = songs[currentSong].artist;
        })
    };

    const setSong = (i) => {
        seekbar.value = 0;
        let song = songs[i];
        currentSong = i;
        updateCurrentMusicInfo();
        music.src = song.path;
        boxdisk.style.backgroundImage = 'url(img/1702540579.jpg)';
        
        currenttimes.innerHTML = '00:00';
        setTimeout(()=>{
            seekbar.max = music.duration;
            musictime.innerHTML=formatTimes(music.duration);
        },300);
            
    }
    setSong(0);

    const formatTimes = (time) => {
        let min = Math.floor(time / 60);
        if (min < 10)
            min = `0${min}`;

        let sec = Math.floor(time % 60);
        if (sec < 10)
            sec = `0${sec}`;
        return `${min}:${sec}`;
    }

    //set seek bar
    setInterval(() => {
        seekbar.value = music.currentTime;
        currenttimes.innerHTML = formatTimes(music.currentTime)
        if (Math.floor(music.currentTime) == Math.floor(seekbar.max))
            btnnext.click();
    }, 500);
    seekbar.addEventListener('change', () => {
        music.currentTime = seekbar.value;
    })

    const PlayMusic = () => {
        music.play();
        btnplay.classList.remove('pause');
        boxdisk.classList.add('play');
    }

    //Next and PreView

    btnnext.addEventListener('click', () => {
        if (currentSong >= songs.length - 1) {
            currentSong = 0;
        } else {
            currentSong++;
        }

        setSong(currentSong);
    })
    btnback.addEventListener('click', () => {
        if (currentSong <= 0) {
            currentSong = songs.length + 1;
        } else {
            currentSong--;
        }

        setSong(currentSong);
    })

    //random music
    // btnrandom.addEventListener('click', () => {
    //     randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     while (randomSong == currentSong)
    //         randomSong = songs[floor.random() * (songs.length() - 1) + 1];
    //     setSong(randomSong);
    // })
</script>