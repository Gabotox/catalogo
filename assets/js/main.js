document.addEventListener("DOMContentLoaded", function () {

    
    var swiperBanner = new Swiper("#swiperBanner", {
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


    var swiperBotones = new Swiper("#swiper-botones", {
        slidesPerView: "auto",
        spaceBetween: 10,
        freeMode: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: "slide",
    });


    var swiperProductos = new Swiper("#swiper-productos", {
        slidesPerView: 6,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'slide',
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            320: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            480: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 30
            }
        }
    });

    var swiperOpiniones = new Swiper("#swiper-opiniones", {
        slidesPerView: "auto", // Se ajusta automáticamente
        spaceBetween: 80, // Espaciado entre slides
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    var swiperCategorias = new Swiper("#swiper-categorias", {
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            320: { 
                slidesPerView: 2,
                spaceBetween: 20,
            }, // Teléfonos
            520: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            768: { 
                slidesPerView: 4,
                spaceBetween: 30,
            }, // Tablets
            1024: { 
                slidesPerView: 5,
                spaceBetween: 40,
            } // Escritorio
        }
    });




});




