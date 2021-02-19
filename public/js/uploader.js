let originalHtmlClassMethod = $.fn.html;
let originalCustomHtmlClassMethod = $.fn.html;
let htmlArgumentsCount = 0;
let isHtmlTriggered = false;
$.fn.customHtml = function () {
    let result = originalCustomHtmlClassMethod.apply(this, arguments);
    return result;
}
$.fn.html = function () {
    let result = originalHtmlClassMethod.apply(this, arguments);
    htmlArgumentsCount = arguments.length;
    if (!isHtmlTriggered) {
        $(this).trigger('customChange');
        isHtmlTriggered = true;
    }
    return result;
}

$(function () {
    //$('.custom-file-label').hide();
    //$('#product_image_file').closest('.custom-file').append('<label for="product_image_file" lang="en" class="user-custom-file-label"></label>');

    $('.custom-file-label').bind('customChange', function () {
        if (htmlArgumentsCount > 0) {
            $(this).customHtml('123456789');
        }
    });

    let filename, customFileContainer, fileUploadContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    if (filename != '') {
        filename = '/uploads/files/' + filename;
    }
    fileUploadContainer = $('#product_image_file').closest('.easyadmin-fileupload');
    fileUploadContainer.append('<img id="image-file" src="' + filename + '" />');

    $('.easyadmin-fileupload-delete-btn').click(function () {
        fileUploadContainer.find('img').remove();
    });

    $('#product_image_file').change(function (e) {
        openFile(e);
    })

    function openFile(file) {
        let reader = new FileReader();
        let input = file.target;
        file = input.files[0];
        if (file.size < 2000) {
            reader.onload = function () {
                let dataURL = reader.result;
                let imageFile = $('#image-file');
                imageFile.attr('src', dataURL);
            }
            reader.readAsDataURL(file);
        } else {
            // customFileContainer.find('.custom-file-label').html('');
            alert('File size 2kB is exceeded!');
        }
    }
});


