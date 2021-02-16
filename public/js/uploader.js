$(function () {
    let filename, customFileContainer, fileUploadContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    fileUploadContainer = $('#product_image_file').closest('.easyadmin-fileupload');
    fileUploadContainer.append('<img id="image-file" src="/uploads/files/' + filename + '" />');

    $('.easyadmin-fileupload-delete-btn').click(function () {
        fileUploadContainer.find('img').remove();
    });

    $('#product_image_file').change(function (e) {
        openFile(e)
    })

    function openFile(file) {
        let input = file.target;
        let reader = new FileReader();
        reader.onload = function () {
            let dataURL = reader.result;
            let imageFile = $('#image-file');
            imageFile.attr('src', dataURL);
        }
        reader.readAsDataURL(input.files[0]);
    }
});