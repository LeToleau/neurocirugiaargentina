/**
 * WARNING -- This will reduce your site performance!
 * To use slick you have to enable JQuery.
 * Go to Admin page -> Theme Settings -> Performance Settings and enable it.
 */

import $ from '../usefull/jquery-prefix'; //PREFIX FOR JQUERY
import 'slick-carousel'; //Import slick

class SlickGallery {
    constructor(module) {
        this.slider = module.querySelector('[slider-container]');
    }

    init() {
        this.runSlick();
    }

    runSlick() {
        $(this.slider).slick({
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            focusOnSelect: true,
            infinite: false,
        });
    }
}

export default SlickGallery;