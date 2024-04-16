var List = document.getElementById('List');
var clickedList = true;
document.addEventListener("click", function () {
    if (clickedList) {
        document.getElementById('List').style.display = "none";
    }

})

function AddMusicToLibrary() {
    document.getElementById('List').style.display = "block";
    document.getElementById('List').style.position = "absolute";
    if (clickedList)
        clickedList = false;
    else clickedList = true;
};

