/*
This function display in the <img> the picture that was selected in the input[file]

1. input type="file" id="inputImg"

2. img id="preview"

*/


inputImg.addEventListener('change', function(){
    const [file] = inputImg.files;

    if (file) {
        displayImg.classList.remove('display-none');
        preview.classList.remove('display-none');
        preview.src = URL.createObjectURL(file);
    }
}) ; 


