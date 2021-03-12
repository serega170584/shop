document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('category_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('category_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!');
            this.closest('#category_upload').innerHTML = '<div><label for="category_upload_imageFile" class="required">Image</label><input type="file" id="category_upload_imageFile" name="category_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('category_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.category_upload;
            form.submit();
        }
    }
});