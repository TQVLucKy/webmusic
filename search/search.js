$(document).ready(function () {
    $('.input-group input[type="text"]').on("keyup input", function () {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
            $.get("../search/backend-search.php", {
                term: inputVal
            }).done(function (data) {
                // Display the returned data in browser
                console.log(data);
                resultDropdown.html(data);
            });
        } else {
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function () {
        $(this).parents(".input-group").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});