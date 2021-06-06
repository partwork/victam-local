$(window).scroll(function () {
    var wh = $(window).height() - 50;
    if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
      $('.subscription-text').addClass('onScroll');
    }
  });