$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    $('#Product_image_file').remove();
    customFile.append('<input type="text" ' +
        'id="Product_image_file" name="Product[image][file]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});