$(function () {
        let display = 'none';
        let image = $('#Event_image').val();
        let img = '';
        if (image) {
            display = 'block';
            img = `<img src="/uploads/event/${image}" id="event_image" />`
        }
        let invalidFeedback = '';
        if ($('#Event_image').closest('.form-widget').find('.invalid-feedback').html() !== undefined) {
            invalidFeedback = $('#Event_image').closest('.form-widget').find('.invalid-feedback').html();
            invalidFeedback = `<span class="invalid-feedback d-block">${invalidFeedback}</span>`;
        }
        $('#Event_image').closest('.form-widget').html(`<div class="ea-fileupload">\n` +
            `        <div class="input-group">\n` +
            `                                                            <div class="custom-file">\n` +
            `    <label for="Event_image" lang="en" class="custom-file-label" id="file_label">${image}</label><input type="text" id="Event_image" name="Event[image]" value="${image}" align="center" placeholder="" title="" data-files-label="files" class="custom-file-input"></div>\n` +
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
            `            <iframe src="/event/upload" style="height:300px; display: none" name="win" id="upload_iframe"></iframe></div>`);

        $('#product_upload').click(function () {
            $('#upload_iframe').show();
        });

        $('#image_trash').click(function () {
            $(this).hide();
            $('#event_image').remove();
            document.getElementById('Event_image').setAttribute('value', '');
            $('#file_label').html('');
        });
    }
);