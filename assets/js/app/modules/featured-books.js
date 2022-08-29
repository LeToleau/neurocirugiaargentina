import Swiper from 'swiper/bundle';

class FeaturedBooks {
    constructor(module) {
        this.module = module
        this.slider = module.querySelector('.js-swiper-here');
        this.pagination = module.querySelector('.js-video-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
    }

    init() {
        this.runSlider();
    }

    runSlider() {
        new Swiper(this.slider, {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            keyboard: {
                enabled: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: this.pagination,
                clickable: true,
            },
            navigation: {
                nextEl: this.next,
                prevEl: this.prev,
            }
        });
    }
}

export default FeaturedBooks;