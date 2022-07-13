class Navbar{
    init(){
        window.addEventListener('load', () => {
            //Select all navbars available
            const navbars = document.querySelectorAll('[navbar-functions]');
        
            navbars.forEach(navbar => {
                const brandingHeight = navbar.clientHeight
                const toggler = navbar.querySelector('[toggler-menu]');
                const menu = navbar.querySelector('.menu');
                const itemWithSubmenu = menu.querySelectorAll('.menu-item-has-children');
                const links = menu.querySelectorAll('.menu-item > a');
        
                //Setting space from top of the page
                //document.querySelector('body').style.paddingTop = brandingHeight + 'px';
        
                //Dinamic padding for menu (Mobile)
                if (window.innerWidth <= 992) {
                    menu.style.paddingTop = brandingHeight + 'px';
                }
        
                //Toggler menu (Mobile)
                toggler.addEventListener('click', () => {
        
                    if (toggler.getAttribute('aria-expanded') == 'false') {
        
                        menu.setAttribute('aria-expanded', true);
        
                        toggler.setAttribute('aria-expanded', true)
        
                    } else {
        
                        menu.setAttribute('aria-expanded', false);
        
                        toggler.setAttribute('aria-expanded', false);
        
                    }
        
                });
        
                //Link fist origin
                const firstUrl = window.location.href;
        
                //Links functions
                links.forEach(link=>{
        
                    if(link.getAttribute('href') == firstUrl){
                        link.setAttribute('current-page', 'true');
                    }
        
                    if(!link.parentElement.querySelector('.sub-menu')){
        
                        link.addEventListener('click', ()=>{
        
                            //Close navbar on a click
                            menu.setAttribute('aria-expanded', false);
                            toggler.setAttribute('aria-expanded', false);
        
                            //Setting current page link
                            links.forEach(link=>{
                                link.removeAttribute('current-page')  
                            })
                            link.setAttribute('current-page', 'true')
        
                        });
                        
                    }
        
                });
        
                //Sub menu dropdown
                itemWithSubmenu.forEach(item => {
                    const subMenu = item.querySelector('.sub-menu');
                    item.setAttribute('expanded', false);
        
                    //Select Dropdown
                    const link = item.querySelector('a')
        
                    //Remove URL from dropdown
                    link.setAttribute('href', '#');
        
                    item.querySelector('a').addEventListener('click', () => {
                        event.preventDefault()
        
                        if (item.getAttribute('expanded') == 'false') {
                            closeAllDropdowns(itemWithSubmenu);
                            subMenu.style.height = subMenu.scrollHeight + 'px';
                            item.setAttribute('expanded', true);
                        } else {
                            subMenu.style.height = '0px';
                            item.setAttribute('expanded', false);
                        }
        
                    })
        
                });
        
                //Change background on scroll
                /*
                window.addEventListener('scroll', function () {
                    //console.log(navbar)
                    if (window.scrollY > 1) {
                        navbar.classList.add('scrolled')
                    } else {
                        navbar.classList.remove('scrolled')
                    }
                });
                */
        
            });
        
        })

    }
}

export default Navbar;

//Close all dropdowns
const closeAllDropdowns = items => {
    items.forEach(item => {
        const submenu = item.querySelector('.sub-menu');
        submenu.style.height = '0px';
        item.setAttribute('expanded', false);
    })
}