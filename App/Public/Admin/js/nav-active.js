
let menuItem = document.getElementById('nav-admin').getElementsByTagName('a');


for (let i=0; i<menuItem.length; i++){
    if(menuItem[i].href == location.href || location.href.includes(menuItem[i].href) >0){
        menuItem[i].classList.add("active");
    }

    
}
