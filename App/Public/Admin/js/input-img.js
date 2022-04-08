/*
This function display in the <img> the picture that was selected in the input[file]

1. input type="file" id="inputImg"
2. img id="preview"

*/

let inputImg = document.getElementById('inputImg');
let preview = document.getElementById('preview');

inputImg.addEventListener('change', function(){
    const [file] = inputImg.files;

    if (file) {
        displayImg.classList.remove('display-none');
        preview.classList.remove('display-none');
        preview.src = URL.createObjectURL(file);
    }
}) ; 



// WHEN THE INPUT FILE IS WITHIN A PHP LOOP
let bookCat = document.getElementById('book-cat');
let inputFiles = bookCat.querySelectorAll('input[type="file"]');

for(let i = 0; i < inputFiles.length; i++){
    inputFiles[i].addEventListener('change', function(event){
        let prev = document.getElementById('toto');
        if(prev){ prev.remove();}

        
        const [file] = event.target.files;

        if (file) {
            let preview = document.createElement('img');
            preview.id = "toto";
            preview.src = URL.createObjectURL(file);

            let parentE = event.target.parentElement;
            parentE.appendChild(preview);
        } 
    });
}


