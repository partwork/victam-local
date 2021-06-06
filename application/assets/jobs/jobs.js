$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    loop: true,
    items: 4, // Select Item Number
    autoplay: true,
    nav: false,
    dots: true
    // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
  });
});

$(window).scroll(function () {
  var wh = $(window).height() - 50;
  if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
    $('.subscription-text').addClass('onScroll');
  }
});

