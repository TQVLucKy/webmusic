var overlay = document.getElementById('overlay');


// nhấn vào chỉ hiển thị, còn mất thì không được
function Show() {
    var create = document.getElementById('create');
    if (create.style.display == "none") {
        create.style.display = "block";
    } else {
        create.style.display = "none";
    }

};


function addMusic() {
    document.getElementById('showCreate').style.display = "block";
    document.getElementById('showCreate').style.position = "absolute";
    overlay.style.display = 'block';
}

function delMusic() {
    window.location.assign('./DelMusic');
}


function addList() {
    document.getElementById('showList').style.display = "block";
    document.getElementById('showList').style.position = "absolute";
    overlay.style.display = 'block';
}
overlay.addEventListener('click', function() {
    document.querySelectorAll('.musicForm').forEach(function(form) {
        form.style.display = 'none';
    });
    overlay.style.display = 'none';
    document.getElementById('create').style.display = "none";
});

function addAlbum() {
    document.getElementById('showAlbum').style.display = "block";
    document.getElementById('showAlbum').style.position = "absolute";
    overlay.style.display = 'block';

}

function addArtist() {
    document.getElementById('showAddArtist').style.display = "block";
    document.getElementById('showAddArtist').style.position = "absolute";
    overlay.style.display = 'block';

}

$(document).ready(function() {
    $('#showAlbum').on('submit', function(e) {
        e.preventDefault();
        var userConfirmation = confirm("bạn có chắn chắn muốn thêm album này không?");
        if (userConfirmation) {
            var formData = $(this).serialize();
            formData += '&submitAlbum=' + encodeURIComponent('submitAlbum');
            $.ajax({
                type: 'GET',
                url: './model/test',
                data: formData,
                success: function(response) {
                    window.location.reload();
                },
                error: function() {
                    console.log('Có lỗi xảy ra');
                }
            });
        }
    });
});


$(document).ready(function() {
    $('#showList').on('submit', function(e) {
        e.preventDefault();
        var userConfirmation = confirm("bạn có chắn chắn muốn thêm danh sách phát này không?");
        if (userConfirmation) {
            var formData = $(this).serialize();
            formData += '&submitList=' + encodeURIComponent('submitList');
            $.ajax({
                type: 'GET',
                url: './model/test',
                data: formData,
                success: function(response) {
                    window.location.reload();
                },
                error: function() {
                    console.log('Có lỗi xảy ra');
                }
            });
        }
    });
});


// xử lý create music
$(document).ready(function() {
    $('#showCreate').on('submit', function(e) {
        e.preventDefault();
        var userConfirmation = confirm("bạn có chắn chắn muốn thêm bài nhạc này không?");
        if (userConfirmation) {
            var formData = new FormData(this);
            formData.append('submitMusic', 'submitMusic');
            $.ajax({
                type: 'POST',
                url: './model/test',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi ở đây
                    console.log('Có lỗi xảy ra:', xhr.responseText);
                }
            });
        }
    });
});

document.getElementById('addArtistButton').addEventListener('click', function() {
    var artistContainer = document.getElementById('artistContainer');

    // Create a new div element with the class 'new-artist-group'
    var newArtistDiv = document.createElement('div');
    newArtistDiv.classList.add('input-group');

    // Create a new label and input for the artist's name
    var newLabel = document.createElement('label');
    newLabel.setAttribute('for', 'artist');
    newLabel.textContent = 'Tên ca sĩ:';

    var newInput = document.createElement('input');
    newInput.setAttribute('type', 'text');
    newInput.setAttribute('name', 'artist[]');
    newInput.setAttribute('placeholder', 'Nhập tên ca sĩ');

    // Add a line break
    var lineBreak = document.createElement('br');

    // Append the label, input, and line break to the new div
    newArtistDiv.appendChild(newLabel);
    newArtistDiv.appendChild(lineBreak);
    newArtistDiv.appendChild(newInput);

    // Append the new div to the artist container
    artistContainer.appendChild(newArtistDiv);
});
document.getElementById('showCreate').addEventListener('submit', function(e) {
    e.preventDefault(); // Ngăn không cho form submit theo cách thông thường

    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './model/test', true);
    xhr.setRequestHeader('X-Requested-With', 'application/x-www-form-urlencoded'); // Đặt header để xác định là AJAX request

    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
        }
    };

    xhr.send(formData);
});

//xử lý thêm artist vào db
$(document).ready(function() {
    $('#showAddArtist').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        formData.append('submitAddArtist', 'submitAddArtist');
        $.ajax({
            type: 'POST',
            url: './model/test',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Kết quả:', response);
            },
            error: function(xhr, status, error) {
                console.log('Có lỗi xảy ra:', xhr.responseText);
            }
        });
    });
});


