import cloneAttributes from "../usefull/clone-html-attr";

class ResetScripts {
    constructor(html) {
        this.script = html.querySelector('#wcanvas-boilerplate-main-js');
        this.style = html.querySelector('#wcanvas-boilerplate-page-style-css');
        this.head = html.head;
        this.footer = [...html.body.children].filter((element, index) => index > 0)
    }

    init() {
        //Wordpresss support
        this.reloadScripts();
        this.reloadStyles();
        this.reloadWPHead();
        this.reloadWPFooter();
    }

    reloadScripts() {
        //Create new element
        const scripts = document.createElement('script');
        scripts.src = this.script.src;
        scripts.setAttribute("id", "wcanvas-boilerplate-main-js");
        document.body.appendChild(scripts);

        //Remove prev element
        scripts.onload = function () {
            document.querySelector('#wcanvas-boilerplate-main-js').remove();
        }
    }

    reloadStyles() {
        //Create new element
        const styles = document.createElement('link');
        styles.setAttribute("rel", "stylesheet");
        styles.setAttribute("href", this.style.href);
        styles.setAttribute("id", "wcanvas-boilerplate-page-style-css");
        styles.setAttribute("all", "media");
        document.head.appendChild(styles);

        //Remove prev element
        styles.onload = function () {
            document.querySelector('#wcanvas-boilerplate-page-style-css').remove();
        }
    }

    reloadWPHead() {
        const tags = this.head.children;
        const oldTags = document.head.children;

        [...oldTags].forEach(tag => {
            if (tag.getAttribute('id') != 'wcanvas-boilerplate-page-style-css') {
                tag.remove();
            }
        });


        [...tags].forEach(tag => {
            if (tag.getAttribute('id') != 'wcanvas-boilerplate-page-style-css') {
                const tagType = tag.tagName.toLowerCase();
                const element = document.createElement(tagType);
                document.head.appendChild(cloneAttributes(element, tag));
            }
        });
    }

    reloadWPFooter() {
        const tags = this.footer;
        const oldTags = [...document.body.children].filter((element, index) => index > 0);

        [...oldTags].forEach(tag => {
            if (tag.getAttribute('id') != 'wcanvas-boilerplate-main-js' && tag.getAttribute('id') != 'wcanvas-boilerplate-theme-page-spa-js') {
                tag.remove();
            }
        });

        [...tags].forEach(tag => {
            if (tag.getAttribute('id') != 'wcanvas-boilerplate-main-js' && tag.getAttribute('id') != 'wcanvas-boilerplate-theme-page-spa-js') {
                const tagType = tag.tagName.toLowerCase();
                const element = document.createElement(tagType);
                document.body.appendChild(cloneAttributes(element, tag));
            }
        });
    }
}

export default ResetScripts;