$(function () {
    let basketContainer = $('#basket-update');
    let productIdInput = $('#' + $(basketContainer).data('add-id'));
    let deleteProductIdInput = $('#' + $(basketContainer).data('delete-id'));
    $('.buy').click(function (e) {
        e.preventDefault();
        $(productIdInput).val($(this).data('id'));
        $('.current').removeClass('current');
        $(this).addClass('current');
        $(productIdInput).closest('form').submit();
    });
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        $(deleteProductIdInput).val($(this).data('id'));
        $('.current').removeClass('current');
        $(this).addClass('current');
        $(deleteProductIdInput).closest('form').submit();
    });
    $(productIdInput).closest('form').submit(function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            let currentButton = $('.current');
            $(currentButton).closest('span').find('.delete').show();
            $(currentButton).hide();
            $('.studiare-cart-number').html(data.count);
            $('.shopping-cart-box').show();
            $('.shop-icon').show();
        }, 'json');
    });
    $(deleteProductIdInput).closest('form').submit(function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            let currentButton = $('.current');
            $(currentButton).closest('span').find('.buy').show();
            $(currentButton).hide();
            $('.studiare-cart-number').html(data.count);
            $('.cart-box').html(data.content);
            if (!data.count) {
                $('.shopping-cart-box').hide();
                $('.shop-icon').hide();
                window.location.href = url;
            }
        }, 'json');
    });
});