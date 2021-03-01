$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    let inputGroupAppend = customFile.find('.input-group-append');
    console.log(inputGroupAppend.html());
    inputGroupAppend.hide();
    $('#Product_image_file').remove();
    customFile.append('<input type="text" ' +
        'id="Product_image" name="Product[image]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});