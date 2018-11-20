
// Inline all SVGs
new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));
new SVGInjector().inject(document.querySelectorAll('img[src$=".svg"]'));

// jQuery no conflict stuff
(function ($) {

})(jQuery, this);
