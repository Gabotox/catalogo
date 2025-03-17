

document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll("#swiper-botones .swiper-slide").length;

    var swiper = new Swiper("#swiper-botones", {
        slidesPerView: "auto",
        spaceBetween: 10,
        freeMode: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: "slide",
    });


    var swiper = new Swiper("#swiper-productos", {
        slidesPerView: 4,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        effect: 'slide',
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30
            }
        }
    });

});




