function previewImage(input) {
    var reader = new FileReader();
    reader.onload = function (e) {
    document.getElementById('imagePreview').querySelector('img').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
    }