$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    let inputGroup = customFile.closest('.input-group');
    let inputGroupAppend = inputGroup.find('.input-group-append');
    inputGroupAppend.find('.input-group-text').remove();
    inputGroupAppend.find('.ea-fileupload-delete-btn').remove();
    inputGroupAppend.find('.btn').remove();
    $('#Product_image_file').remove();
    customFile.append('<input type="text" ' +
        'id="Product_image" name="Product[image]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});