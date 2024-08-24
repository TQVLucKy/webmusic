$(document).ready(function () {
    $('.header-search-input input[type="text"]').on("keyup input", function () {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.ajax({
                url: "../search/backend-search.php",
                type: "GET",
                data: { term: inputVal },
                success: function (data) {
                    // Hiển thị dữ liệu trả về trong trình duyệt
                    resultDropdown.html(data);
                },
                error: function (xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error(xhr.responseText);
                }
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Tiến hành tìm kiếm khi nhấn vào gợi ý
    $(document).on("click", ".result p", function () {
        var id = $(this).data('id');
        window.location.href='./Play?id=' +id;
    });
    
});