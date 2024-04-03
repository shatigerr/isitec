document.addEventListener("DOMContentLoaded",() => {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let slideIndex = 0;

    // Event listeners for previous and next buttons
    prevBtn.addEventListener('click', () => {
        slideIndex--;
        showSlides();
    });

    nextBtn.addEventListener('click', () => {
        slideIndex++;
        showSlides();
    });

    // Function to show slides
    function showSlides() {
        const slides = document.querySelectorAll('.slider-item');
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }
        sliderWrapper.style.transform = `translateX(-${slideIndex * 100}%)`;
    }

    // Initial slide
    showSlides();

})