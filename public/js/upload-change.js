document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);
    function handleFiles(){
        const form = document.forms.product_upload;
        form.submit();
    }
});