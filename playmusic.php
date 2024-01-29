<link rel="stylesheet" type="text/css" href="playmusic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<audio src="" id="audio"></audio>
<div class="music-slider">
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
<script src="song.js"></script>
<script>
    let currentSong = 0;

    const music = document.querySelector('#audio');
    const seekbar = document.querySelector('.seek-bar');
    const artist = document.querySelector('.artist');
    const songname = document.querySelector('.song-name');
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
    });

    const setSong = (i) => {
        seekbar.value = 0;
        let song = songs[i];
        currentSong = i;
        music.src = song.path;
        songname.innerHTML = song.artist;

        currenttimes.innerHTML = '00:00';
        setTimeout(() => {
            seekbar.max = music.duration;
            musictime.innerHTML = formatTimes(music.duration);
        }, 300);
    }
    setSong(0);

    const formatTimes = (time) => {
        let min = Math.floor(time % 60);
        if (min < 10)
            min = '0${min}';

        let sec = Math.floor(time % 60);
        if (sec < 10)
            sec = '0${sec}';
    }

    //set seek bar
    setInterval(() => {
        seekbar.value = music.currentSong;
        currenttimes.innerHTML = formatTimes(music.currenttimes)
        if (Math.floor(music.currenttimes) == Math.floor(seekbar.max))
            btnnext.click();
    }, 500);
    seekbar.addEventListener('change', () => {
        music.currenttimes = seekbar.value;
    })

    const PlayMusic = () => {
        music.play();
        btnplay.classList.remove('pause');
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
    btnrandom.addEventListener('click', () => {
        randomSong = songs[floor.random() * (songs.length() - 1) + 1];
        while (randomSong == currentSong)
            randomSong = songs[floor.random() * (songs.length() - 1) + 1];
        setSong(randomSong);
    })
</script>