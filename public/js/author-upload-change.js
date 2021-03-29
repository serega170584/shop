document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('author_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('author_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!');
            this.closest('#author_upload').innerHTML = '<div><label for="author_upload_imageFile" class="required">Image</label><input type="file" id="author_upload_imageFile" name="author_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('author_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.author_upload;
            form.submit();
        }
    }
});