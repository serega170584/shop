$(function () {
    $('#order-button').click(function (e) {
        e.preventDefault();
        $('#order-form').submit();
    });

    $('#order-form').submit(function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            window.location.href = data;
        });
    });
});