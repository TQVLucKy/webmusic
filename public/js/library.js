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

function AddMusic() {
    document.getElementById('showcreate').style.display = "block";
    document.getElementById('showcreate').style.position = "absolute";
    document.getElementById('showcreate').style.zIndex = "1";
}

function AddList() {
    document.getElementById('showList').style.display = "block";
    document.getElementById('showList').style.position = "absolute";
    document.getElementById('showList').style.zIndex = "1";
}
