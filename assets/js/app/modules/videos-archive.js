import AdvancedPagination from "../usefull/advanced-pagination";

class VideosArchive {
    constructor(module) {
        new AdvancedPagination(module);
        this.module = module;

    }   

    init() {
        this.runVideo()
    }

    runVideo() {
        setInterval(function () {
            let theModule = document.querySelector('.module--archive_video');

            let card = theModule.querySelectorAll('.js-card');
            for(let i = 0; i < card.length; i++) {
                let video = card[i].querySelector('.js-open-modal');
                video.addEventListener('click', () => {
                    let modal = theModule.querySelector('.js-reco-videos-modal');
                    let iframe = modal.querySelector('iframe');

                    theModule.style.transform = 'none';
                    let videoID = card[i].getAttribute('data-modal');
                    document.querySelector('.b-navbar').style.zIndex = 2;
                    modal.style.overFlow = 'hidden'
                    modal.style.display = 'block';
                    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + videoID);
                    
                    modal.addEventListener('click', () => {
                        modal.style.display = 'none';
                        modal.style.overFlow = 'visible'
                        iframe.setAttribute('src', '');
                    });
                });
            }
        }, 1000);
    }
}

export default VideosArchive;
