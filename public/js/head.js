$.fn.actualizeSession = function () {
    $.ajax($('#container').data('actualizeSessionUri'))
        .done(function (data) {
            console.log(data);
            // if (data.interval > $('#container').data('sessionInterval')) {
            // window.location.reload();
            // }
        });
}