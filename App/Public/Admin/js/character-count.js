// This function is used to count characters written 
// in the catchphrase textarea

function count_it() {
    document.getElementById('counter').innerHTML = document.getElementById('newCatchphrase').value.length;
}
count_it();