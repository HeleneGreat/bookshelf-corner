let btn = document.getElementById('btn-delete');

let modal = document.getElementById('myModal');

let closing = modal.getElementsByClassName('close')[0];

btn.onclick = function(){
    modal.classList.remove('display-none');
}

closing.onclick = function(){
    modal.classList.add('display-none');
}

window.onclick = function(event){
    if(event.target == modal){
        modal.classList.add('display-none');
    }
}