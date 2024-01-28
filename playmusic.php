<link rel="stylesheet" type="text/css" href="playmusic.scss">


<audio src="" id="audio"></audio>
<div class="music-slider">
    <input type="range" value="0" class="seek-bar" />
    <span class="current-time">00:00</span>
    <span class="music-time">00:00</span>
</div>
<div class="controls">
    <button class="btn btnback"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
    <button class="btn-play pause">
        <span></span>
        <span></span>
    </button>
    <button class="btn btnnext"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
</div>
</div>
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
        boxdisk.classList.toggle('play');
    });
</script>