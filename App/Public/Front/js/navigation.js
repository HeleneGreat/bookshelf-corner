// CODE POUR  SEULE IMAGE :

// let menuBurger = document.getElementById('menu-burger');

// let overlay = document.getElementById('nav-xs');



// menuBurger.addEventListener('click', function(){

//     this.classList.toggle("close");
//     overlay.classList.toggle("overlay");

// });


/* AVEC CONDITION DE TAILLE D'ECRAN
const bigScreen = window.matchMedia('(max-width: 1200px)');


if(bigScreen.matches){

let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-xs');

let closeMenu = document.getElementById('close-menu');

openMenu.addEventListener('click', function(){

    overlay.classList.toggle("overlay");
    
});


closeMenu.addEventListener('click', function(){

    this.classList.toggle("close");
    overlay.classList.toggle("overlay");
    
});
}

*/

let openMenu = document.getElementById('open-menu');

let overlay = document.getElementById('nav-xs');

let closeMenu = document.getElementById('close-menu');

openMenu.addEventListener('click', function(){

    overlay.classList.toggle("overlay");
    
});


closeMenu.addEventListener('click', function(){

    // this.classList.toggle("close");
    overlay.classList.toggle("overlay");
    
});
