import Swiper from 'swiper/bundle';

class FeaturedBooks {
    constructor(module) {
        this.module = module
        this.slider = module.querySelector('.js-swiper-here');
        this.wrapper = module.querySelector('.swiper-wrapper')
        this.pagination = module.querySelector('.js-video-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
    }

    init() {
        this.runSlider();
        this.hidePrevArrow()
    }

    runSlider() {
        new Swiper(this.slider, {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: false,
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

    hidePrevArrow() {
        let active = this.slider.querySelector('.swiper-slide-active');
        let firstActive = active.getAttribute('aria-label');
        let sliderLength = this.wrapper.children.length;

        if (firstActive === '1 / ' + sliderLength) {
            this.prev.style.opacity = 0;
        }
    }
}

export default FeaturedBooks;