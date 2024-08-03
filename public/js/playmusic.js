// var List = document.getElementById('List');
// var clickedList = true;

// function handleListClick() {
//     if (clickedList) {
//         document.getElementById('List').style.display = "none";
//     }
// }


// function AddMusicToLibrary() {
//     document.getElementById('List').style.display = "block";
//     document.getElementById('List').style.position = "absolute";

// };

// function getRecommendations(userId, songId) {
//     $.ajax({
//         url: './model/test?action=getRecommendations',
//         type: 'GET',
//         data: { user_id: userId, song_id: songId },
//         success: function(data) {
//             console.log(data);
//             const recommendations = JSON.parse(data);
//             recommendations.forEach(function(item) {
//             $('#recommendations').append(``);
//             });
//         }
//     });
// }

// $(document).ready(function() {
//     getRecommendations(1, 200);
// });