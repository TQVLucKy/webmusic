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
window.onscroll = function() {
    myFunction()
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
        element.classList.toggle('pause');
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

const setSong = (i) => {
    seekbar.value = 0;
    let song = songs[i];
    currentSong = i;
    updateCurrentMusicInfo();
    music.src = song.path;
    boxdisk.style.backgroundImage = 'url('+ song.image +')';

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

// set seek bar
seekbar.forEach(element => {
    currenttimes.forEach(element1 => {
        setInterval(() => {
            element.value = music.currentTime;
            element1.innerHTML = formatTimes(music.currentTime)
            if (Math.floor(music.currentTime) == Math.floor(seekbar.max))
                btnnext.click();
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

const PlayMusic = () => {
    music.play();
    btnplay.classList.remove('pause');
    boxdisk.classList.add('play');
}

//Next and PreView
btnnext.forEach(element => {
    element.addEventListener('click', () => {
        if (currentSong >= songs.length - 1) {
            currentSong = 0;
        } else {
            currentSong++;
        }

        setSong(currentSong);
    })
})
// btnnext.addEventListener('click', () => {
//     if (currentSong >= songs.length - 1) {
//         currentSong = 0;
//     } else {
//         currentSong++;
//     }

//     setSong(currentSong);
// })
btnback.forEach(element => {
    element.addEventListener('click', () => {
        if (currentSong <= 0) {
            currentSong = songs.length + 1;
        } else {
            currentSong--;
        }

        setSong(currentSong);
    })
});
// btnback.addEventListener('click', () => {
//     if (currentSong <= 0) {
//         currentSong = songs.length + 1;
//     } else {
//         currentSong--;
//     }

//     setSong(currentSong);
// })

//random music
// btnrandom.addEventListener('click', () => {
//     randomSong = songs[floor.random() * (songs.length() - 1) + 1];
//     while (randomSong == currentSong)
//         randomSong = songs[floor.random() * (songs.length() - 1) + 1];
//     setSong(randomSong);
// })