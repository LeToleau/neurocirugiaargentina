import Swiper from 'swiper/bundle';

class RecommendedVideos {
    constructor(module) {
        this.slider = module.querySelector('.js-my-swiper');
        this.pagination = module.querySelector('.js-video-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
    }

    init() {
        this.runSlider();
    }

    runSlider() {
        new Swiper(this.slider, {
            slidesPerView: 2,
            spaceBetween: 50,
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
            },
        });
    }
}

export default RecommendedVideos;