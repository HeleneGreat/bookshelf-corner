
let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-xs');

let closeMenu = document.getElementById('close-menu');


openMenu.addEventListener('click', function(){
    
    closeMenu.classList.remove("display-none");
    overlay.classList.toggle("overlay");
    
});


closeMenu.addEventListener('click', function(){

    closeMenu.classList.add("display-none");
    overlay.classList.toggle("overlay");
    
});