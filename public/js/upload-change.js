document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('product_upload_imageFile').files[0].size > 1) {
            alert('Size 1MB is exceeded!');
            this.closest('#product_upload').innerHTML = '<div><label for="product_upload_imageFile" class="required">Image</label><input type="file" id="product_upload_imageFile" name="product_upload[imageFile]" required="required"></div>';
            const imageFile = document.getElementById('product_upload_imageFile');
            imageFile.addEventListener('change', handleFiles, false);
        } else {
            const form = document.forms.product_upload;
            form.submit();
        }
    }
});