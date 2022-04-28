/* This opens a modal box when the delete btn is clicked */
let btn = document.getElementById('btn-delete');
if (btn){
    btn.onclick = function(){
        modal.classList.remove('display-none');
    }
}
let modal = document.getElementById('myModal');
let cancel = document.getElementById('cancel');
if(cancel){
    cancel.onclick = function(){
        modal.classList.add('display-none');
    }  
}

if(modal){
    let closing = modal.getElementsByClassName('close')[0];
    closing.onclick = function(){
        modal.classList.add('display-none');
    }
}

window.onclick = function(event){
    if(event.target == modal){
        modal.classList.add('display-none');
    }
}


// SAME BUT WHEN THE DELETE BTN IS WITHIN A PHP LOOP
let deleteBtns = document.querySelectorAll('.btn-delete-this');
if(deleteBtns.length > 0){
    deleteBtns.forEach(btn => {
        let id = btn.id.split('-').pop();
        btn.addEventListener('click', function(event){
            event.preventDefault();
            let modal = document.getElementById('myModal' + id);
            modal.classList.remove('display-none');
            window.onclick = function(event){
                if(event.target == modal){
                    modal.classList.add('display-none');
                }
            }
        })
    })
}

// Closing the modal through the X
let closeBtns = document.querySelectorAll('.closing');
if(closeBtns.length > 0){
    closeBtns.forEach(btn => {
        let id = btn.id.split('-').pop();
        btn.addEventListener('click', function(){
            let modal = document.getElementById('myModal' + id);
            modal.classList.add('display-none');
        })
    })
}

// Closing the modal through the cancel btn
let cancelBtns = document.querySelectorAll('.cancel');
if(cancelBtns.length > 0){
    cancelBtns.forEach(btn => {
        let id = btn.id.split('-').pop();
        btn.addEventListener('click', function(){
            let modal = document.getElementById('myModal' + id);
            modal.classList.add('display-none');
        })
    })
}