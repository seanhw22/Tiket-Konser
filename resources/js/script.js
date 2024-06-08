$(document).ready(function(){
    $('.carousel').carousel({
        interval: 5000 // 5 seconds
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");
    const carousel = document.querySelector(".carousel");
    let currentIndex = 0;

    prevBtn.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            slideImages();
        }
    });

    nextBtn.addEventListener("click", () => {
        if (currentIndex < carousel.children.length - 1) {
            currentIndex++;
            slideImages();
        }
    });

    function slideImages() {
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
});

