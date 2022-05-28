
// Class active for the sidebar nav
let menuItem = document.getElementById('nav-admin').getElementsByTagName('a');

for (let i=0; i<menuItem.length; i++){
    if(menuItem[i].href == location.href || location.href.includes(menuItem[i].href) > 0){
        menuItem[i].classList.add("active");
    }
}


// Class active for the Book and Comments tabs nav 
let menuBook = document.getElementById('nav-secondary').getElementsByTagName('a');
let menuList = document.getElementById('nav-secondary').getElementsByTagName('li');

for (let i=0; i<menuBook.length; i++){
    if(menuBook[i].href == location.href){
        menuList[i].classList.add("active");
    }
}

