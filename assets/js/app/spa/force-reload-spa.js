import barba from '@barba/core';
import Api from '../usefull/api';

class ForceReloadPages {
    constructor() {
        this.permaliks;
        this.selectedLinks;
    }

    init() {
        this.getPermalinks();
    }

    getPermalinks() {
        //Api rest call
        Api.get('spa-settings/v1/forced-pages')
            .then(response => {
                //Res content
                this.permaliks = response.data;

                //Forced Links
                for (let i = 0; this.permaliks.length > i; i++) {
                    let links = document.querySelectorAll(`[href="${this.permaliks[i]}"]`);
                    links.forEach(link => {
                        if (link.getAttribute('permalink') != '') {
                            //Removing href
                            link.setAttribute('permalink', link.getAttribute('href'));
                            link.removeAttribute('href');

                            //Force reload page
                            link.addEventListener('click', () => {
                                barba.force(link.getAttribute('permalink'));
                            })

                        }
                    })

                }
            })
            .catch(error => {
                console.log(error);
            });
    }
}

export default ForceReloadPages;