<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
var swiper = new Swiper(".alumni-slider", {
    slidesPerView: 3,        // Show 3 slides at a time
    spaceBetween: 30,         // Space between slides
    loop: true,               // Enable looping
    autoplay: {
      delay: 2000,            // 2.5 seconds per slide
      disableOnInteraction: false, // Keep autoplay running after user swipes
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
});
</script>