function selected(id){

 let carousel = document.getElementById('carousel');
 let sliderItem = carousel.querySelector('#slider-item-' + id);
 let articles = carousel.querySelectorAll('article');

    for(let i=0; i < articles.length ;i++){
        articles[i].classList.remove('selected');
        articles[i].classList.remove('next');
        articles[i].classList.remove('next-next');
        articles[i].classList.remove('prev');
        articles[i].classList.remove('prev-prev');
    }
    sliderItem.classList.add('selected');
    sliderItem.nextElementSibling.classList.add('next');
    sliderItem.nextElementSibling.nextElementSibling.classList.add('next-next');
    sliderItem.previousElementSibling.classList.add('prev');
    sliderItem.previousElementSibling.previousElementSibling.classList.add('prev-prev');
}