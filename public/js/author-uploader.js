$(function () {
        let display = 'none';
        let image = $('#Category_image').val();
        let img = '';
        if (image) {
            display = 'block';
            img = `<img src="/uploads/author/${image}" id="author_image" />`
        }
        let invalidFeedback = '';
        if ($('#Category_image').closest('.form-widget').find('.invalid-feedback').html() !== undefined) {
            invalidFeedback = $('#Category_image').closest('.form-widget').find('.invalid-feedback').html();
            invalidFeedback = `<span class="invalid-feedback d-block">${invalidFeedback}</span>`;
        }
        $('#Category_image').closest('.form-widget').html(`<div class="ea-fileupload">\n` +
            `        <div class="input-group">\n` +
            `                                                            <div class="custom-file">\n` +
            `    <label for="Category_image" lang="en" class="custom-file-label" id="file_label">${image}</label><input type="text" id="Category_image" name="Category[image]" value="${image}" align="center" placeholder="" title="" data-files-label="files" class="custom-file-input"></div>\n` +
            `            <div class="input-group-append">\n` +
            `                \n` +
            `                                    \n` +
            `                                \n` +
            `            <label class="btn" id="image_trash" style="display: ${display}">\n` +
            `                    <i class="fa fa-trash-o"></i>\n` +
            `                </label><label id="product_upload" class="btn">\n` +
            `                    <i class="fa fa-folder-open-o"></i>\n` +
            `                </label></div>\n` +
            `        </div>\n` +
            invalidFeedback +
            img +
            `                            \n` +
            `            <iframe src="/author/upload" style="height:300px; display: none" name="win" id="upload_iframe"></iframe></div>`);

        $('#product_upload').click(function () {
            $('#upload_iframe').show();
        });

        $('#image_trash').click(function () {
            $(this).hide();
            $('#author_image').remove();
            document.getElementById('Category_image').setAttribute('value', '');
            $('#file_label').html('');
        });
    }
);