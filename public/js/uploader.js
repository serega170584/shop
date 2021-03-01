$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    let inputGroup = customFile.closest('.input-group');
    let inputGroupAppend = inputGroup.find('.input-group-append');
    // inputGroup.closest('.ea-fileupload').find('.form-check').parent().remove();
    inputGroupAppend.find('.input-group-text').remove();
    inputGroupAppend.find('.ea-fileupload-delete-btn').remove();
    inputGroupAppend.find('.btn').remove();
    inputGroupAppend.append('<label class="btn">\n' +
        '                    <i class="fa fa-folder-open-o"></i>\n' +
        '                </label>');
    // $('#Product_image_file').remove();
    // customFile.append('<input type="text" ' +
    //     'id="Product_image" name="Product[image]" required="required"' +
    //     ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});