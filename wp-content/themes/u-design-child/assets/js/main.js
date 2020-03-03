jQuery(document).ready(function($) {
  // PARTNERS SLIDER DESKTOP
  $(".partners-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    // autoplay: true
    autoplaySpeed: 10000
  });

  // PARTNERS SLIDER MOBILE
  $(".partners-slider-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true
  });

  // FRIENDS SLIDER (DESKTOP AND MOBILE)
  $(".friends-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true
  });

  // VOLUNTEERS SLIDER DESKTOP
  $(".volunteers-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true
  });

  // VOLUNTEERS SLIDER MOB
  $(".volunteers-slider-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true
  });

  // PHOTO SLIDER
  $(".photo-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  // lightbox for photo slider
  $(".photo-slider").slickLightbox({
    src: "src",
    itemSelector: ".photo-slide > img"
  });

  // VIDEO SLIDER
  $(".video-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  // lightbox for video slider
  $(".video-slider").slickLightbox({});

  // DOCUMENTS SLIDER
  $(".documents-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  // lightbox for documents slider
  $(".documents-slider").slickLightbox({
    src: "src",
    itemSelector: ".documents-slide > img"
  });

  $(".slide").slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1
    //adaptiveHeight: true
  });

  /*TABS WITH SLIDERS. one project page*/
  $(".sliders-tabs-wrapper .one-tab-link").on("click", function() {
    $(".sliders-tabs-wrapper .one-tab-link").removeClass("tab-active");
    $(this).addClass("tab-active");

    var clickedTitleDataId = $(this).attr("data-id"); //get data-id attribute of clicked title
    /*Find tab-content with same data-id attribute like clicked title*/
    $(".slider_tabs_content").each(function() {
      var tabsContentDataId = $(this).attr("data-id");
      if (clickedTitleDataId == tabsContentDataId) {
        $(".slider_tabs_content ").css({
          "z-index": "-1",
          position: "absolute"
        });
        $(this).css({ "z-index": "1", position: "relative" });
      }
    });
  });

  /*home-page-section3 Owl carousel(adaptivity from 1140px to 768px).
  This carousel is made using plugin "Post Slider Carousel & Custom Post Grids".
  Horizontal  slider with 2 slides. Visible  from 1140px to 768px. 
  For screen less then 768px owl slider from plugin is hidden,and vertical slick slider is shown.
  And uses Owl carousel. There is no possibility to make carousel adaptive, using admin panel.
  So on window resize we should destroy existing carousel and show 2 or 3 slides, depending on window size.*/

  $(window)
    .on("resize", function() {
      if ($(window).width() < 1140) {
        $(".owl-carousel").owlCarousel("destroy");
        $(".owl-carousel").owlCarousel({
          items: 2,
          nav: false
        });
      } else {
        $(".owl-carousel").owlCarousel("destroy");
        $(".owl-carousel").owlCarousel({
          items: 3,
          nav: false
        });
      }
    })
    .resize();

  //home-page-section3 Slick carousel(Mobile version for screens less then 768px).
  $(".rewards-slider").slick({
    dots: true,
    arrows: false,
    vertical: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    verticalSwiping: true
    // width: 250
  });

  $(".header-mob-lang-switcher").click(function() {
    $(".header-mob-lang").slideToggle();
    $(this)
      .find(".expand-button")
      .toggleClass("expand-button-opened");
  });

  $(".header-mob-top").click(function() {
    $(".header-mob-bottom").slideToggle();
    $(".header-mob-logo img").toggleClass("active");
    $("#header-mob").toggleClass("active");
    $(".hamburger").toggleClass("active");
    $(".header-mob-top .close").toggleClass("active");
  });
  // $(window)
  //   .on("resize", function() {
  //     var maxHeight = -1;
  //     $(".rewards-slide").each(function() {
  //       if ($(this).height() > maxHeight) {
  //         maxHeight = $(this).height();
  //       }
  //     });
  //     $(".rewards-slide").each(function() {
  //       if ($(this).height() < maxHeight) {
  //         $(this).css(
  //           "margin",
  //           Math.ceil((maxHeight - $(this).height()) / 2) + "px 0"
  //         );
  //       }
  //     });
  //   })
  //   .resize();
});
