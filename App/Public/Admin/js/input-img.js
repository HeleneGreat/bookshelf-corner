/*
1. input type="file" id="inputImg"

2. img id="preview"

This function display in the <img> the image that was selected in the input

*/


inputImg.addEventListener('change', function(){
    const [file] = inputImg.files;

    if (file) {
        displayImg.classList.remove('display-none');
        preview.classList.remove('display-none');
        preview.src = URL.createObjectURL(file);
    }
}) ; 


