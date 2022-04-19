// This function display the form to modify a book category

function genreModify(id){
    let modifyGenre = document.getElementById('modify' + id);

    // modifyGenre.classList.toggle('display-none');
}



let modifyBtns = document.querySelectorAll('.modify-this');
if(modifyBtns.length > 0){
    modifyBtns.forEach(btn => {
        let id = btn.id.split('-').pop();
        btn.addEventListener('click', function(){
            let modify = document.getElementById('modify' + id);
            modify.classList.toggle('display-none');
        })
    })
}