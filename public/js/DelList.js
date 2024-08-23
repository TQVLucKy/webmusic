function PlayMusic(button) {
    var idMusic = button.getAttribute('data-idMusic');
    window.location.href = './Play?id=' + idMusic;
}
function DeleteMusic(button) {
    var userConfirmation = confirm("Bạn có chắc chắn xóa danh sách phát này?");
    if (userConfirmation) {
        var idMusic = button.getAttribute('data-idMusic');
        var idArtist = button.getAttribute('data-idArtist');
        var idCategory = button.getAttribute('data-idCategory');

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./model/test", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        };

        xhr.send("action=deleteMusic&idMusic=" + idMusic + "&idArtist=" + idArtist + "&idCategory=" + idCategory);
    }
}