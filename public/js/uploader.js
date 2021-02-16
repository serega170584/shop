$(function () {
    let filename, customFileContainer, fileUploadContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    fileUploadContainer = $('#product_image_file').closest('.easyadmin-fileupload');
    fileUploadContainer.append('<img src="/uploads/files/' + filename + '" />');

    $('.easyadmin-fileupload-delete-btn').click(function () {
        fileUploadContainer.find('img').remove();
    });

    $('#product_image_file').change(function(){
        console.log($(this).val());
    })
});