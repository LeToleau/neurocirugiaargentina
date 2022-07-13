class VideoModal{
    constructor(module){
        this.module = module
    }

    init(){
        this.showModal()
    }

    showModal() {
        let card = document.querySelectorAll('.js-card');
        console.log(card.length)

        for(let i = 0; i < card.length; i++) {
            card[i].addEventListener('click', () => {
                card[i].getAttribute('data-modal');
                let iframe = document.getElementById(card[i].getAttribute('data-modal'));
                iframe.style.display = 'block';
                iframe.addEventListener('click', () => {
                    iframe.style.display = 'none';
                })
            })
        }
    }
}

export default VideoModal;