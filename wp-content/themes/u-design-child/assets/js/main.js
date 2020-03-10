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

  /*DONORS SLIDER*/
  $(".donors-mobile-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true
  });

  // lightbox for documents slider
  $(".documents-slider").slickLightbox({
    src: "src",
    itemSelector: ".documents-slide > img"
  });

  // $(".slide").slick({
  //   dots: false,
  //   infinite: true,
  //   speed: 300,
  //   slidesToShow: 1
  //   //adaptiveHeight: true
  // });

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

  //REWARDS SLIDER DESKTOP(index page)
  $(".rewards-desktop").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    verticalSwiping: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      }
    ]
  });

  //REWARDS SLIDER MOBILE(index page)
  $(".rewards-slider-mob").slick({
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    verticalSwiping: true
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

  /*DROPDOWN FOR SHOP PAGE MOBILE*/
  // Toggle dropdown
  $(".category-mob-select").on("click", function() {
    $(this)
      .closest("ul")
      .children("li")
      .slice(1)
      .slideToggle();
  });

  /*Change current category name inside dropdown*/
  k = 0;
  setInterval(function() {
    if (k == 0) {
      if ($("a").hasClass("active-filter")) {
        var currentCategory = $(".active-filter").text();
        $(".current-category-mob").text(currentCategory);
        k = 1;
      }
    }
  }, 10);

  /*DROPDOWN FOR NEWS PAGE MOBILE*/
  // console.log("prr");
  // $(".section-news .vc_grid-filter").prepend(
  //   "<li class='category-mob-select'>Всi новини111</li>"
  // );
});
