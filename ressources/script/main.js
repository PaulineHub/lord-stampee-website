import ContainerItems from './ContainerItems.js';
import StarFavorite from './StarFavorite.js';
import Filters from './Filters.js';
import Navigation from './Navigation.js';
import ZoomImage from './ZoomImage.js';

(function() {

    new Navigation();
    let pathname = window.location.pathname;
    if (pathname == "/accueil/index") new ContainerItems();
    if (pathname == "/timbre/tout") new Filters();
    if (pathname == "/timbre/un") {
        new StarFavorite();
        new ZoomImage();
    }
    
    
    
})();