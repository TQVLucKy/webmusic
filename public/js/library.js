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


// $(document).ready(function () {
//     $('#showcreate').on('submit', function (e) {
//         var formData = new FormData(this);
//         $.ajax({
//             url: './model/test?action=AddMusic',
//             type: 'POST',
//             data: formData,
//             contentType: false, // Không set contentType khi có file
//             processData: false, // Không xử lý dữ liệu form
//             success: function (response) {
//                 console.log('Tải lên thành công', response);
//                 // Xử lý sau khi tải lên thành công
//             },
//             error: function (xhr, status, error) {
//                 console.log('Có lỗi xảy ra', xhr.responseText);
//                 // Xử lý lỗi
//             }
//         });
//     });
// });
function AddList() {
    document.getElementById('showList').style.display = "block";
    document.getElementById('showList').style.position = "absolute";
    document.getElementById('showList').style.zIndex = "1";
}
