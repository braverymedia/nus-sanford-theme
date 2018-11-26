
// Inline all SVGs
new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));
new SVGInjector().inject(document.querySelectorAll('img[src$=".svg"]'));

// jQuery no conflict stuff
(function ($) {
  // Tooling for color + shadow effect
  function detectScrollDistance() {
    var scrollDistance = $(window).scrollTop();
    if ( scrollDistance >= 4 ) {
      $('body').addClass('scrolling');
    } else {
      $('body').removeClass('scrolling');
    }
  }
  // Add/remove the scrolling class
  detectScrollDistance();
  $(window).on('scroll', function() {
    detectScrollDistance();
  });

  $('.menu-toggle').on('click', function(){
    $('body').toggleClass('menu-open');
  });

})(jQuery, this);
