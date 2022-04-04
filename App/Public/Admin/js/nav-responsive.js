
let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-admin');

let blur = document.getElementById('blur');


// Burger nav for small and medium screens
openMenu.addEventListener('click', function(){
    
    overlay.classList.toggle("overlay");
    blur.classList.toggle("display-none"); 

});

blur.addEventListener('click', function(){

    overlay.classList.toggle("overlay");
    blur.classList.toggle("display-none");  

});