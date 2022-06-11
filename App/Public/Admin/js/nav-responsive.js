
let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-admin');

let blur = document.getElementById('blur');

let menuLink = openMenu.getElementsByTagName('a')[0];

menuLink.addEventListener('click', function(event){
    event.preventDefault();
});

// Burger nav for small and medium screens
openMenu.addEventListener('click', menu);
blur.addEventListener('click', menu);


function menu(){
    overlay.classList.toggle("overlay");
    blur.classList.toggle("display-none");
}