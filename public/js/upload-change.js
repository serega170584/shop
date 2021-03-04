document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        if (document.getElementById('product_upload_imageFile').files[0].size > 2000) {
            alert('Size 2KB is exceeded!')
        } else {
            const form = document.forms.product_upload;
            form.elements['product_upload[isUploaded]'].value = '1';
            form.submit();
        }
    }
});