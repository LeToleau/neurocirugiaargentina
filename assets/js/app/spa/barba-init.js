//LIBRARIES
import barba from '@barba/core';

//APP SCRIPTS
import stringToHTML from '../usefull/string-to-html';
import ResetClasesBetweenPages from './class-changer';
import ResetScripts from './reset-scripts';
import ForceReloadPages from './force-reload-spa';

barba.init({
    timeout: 10000,
    transitions: [{
        name: 'opacity-transition',
        leave(data) {},
        enter(data) {}
    }],
    views: [{
        namespace: 'page',
        beforeEnter({
            next
        }) {
            //Scroll top
            window.scroll({
                top: 0,
                behavior: 'auto'
            });

            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }

            //Force reload pages
            const forceReload = new ForceReloadPages;
            forceReload.init();

        },
        afterEnter({
            next
        }) {}

    }]

});

//Load new scripts and styles
barba.hooks.beforeEnter((data) => {
    //Reset Scripts
    const nextPage = stringToHTML(data.next.html);
    const resetScripts = new ResetScripts(nextPage)
    resetScripts.init();

    //Reset clases
    const resetClasses = new ResetClasesBetweenPages(nextPage, data.next.url.href);
    resetClasses.init();
});

barba.hooks.after((data) => {
    
    const js = data.next.container.querySelectorAll('script');

    if (js != null) {
        js.forEach((item) => {    
            if(item.src != ''){
                const externalJs = document.createElement('script');
                externalJs.src = item.src;
                externalJs.setAttribute('loaded', 'barba');
                item.parentElement.appendChild(externalJs);
                item.remove();
            }else{
                eval(item.innerHTML);
            }
        });
    }
});