
var clickableItems = document.querySelectorAll('.clickable');

clickableItems.forEach(function (item) {
    item.addEventListener('click', function () {
        var id = this.getAttribute('data-id');
        window.location.href = './Play?id=' + id;
    });
});