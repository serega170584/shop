document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        alert('123');
        if (document.getElementById('product_upload_imageFile').files[0].size > 1) {
            alert('Size 1MB is exceeded!')
        } else {
            const form = document.forms.product_upload;
            form.submit();
        }
    }
});