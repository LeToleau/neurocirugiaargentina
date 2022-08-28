import Swiper from 'swiper/bundle';

class RecommendedVideos {
    constructor(module) {
        this.module = module
        this.slider = module.querySelector('.js-my-swiper');
        this.pagination = module.querySelector('.js-video-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
        this.navbar = document.querySelector('.b-navbar');

        this.videoContainer = module.querySelector('.js-video-container');
        this.modal = module.querySelector('.js-reco-videos-modal');
        this.card = module.querySelectorAll('.js-card');
        this.iframe = this.videoContainer.querySelector('iframe');
    }

    init() {
        this.runSlider();
        this.runVideo();
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

    runVideo() {
        for(let i = 0; i < this.card.length; i++) {
            let video = this.card[i].querySelector('.m-recommended-videos__video');
            video.addEventListener('click', () => {
                this.module.parentNode.style.transform = 'none';
                let videoID = this.card[i].getAttribute('data-modal');
                console.log(this.navbar);
                this.navbar.style.zIndex = 2;

                this.modal.style.display = 'block';
                this.iframe.setAttribute('src', 'https://www.youtube.com/embed/' + videoID);
                
                this.modal.addEventListener('click', () => {
                    this.modal.style.display = 'none';
                    this.iframe.setAttribute('src', '');
                });
            });
        }
    }
}

export default RecommendedVideos;