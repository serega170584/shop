document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('product_upload_imageFile').files[0].size > 1024 * 1024) {
            alert('Size 1MB is exceeded!')
        } else {
            const form = document.forms.product_upload;
            form.submit();
        }
    }
});