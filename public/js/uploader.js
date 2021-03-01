$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    let inputGroup = customFile.closest('.input-group');
    // inputGroup.find('.input-group-append').remove();
    $('#Product_image_file').remove();
    customFile.append('<input type="text" ' +
        'id="Product_image" name="Product[image]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});