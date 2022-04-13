/* This opens a modal box when the delete btn is clicked */
let btn = document.getElementById('btn-delete');
let modal = document.getElementById('myModal');
let cancel = document.getElementById('cancel');
let closing = modal.getElementsByClassName('close')[0];

btn.onclick = function(){
    modal.classList.remove('display-none');
}

closing.onclick = function(){
    modal.classList.add('display-none');
}

cancel.onclick = function(){
    modal.classList.add('display-none');
}

window.onclick = function(event){
    if(event.target == modal){
        modal.classList.add('display-none');
    }
}


// SAME BUT WHEN THE DELETE BTN IS WITHIN A PHP LOOP
function modalDelete(id){
    let deleteBtn = document.querySelectorAll('#btn-delete-' + id);
    let modal = document.getElementById('myModal' + id);
  
    modal.classList.remove('display-none');
    window.onclick = function(event){
        if(event.target == modal){
            modal.classList.add('display-none');
        }
    }
}

function modalClose(id){
    let modal = document.getElementById('myModal' + id);
    modal.classList.add('display-none');
}