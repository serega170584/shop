document.addEventListener("DOMContentLoaded", () => {
    const imageFile = document.getElementById('product_upload_imageFile');
    imageFile.addEventListener('change', handleFiles, false);

    function handleFiles() {
        let reader = new FileReader();
        reader.readAsText(document.getElementById('product_upload_imageFile').files[0]);
        reader.onload = () => console.log(reader.result);
        reader.onerror = () => console.log(reader.error);
        const form = document.forms.product_upload;
        // form.elements['product_upload[isUploaded]'].value = '1';
        // form.submit();
    }
});