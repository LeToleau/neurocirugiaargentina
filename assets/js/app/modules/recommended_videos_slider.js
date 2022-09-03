import Swiper from 'swiper/bundle';

class RecommendedVideos {
    constructor(module) {
        this.module = module
        this.slider = module.querySelector('.js-my-swiper');
        this.pagination = module.querySelector('.js-video-swiper-pagination');
        this.next = module.querySelector('.js-swiper-button-next');
        this.prev = module.querySelector('.js-swiper-button-prev');
        this.navbar = document.querySelector('.b-navbar');
    }

    init() {
        this.runSlider();
        this.runVideo()
    }

    runSlider() {
        new Swiper(this.slider, {
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
            breakpoints: {
                576: {
                    slidesPerView: 2
                },
                300: {
                  slidesPerView: 1
                }
            }
        });
    }

    runVideo() {
        let card = this.module.querySelectorAll('.js-card');
        for(let i = 0; i < card.length; i++) {
            let videoContainer = this.module.querySelector('.js-video-container');
            let modal = this.module.querySelector('.js-reco-videos-modal');
            let iframe = videoContainer.querySelector('iframe');
            let video = card[i].querySelector('.m-recommended-videos__video');
            video.addEventListener('click', () => {
                this.module.parentNode.style.transform = 'none';
                let videoID = card[i].getAttribute('data-modal');
                console.log(this.navbar);
                this.navbar.style.zIndex = 2;

                modal.style.display = 'block';
                iframe.setAttribute('src', 'https://www.youtube.com/embed/' + videoID);
                
                modal.addEventListener('click', () => {
                    modal.style.display = 'none';
                    iframe.setAttribute('src', '');
                });
            });
        }
    }
}

export default RecommendedVideos;