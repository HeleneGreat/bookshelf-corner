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

  for(let i in allLinks){
    let link = document.createElement('a');
    link.href = allLinks[i].href;
    link.title = allLinks[i].title;
    carousel.appendChild(link);

    let image = document.createElement('img');
    image.src = allImages[i].src;
    link.appendChild(image);
  }

}

prev.addEventListener('click', (e) => {
  e.preventDefault();
  let poped = allImages.pop();
  let newImages = [poped, ...allImages];
  let popped = allLinks.pop();
  let newLinks = [popped, ...allLinks];

  display(newImages, newLinks)
});

next.addEventListener('click', (e) => {
  e.preventDefault();
  let shifted = allImages.shift();
  let newImages = [...allImages, shifted];
  let shiftted = allLinks.shift();
  let newLinks = [...allLinks, shiftted];

  display(newImages, newLinks)
});

// Next & Prev actions through keyboard arrows
window.addEventListener('load', function(){
  window.onkeydown = function(event){
    if (event.key == "ArrowLeft"){
      let poped = allImages.pop();
      let newImages = [poped, ...allImages];
      let popped = allLinks.pop();
      let newLinks = [popped, ...allLinks];
      display(newImages, newLinks)
    }
    else if (event.key == "ArrowRight"){
      let shifted = allLinks.shift();
      let newLinks = [...allLinks, shifted];
      let shiftted = allImages.shift();
      let newImages = [...allImages, shiftted];
      display(newImages, newLinks);
    }
  }
})



display(images, links);