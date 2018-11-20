
// Inline all SVGs
new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));
new SVGInjector().inject(document.querySelectorAll('img[src$=".svg"]'));

// jQuery no conflict stuff
(function ($) {
  // Header color effect
  function detectScrollDistance() {
    var scrollDistance = $(window).scrollTop();
    console.log(scrollDistance);
    if ( scrollDistance >= 4 ) {
      $('body').addClass('scrolling');
    } else {
      $('body').removeClass('scrolling');
    }
  }
  if ( $('body').hasClass('home') ) {
    detectScrollDistance();
    $(window).on('scroll', function() {
      detectScrollDistance();
    })
  }

})(jQuery, this);
