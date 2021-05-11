$(function () {
    $('button.shop-icon').click(function () {
        window.location.href = $(this).data('url');
    });
});