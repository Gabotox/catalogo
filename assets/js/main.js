document.addEventListener("DOMContentLoaded", function () {

    
    var swiper = new Swiper("#swiperBanner", {
        loop: true,
        freeMode: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });


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
        slidesPerView: 6,
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

    var swiper = new Swiper("#swiper-opiniones", {
        slidesPerView: "auto", // Se ajusta automáticamente
        spaceBetween: 80, // Espaciado entre slides
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    var swiper = new Swiper("#swiper-categorias", {
        spaceBetween: 30,
        breakpoints: {
            320: { slidesPerView: 1 }, // Teléfonos
            768: { slidesPerView: 4 }, // Tablets
            1024: { slidesPerView: 5 } // Escritorio
        }
    });




});




