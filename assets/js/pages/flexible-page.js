//Navbar, Animations and Performance
import setupScripts from "../app/usefull/setup-scripts.js";
setupScripts();

//Modules (Import your JS files here)
import moduleCaller from "../app/usefull/module-caller";
import Posts from "../app/modules/posts";
import Video from "../app/modules/video";
import SwiperGallery from "../app/modules/swiper_gallery";
import RecommendedVideos from "../app/modules/recommended_videos_slider";
import VideoModal from "../app/modules/video-modal";
import FeaturedBooks from "../app/modules/featured-books.js";

//Dynamic js load
moduleCaller([{
        domModule: '.js-posts-pagination',
        classModule: Posts
    },
    {
        domModule: '.js-video',
        classModule: Video
    },
    {
        domModule: '.js-slider',
        classModule: SwiperGallery
    },
    {
        domModule: '.m-recommended-videos',
        classModule: RecommendedVideos
    },
    {
        domModule: '.js-video-modal',
        classModule: VideoModal
    },
    {
        domModule: '.js-featured-books',
        classModule: FeaturedBooks
    }
]);