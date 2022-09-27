import ContainerItems from './ContainerItems.js';
import Filters from './Filters.js';
import Navigation from './Navigation.js';
import ZoomImage from './ZoomImage.js';

(function() {

    new Navigation();
    let pathname = window.location.pathname;
    
    if (pathname == "/accueil/index" || pathname == "/") new ContainerItems();
    else if (pathname == "/timbre/tout") new Filters();
    else if (/un/.test(pathname)) {
        new ZoomImage();
    }
    
    
    
})();