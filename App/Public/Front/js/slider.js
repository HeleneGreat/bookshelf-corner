

 let carousel = document.getElementById('carousel');

function selected(id){
    let sliderItem = carousel.querySelector('#slider-item-' + id);
    let articles = carousel.querySelectorAll('article');

    for(let i=0; i < articles.length ;i++){
        articles[i].classList.remove('selected');
        articles[i].classList.remove('next');
        articles[i].classList.remove('prev');
    }
    sliderItem.classList.add('selected');
    sliderItem.nextElementSibling.classList.add('next');
    sliderItem.previousElementSibling.classList.add('prev');
}