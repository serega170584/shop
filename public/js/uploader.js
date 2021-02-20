$(function () {
    let inputGroupAppendHtml = '';
    let filename, customFileContainer, fileUploadContainer;
    customFileContainer = $('#product_image_file').closest('.custom-file');
    filename = customFileContainer.find('.custom-file-label').html();
    $('.custom-file-label').hide();
    $('#product_image_file').closest('.custom-file').append('<label for="product_image_file" lang="en" class="user-custom-file-label">' + filename + '</label>');
    $('.input-group-append').hide();
    inputGroupAppendHtml += '<div class="custom-input-group-append">';
    inputGroupAppendHtml += '<span class="custom-input-group-text" id="image-size" style=""></span>';
    inputGroupAppendHtml += '<label class="btn custom-easyadmin-fileupload-delete-btn" style="" for="product_image_delete">';
    inputGroupAppendHtml += '<i class="fa fa-trash-o"></i>';
    inputGroupAppendHtml += '</label>';
    inputGroupAppendHtml += '<label class="btn" for="product_image_file">';
    inputGroupAppendHtml += '<i class="fa fa-folder-open-o"></i>';
    inputGroupAppendHtml += '</label>';
    inputGroupAppendHtml += '</div>';
    if (filename != '') {
        $('#product_image_file').removeAttr('required');
        filename = '/uploads/files/' + filename;
    }
    $('#product_image_file').closest('.input-group').append(inputGroupAppendHtml);
    fileUploadContainer = $('#product_image_file').closest('.easyadmin-fileupload');
    fileUploadContainer.append('<img id="image-file" src="' + filename + '" />');

    $('.easyadmin-fileupload-delete-btn').click(function () {
        fileUploadContainer.find('img').remove();
    });

    $(document).on('change', '#product_image_file', function (e) {
        openFile(e);
    });

    $('.custom-easyadmin-fileupload-delete-btn').click(function () {
        $('.user-custom-file-label').html('');
        $('#image-file').attr('src', '');
        $('#product_image_file').remove();
        customFileContainer.prepend('<input type="file" id="product_image_file" name="product[image][file]" required="required" placeholder="" title="" data-files-label="files" class="custom-file-input">');
    });

    function openFile(file) {
        let reader = new FileReader();
        let input = file.target;
        file = input.files[0];
        if (file.size < 4000) {
            $('.user-custom-file-label').html(file.name);
            reader.onload = function () {
                let dataURL = reader.result;
                let imageFile = $('#image-file');
                imageFile.attr('src', dataURL);
            }
            reader.readAsDataURL(file);
        } else {
            $('.user-custom-file-label').html('');
            $('#image-file').attr('src', '');
            alert('File size 2kB is exceeded!');
            $('#product_image_file').remove();
            customFileContainer.prepend('<input type="file" id="product_image_file" name="product[image][file]" required="required" placeholder="" title="" data-files-label="files" class="custom-file-input">');
        }
    }
});


