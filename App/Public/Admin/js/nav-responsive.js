
let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-xs');

let blur = document.getElementById('blur');


openMenu.addEventListener('click', function(){
    
    overlay.classList.toggle("overlay");
    blur.classList.toggle("display-none"); 

});

blur.addEventListener('click', function(){

    overlay.classList.toggle("overlay");
    blur.classList.toggle("display-none");  

});

