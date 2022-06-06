// Menu burger in small screens


let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-lg');

let closeMenu = document.getElementById('close-menu');



openMenu.addEventListener('click', function(event){

    overlay.classList.remove("hide-menu");
    overlay.classList.add("show-menu");
    event.preventDefault();
    openMenu.classList.toggle('display-none');
    
});


closeMenu.addEventListener('click', function(event){
    
    overlay.classList.remove("show-menu");
    overlay.classList.add("hide-menu");
    event.preventDefault();
    openMenu.classList.toggle('display-none');
    
});
