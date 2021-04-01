$(function () {
        let display = 'none';
        let image = $('#News_image').val();
        let img = '';
        if (image) {
            display = 'block';
            img = `<img src="/uploads/news/${image}" id="news_image" />`
        }
        let invalidFeedback = '';
        if ($('#News_image').closest('.form-widget').find('.invalid-feedback').html() !== undefined) {
            invalidFeedback = $('#News_image').closest('.form-widget').find('.invalid-feedback').html();
            invalidFeedback = `<span class="invalid-feedback d-block">${invalidFeedback}</span>`;
        }
        $('#News_image').closest('.form-widget').html(`<div class="ea-fileupload">\n` +
            `        <div class="input-group">\n` +
            `                                                            <div class="custom-file">\n` +
            `    <label for="News_image" lang="en" class="custom-file-label" id="file_label">${image}</label><input type="text" id="News_image" name="News[image]" value="${image}" align="center" placeholder="" title="" data-files-label="files" class="custom-file-input"></div>\n` +
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
            `            <iframe src="/news/upload" style="height:300px; display: none" name="win" id="upload_iframe"></iframe></div>`);

        $('#product_upload').click(function () {
            $('#upload_iframe').show();
        });

        $('#image_trash').click(function () {
            $(this).hide();
            $('#news_image').remove();
            document.getElementById('News_image').setAttribute('value', '');
            $('#file_label').html('');
        });
    }
);