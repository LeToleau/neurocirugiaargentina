
//Navbar, Animations and Performance
import setupScripts from "../app/usefull/setup-scripts.js";
setupScripts();

//Modules (Import your JS files here)
import moduleCaller from "../app/usefull/module-caller";
import VideoModal from "../app/modules/video-modal"
import SwiperGallery from "../app/modules/swiper_gallery";

//Example for test module, replace it with your module/s

moduleCaller([
    {
        domModule: '.js-video-modal',
        classModule: VideoModal
    },
    {
        domModule: '.js-slider',
        classModule: SwiperGallery
    }
]);

