document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('event_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('event_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!');
            this.closest('#event_upload').innerHTML = '<div><label for="event_upload_imageFile" class="required">Image</label><input type="file" id="event_upload_imageFile" name="event_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('event_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.event_upload;
            form.submit();
        }
    }
});