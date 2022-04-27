// This function is used to count characters written in the catchphrase textarea

let catchphrase = document.getElementById('newCatchphrase');
let counter = document.getElementById('counter');

catchphrase.addEventListener('keyup', function(){
    counter.innerHTML = catchphrase.value.length;
})