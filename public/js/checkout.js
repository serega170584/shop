$(function () {
    $('#order-button').click(function (e) {
        e.preventDefault();
        $('#order-form').submit();
    });
});