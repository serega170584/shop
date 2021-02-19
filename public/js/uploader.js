$(function () {
    $('.custom-file-label').hide();
    $('#product_image_file').closest('.custom-file').append('<label for="product_image_file" lang="en" class="user-custom-file-label"></label>');
    $('.input-group-append').hide();
    $('#image-size').html('88888');
    let inputGroupAppendHtml = '';
    inputGroupAppendHtml += '<div class="custom-input-group-append">';
    inputGroupAppendHtml += '<span class="input-group-text" id="image-size" style="">asdasdasd</span>';
    inputGroupAppendHtml += '<label class="btn easyadmin-fileupload-delete-btn" style="" for="product_image_delete">';
    inputGroupAppendHtml += '<i class="fa fa-trash-o"></i>';
    inputGroupAppendHtml += '</label>';
    inputGroupAppendHtml += '<label class="btn" for="product_image_file">';
    inputGroupAppendHtml += '<i class="fa fa-folder-open-o"></i>';
    inputGroupAppendHtml += '</label>';
    inputGroupAppendHtml += '</div>';
    $('#product_image_file').closest('.input-group').append(inputGroupAppendHtml);

    let filename, customFileContainer, fileUploadContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    if (filename != '') {
        filename = '/uploads/files/' + filename;
    }
    fileUploadContainer = $('#product_image_file').closest('.easyadmin-fileupload');
    fileUploadContainer.append('<img id="image-file" src="' + filename + '" />');

    $('.easyadmin-fileupload-delete-btn').click(function () {
        fileUploadContainer.find('img').remove();
    });

    $('#product_image_file').change(function (e) {
        openFile(e);
    })

    function openFile(file) {
        let reader = new FileReader();
        let input = file.target;
        file = input.files[0];
        if (file.size < 2000) {
            reader.onload = function () {
                let dataURL = reader.result;
                let imageFile = $('#image-file');
                imageFile.attr('src', dataURL);
            }
            reader.readAsDataURL(file);
        } else {
            console.log($('#image-size').html());
            $('#image-size').html('asdasdasd');
            alert('File size 2kB is exceeded!');
        }
    }
});


