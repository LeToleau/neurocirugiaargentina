import Swiper from 'swiper/bundle';

class SwiperGallery {
    constructor(module) {
        this.slider = module.querySelector('.js-my-swiper');
        this.pagination = module.querySelector('.js-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
    }

    init() {
        this.runSlider();
    }

    runSlider() {
        new Swiper(this.slider, {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            keyboard: {
                enabled: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: this.pagination,
                clickable: true,
            },
            /*navigation: {
                nextEl: this.next,
                prevEl: this.prev,
            },*/
        });
    }
}

export default SwiperGallery;