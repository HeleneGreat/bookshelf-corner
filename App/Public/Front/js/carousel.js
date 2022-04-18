let carousel = document.getElementById('carousel');
let images = carousel.querySelectorAll('img');
let allImages = [...images];

let links = carousel.querySelectorAll('a');
let allLinks = [...links];

let prev = document.getElementById('prev');
let next = document.getElementById('next');

function display(images, links) {
  allImages = [...images];
  allLinks = [...links];
  carousel.innerHTML = "";



  allImages.forEach(img => { 
    let image = document.createElement('img');
    image.src = img.src;
    carousel.appendChild(image);
  });

}

prev.addEventListener('click', (e) => {
  e.preventDefault();
  let poped = allImages.pop();
  let newImages = [poped, ...allImages];

  display(newImages)
});

next.addEventListener('click', (e) => {
  e.preventDefault();
  let shifted = allImages.shift();
  let newImages = [...allImages, shifted];

  display(newImages)
});

// Next & Prev actions through keyboard arrows
window.addEventListener('keydown', function(evt){
    if (evt.key == "ArrowLeft"){
        let poped = allImages.pop();
        let newImages = [poped, ...allImages];
        display(newImages)
    }
    else if (evt.key == "ArrowRight"){
        let shifted = allImages.shift();
        let newImages = [...allImages, shifted];
        display(newImages);
    }
    evt.preventDefault();
})

   




display(images, links);