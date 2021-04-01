document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('news_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('news_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!');
            this.closest('#news_upload').innerHTML = '<div><label for="news_upload_imageFile" class="required">Image</label><input type="file" id="news_upload_imageFile" name="news_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('news_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.news_upload;
            form.submit();
        }
    }
});