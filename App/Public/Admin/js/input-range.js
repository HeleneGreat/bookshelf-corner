// Display the notation given to a book when creating or modifying an article

let range = document.getElementById('newNotation');
let result = document.getElementById('range-result');

range.addEventListener("input", function(){
    result.value = this.value;
})

