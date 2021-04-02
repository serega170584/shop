document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('video_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('video_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!');
            this.closest('#video_upload').innerHTML = '<div><label for="video_upload_imageFile" class="required">Image</label><input type="file" id="video_upload_imageFile" name="video_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('video_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.video_upload;
            form.submit();
        }
    }
});