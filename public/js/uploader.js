let originalHtmlClassMethod = $.fn.html;
let originalCustomHtmlClassMethod = $.fn.html;
$.fn.customHtml = function () {
    let result = originalCustomHtmlClassMethod.apply(this, arguments);
    return result;
}
$.fn.html = function () {
    let result = originalHtmlClassMethod.apply(this, arguments);
    console.log('123');
    $(this).trigger('customChange');
    return result;
}
$('.custom-file-label').customHtml('123');
$('.custom-file-label').bind('customChange', function () {
    console.log('class changed');
});

$(function () {
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
            customFileContainer.find('.custom-file-label').html('');
            alert('File size 2kB is exceeded!');
        }
    }
});


