
var id = new URLSearchParams(window.location.search).get('id');

function playMusic(button) {
    var idMusic = button.getAttribute('data-idMusic');
    window.location.href = './Play?id=' + idMusic;
}
$(document).ready(function () {
    var originalContent = $("#song-list").html(); //Lưu nội dung ban đầu của danh sách
    $('.search input[type="text"]').on("keyup input", function () {
        var inputVal = $(this).val();
        // var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/ListSearch.php", {
                term: inputVal,
                idList: id
            }).done(function (data) {
                // Display the returned data in browser
                $("#song-list").find("tr:gt(0)").remove();
                $("#song-list").append(data);
            });
        } else {
            $("#song-list").html(originalContent);
        }
    });

});

$(document).ready(function () {
    var originalContent = $("#song-album").html(); //Lưu nội dung ban đầu của danh sách
    $('.search input[type="text"]').on("keyup input", function () {
        var inputVal = $(this).val();
        // var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/ListSearch.php", {
                term: inputVal,
                idList: id
            }).done(function (data) {
                // Display the returned data in browser
                $("#song-album").find("tr:gt(0)").remove();
                $("#song-album").append(data);
            });
        } else {
            $("#song-album").html(originalContent);
        }
    });

});

$(document).ready(function () {
    var originalContent = $("#song-all-list").html(); //Lưu nội dung ban đầu của danh sách
    $('.search input[type="text"]').on("keyup input", function () {
        var inputVal = $(this).val();
        // var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/SearchAll.php", {
                term: inputVal,
                idList: id
            }).done(function (data) {
                // Display the returned data in browser
                $("#song-all-list").find("tr:gt(0)").remove();
                $("#song-all-list").append(data);
            });
        } else {
            $("#song-all-list").html(originalContent);
        }
    });

});

$(document).ready(function () {
    var originalContent = $("#song-all-album").html(); //Lưu nội dung ban đầu của danh sách
    $('.search input[type="text"]').on("keyup input", function () {
        var inputVal = $(this).val();
        // var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/SearchAll.php", {
                term: inputVal,
                idList: id
            }).done(function (data) {
                // Display the returned data in browser
                $("#song-all-album").find("tr:gt(0)").remove();
                $("#song-all-album").append(data);
            });
        } else {
            $("#song-all-album").html(originalContent);
        }
    });

});

function playMusicFromList() {
    var idFirstMusic = document.getElementById('playFirstMusic').getAttribute('data-idMusic');
    window.location.href = './Play?id=' + idFirstMusic + '&idList='+ id;
}


function delDanhSachPhat() {
    var userConfirmation = confirm("Bạn chắc chắn muốn xóa danh sách phát này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "delDanhSachPhat",
                idList: id
            },
            success: function (response) {
                alert("Xóa danh sách phát thành công");
                window.location.href = './';
            }
        })
    }
}

function delAlbum() {
    var userConfirmation = confirm("Bạn chắc chắn muốn xóa album này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "delAlbum",
                idList: id
            },
            success: function (response) {
                alert("Xóa album thành công");
                window.location.href = './';
            }
        })
    }
}
//Thêm nhạc vào danh sách phát
function addMusicToDanhSachPhat(button) {
    var userConfirmation = confirm("Bạn chắc chắn muốn xóa bài nhạc này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "addMusicToDanhSachPhat",
                idMusic: button.getAttribute('data-idMusic'),
                idList: id
            },
            success: function (response) {
                alert("Thêm thành công");
            }
        })
    }
}
//Thêm nhạc vào album
function addMusicToAlbum(button) {
    var userConfirmation = confirm("Bạn chắc chắn muốn thêm bài nhạc này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "addMusicToAlbum",
                idMusic: button.getAttribute('data-idMusic'),
                idAlbum: id
            },
            success: function (response) {
                alert("Thêm thành công");
            }
        })
    }
}
// Xóa nhạc ở danh sách phát
function deleteMusicFromDanhSachPhat(button) {
    var userConfirmation = confirm("Bạn chắc chắn muốn xóa bài nhạc này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "deleteMusicFromDanhSachPhat",
                idMusic: button.getAttribute('data-idMusic'),
                idList: id
            },
            success: function (response) {
                alert(response);
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        })
    }
}
// Xóa nhạc ở album
function deleteMusicFromAlbum(button) {
    var userConfirmation = confirm("Bạn chắc chắn muốn xóa bài nhạc này không?");
    if (userConfirmation) {
        $.ajax({
            url: './model/test',
            type: 'POST',
            data: {
                action: "deleteMusicFromAlbum",
                idMusic: button.getAttribute('data-idMusic'),
                idAlbum: id
            },
            success: function (response) {
                alert(response);
                var row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        })
    }
}
//danh sách phát


//album
$(document).ready(function () {
    $.ajax({
        url: './model/test',
        type: 'GET',
        data: { action: 'albumOrList' },
        dataType: 'json',
        success: function (data) {
            var userId = data.userId;

            if (userId != 1) {
                $('#buttonToAddList1').on("click", function () {
                    $('#list').hide();
                    $('#addMusicToDanhSachPhat').show();
                });
                $('#buttonToAddList2').on("click", function () {
                    $('#list').show();
                    $('#addMusicToDanhSachPhat').hide();
                    window.location.reload();
                });
            } else {
                $('#buttonToAddAlbum1').on("click", function () {
                    $('#list').hide();
                    $('#addMusicToAlbum').show();
                });
                $('#buttonToAddAlbum2').on("click", function () {
                    $('#list').show();
                    $('#addMusicToAlbum').hide();
                    window.location.reload();
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
        }
    });
});