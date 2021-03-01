$(function () {
    // $('#Product_image_file').remove();
    $('#Product_image_file').closest('.custom-file').append('<input type="text" ' +
        'id="Product_image_file" name="Product[image][file]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});