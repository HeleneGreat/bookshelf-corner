let articles = document.getElementById('all-books');
let articlesLink = document.getElementById('all-books-link');

let genres = document.getElementById('book-cat');
let genresLink = document.getElementById('book-cat-link');

let slider = document.getElementById('book-slider');
let sliderLink = document.getElementById('book-slider-link');


genresLink.addEventListener('click', function(){
    this.classList.add('active');
    articlesLink.classList.remove('active');
    sliderLink.classList.remove('active');

    genres.classList.remove('display-none');
    articles.classList.add('display-none');
    slider.classList.add('display-none');
})

sliderLink.addEventListener('click', function(){
    this.classList.add('active');
    articlesLink.classList.remove('active');
    genresLink.classList.remove('active');

    slider.classList.remove('display-none');
    articles.classList.add('display-none');
    genres.classList.add('display-none');
})

articlesLink.addEventListener('click', function(){
    this.classList.add('active');
    genresLink.classList.remove('active');
    sliderLink.classList.remove('active');

    articles.classList.remove('display-none');
    genres.classList.add('display-none');
    slider.classList.add('display-none');
})