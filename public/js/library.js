var create = document.getElementById('create');
var clicked = true;

document.addEventListener("click", function () {
    if (clicked) {
        document.getElementById('create').style.display = "none";
    }

})

function Show() {
    document.getElementById('create').style.display = "block";
    document.getElementById('create').style.position = "absolute";
    if (clicked)
        clicked = false;
    else clicked = true;

};

function addMusic() {
    document.getElementById('showCreate').style.display = "block";
    document.getElementById('showCreate').style.position = "absolute";
    document.getElementById('showCreate').style.zIndex = "1";
}
function delMusic(){
    window.location.assign('./DelList');
}


function addList() {
    document.getElementById('showList').style.display = "block";
    document.getElementById('showList').style.position = "absolute";
    document.getElementById('showList').style.zIndex = "1";
}

