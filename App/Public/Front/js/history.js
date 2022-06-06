// This js add a "back to my previous page" button in the 404 error page

let historyBtn = document.getElementById("history-btn");

historyBtn.classList.remove("display-none");

historyBtn.addEventListener("click", function(){
    window.history.back(-1);
})



