//require
require('es6-promise').polyfill();

// import external dependencies
import 'jquery';
import 'axios';
import 'boxicons';
import 'slick-carousel';
import PhotoSwipeMounter from 'jquery.photoswipe';

// Import everything from autoload
import './autoload/**/*';
import './util/add-to-cart';
import './util/delete-product-mini-cart';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

// import custom files
import './shop-filter';
import './google-maps';

//Mount photoswipe
PhotoSwipeMounter(jQuery);
var slideSelector = 'img'
var options = {
  bgOpacity: 0.4,
  closeEl:true,
  captionEl: true,
  fullscreenEl: true,
  zoomEl: true,
  shareEl: true,
  counterEl: true,
  arrowEl: true,
  preloaderEl: true,
};

$('.single-product-component-hero-images').photoSwipe(
  slideSelector,
  options
);

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
    // Home page
    home,
    // About Us page, note the change from about-us to aboutUs.
    aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
