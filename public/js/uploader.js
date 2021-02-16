$(function () {
    let filename, customFileContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    console.log(filename);
});