$(function () {
    let productIdInput = $('#{{ form.product.vars.id }}');
    let deleteProductIdInput = $('#{{ productDeleteForm.product.vars.id }}');
    $('.buy').click(function (e) {
        e.preventDefault();
        $(productIdInput).val($(this).data('id'));
        $('.current').removeClass('current');
        $(this).addClass('current');
        $(productIdInput).closest('form').submit();
    });
    $('.delete').click(function (e) {
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
        }, 'json');
    });
    $(deleteProductIdInput).closest('form').submit(function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            let currentButton = $('.current');
            $(currentButton).closest('span').find('.buy').show();
            $(currentButton).hide();
            $('.studiare-cart-number').html(data.count);
        }, 'json');
    });
});