require(['jquery', 'OwlCarousel'], function($) { 
  $('#trustworthy_sec').owlCarousel({
    loop: true,
    rewind: true,
    nav: true,
    margin: 15,
    items:7,
    dots: false,autoplay: true,
    sautoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive:{
      0:{
        items:2
      },
      590:{
        items:4
      },
      768:{
        items:4
      },
      979:{
        items:5
      },
      1199:{
        items:6
      }
    }
  });

});
