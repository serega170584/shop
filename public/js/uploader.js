$(function () {
    let customFile = $('#Product_image_file').closest('.custom-file');
    let inputGroup = customFile.closest('.input-group');
    let inputGroupAppend = inputGroup.find('.input-group-append');
    let deleteDisplay = $('.ea-fileupload-delete-btn').css('display');
    inputGroup.closest('.ea-fileupload').find('.form-check').parent().remove();
    inputGroupAppend.find('.input-group-text').remove();
    inputGroupAppend.find('.btn').remove();
    inputGroupAppend.append(`<label class="btn" style="display: ${deleteDisplay}" >\n` +
        `                    <i class="fa fa-trash-o"></i>\n` +
        `                </label>`);
    inputGroupAppend.append('<label id="product_upload" class="btn">\n' +
        '                    <i class="fa fa-folder-open-o"></i>\n' +
        '                </label>');
    $('#Product_image_file').remove();
    let label = $('.custom-file-label').html();
    $('.custom-file-label').remove();
    customFile.append(`<label for="Product_image" lang="en" class="custom-file-label">${label}</label>`);
    customFile.append('<input type="text" ' +
        'id="Product_image" name="Product[image]" required="required"' +
        ' align="center" placeholder="" title="" data-files-label="files" class="custom-file-input">');
    $('.ea-fileupload').append('<iframe src="/product/upload" style="height:300px; display: none" name="win" id="upload_iframe"></iframe>');

    $('#product_upload').click(function () {
        $('#upload_iframe').show();
    });

    window.addEventListener("message", function (event) {
        alert(event);
        document.getElementById('Product_image').value = event.data;
    });
});