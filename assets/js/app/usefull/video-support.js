class VideoSupport {
    constructor(module) {
        this.videos = module.querySelectorAll('.js-support-video');
        this.init();
    }

    init() {
        this.playVideo()
    }

    playVideo() {
        this.videos.forEach(video => {
            const videoId = video.getAttribute('video-id')
            let moduleId = video.getAttribute('id')
            const service = video.getAttribute('service')
            const playBtn = video.querySelector('.js-support-video-play');
            playBtn.addEventListener('click', () => {
                playBtn.remove();

                switch (service) {
                    case 'youtube':
                        moduleId = video.getAttribute('youtube-dom');
                        this.youtube(videoId, moduleId);
                        break;
                    case 'vimeo':
                        this.vimeo(videoId, moduleId);
                        break;
                }

            });
        })
    }

    youtube(videoId, moduleId) {
        if (!document.querySelector('.youtube-api')) {
            const api = document.createElement('script');
            api.src = "https://www.youtube.com/iframe_api";
            api.setAttribute('class', 'youtube-api');
            document.head.appendChild(api)

            api.onload = function () {
                window.YT.ready(function () {
                    const player = new YT.Player(moduleId, {
                        height: '360',
                        width: '640',
                        videoId: videoId,
                        playerVars: {
                            'controls': 1,
                            'showinfo': 0,
                            'rel': 0,
                            'enablejsapi': 1,
                            'autoplay': 1,
                            'wmode': 'transparent'
                        },
                        events: {
                            'onReady': function (e) {
                                e.target.playVideo();
                                e.target.setPlaybackQuality('hd720');
                            }
                        }
                    });
                });
            }
        } else {
            const player = new YT.Player(moduleId, {
                height: '360',
                width: '640',
                videoId: videoId,
                playerVars: {
                    'controls': 1,
                    'showinfo': 0,
                    'rel': 0,
                    'enablejsapi': 1,
                    'autoplay': 1,
                    'wmode': 'transparent'
                },
                events: {
                    'onReady': function (e) {
                        e.target.playVideo();
                        e.target.setPlaybackQuality('hd720');
                    }
                }
            });
        }
    }

    vimeo(videoId, moduleId) {
        if (!document.querySelector('.vimeo-api')) {
            const api = document.createElement('script');
            api.src = "https://player.vimeo.com/api/player.js";
            api.setAttribute('class', 'vimeo-api');
            document.head.appendChild(api)

            api.onload = function () {
                const options = {
                    id: videoId,
                    width: 640,
                    loop: false
                };

                const player = new Vimeo.Player(moduleId, options);

                player.play();
            }
        } else {
            const options = {
                id: videoId,
                width: 640,
                loop: false
            };
            const player = new Vimeo.Player(moduleId, options);
            player.play();
        }

    }
}

export default VideoSupport;