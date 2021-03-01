$(function () {
    alert($('#Product_image_file').html());
    $('#Product_image_file').detach();
    $('#Product_image_file').closest('.custom-file').append('<input type="file" ' +
        'id="Product_image_file" name="Product[image][file]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
});