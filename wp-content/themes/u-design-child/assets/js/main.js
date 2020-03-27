jQuery(document).ready(function($) {
  // PARTNERS SLIDER DESKTOP
  $(".partners-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    // autoplay: true
    autoplaySpeed: 10000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
        }
      }
    ]
  });

  // PARTNERS SLIDER MOBILE
  $(".partners-slider-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
  });


  // About us page. Write about us slider. Mobile  
  $(".write-about-us-slick-mob").slick({
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


  // make link inside Label tag clickable (contact form, "oferta" link)
  $(document).on("tap click", 'label a', function( event, data ){
    event.stopPropagation();
    event.preventDefault();
    window.open($(this).attr('href'), $(this).attr('target'));
    return false;
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

  /*ONE PROJECT PAGE. PARTNERS SLIDER MOBILE*/
  $(".project-partners-slick-mob").slick({
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
  });

  //REWARDS SLIDER DESKTOP(index page)
  $(".rewards-desktop").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
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

  //RELATED PRODUCTS SLIDER (single product page)
  $(".single-product ul.products").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    // responsive: [
    //   {
    //     breakpoint: 950,
    //     settings: {
    //       slidesToShow: 2,
    //       slidesToScroll: 2,
    //       infinite: true,
    //       dots: true
    //     }
    //   },
    //   {
    //     breakpoint: 600,
    //     settings: {
    //       slidesToShow: 1,
    //       slidesToScroll: 1,
    //       infinite: true,
    //       dots: true
    //     }
    //   }
    // ]
  });

  //REWARDS SLIDER MOBILE(index page)
  $(".rewards-slider-mob").slick({
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        }
      }
    ]
  });

  //ABOUT US PAGE.DOCUMENTS BLOCK. Mobile
  $(".shortcode-fund-documents-mob .fund-documents-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    // responsive: [
    //   {
    //     breakpoint: 600,
    //     settings: {
    //       slidesToShow: 1,
    //       slidesToScroll: 1,
    //       infinite: true,
    //     }
    //   }
    // ]

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

  /*DROPDOWNS FOR SHOP AND REPORTS PAGES MOBILE*/
  // Toggle dropdown
  $(".category-mob-select").on("click", function() {
    $(this)
      .closest("ul")
      .children("li")
      .slice(1)
      .toggle();

    $(this)
      .parent()
      .toggleClass("active");

    $(this)
      .not(".one-tab-link,.reports-list-title")
      .find(".category-expand-button")
      .toggleClass("active");
  });

  /*Change current category name inside dropdown on Shop page*/
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

  $(".list_reports_wrapper ul li").on("click", function() {
    $(this)
      .closest("ul")
      .children("li")
      .slice(1)
      .toggle();
    $(this)
      .parent()
      .toggleClass("active");

    var currentYear = $(this).text();
    $(".reports-list-title span:eq(0)").text(currentYear);
    $(".list_reports_wrapper .category-expand-button").toggleClass("active");
  });
  /*DROPDOWN FOR NEWS PAGE MOBILE*/
  // console.log("prr");
  // $(".section-news .vc_grid-filter").prepend(
  //   "<li class='category-mob-select'>Всi новини111</li>"
  // );

  /*Count progressbar width*/
  var countProgress = function() {
    jQuery(".other-projects-row .vc_grid-item").each(function() {
      var moneyTotalAmount = jQuery(this)
        .find(".project-money-collected-inner")
        .text();
      var moneyCurrentCollected = jQuery(this)
        .find(".project-money-quantity-inner")
        .text();
      var progressBarTimeline =
        (moneyCurrentCollected * 100) / moneyTotalAmount;
      jQuery(this)
        .find(".progress-done")
        .width(progressBarTimeline + "%");
    });
  };
  countProgress();
  //setInterval(countProgress, 1000);

  /*Set orange background for news without pictures*/
  $(window).bind( 'grid:items:added', function(){
    $(".section-news-hover-wrapper").each(function(index) {
      if (
        $(this)
          .find(".vc_gitem-zone-img")
          .attr("src")
          .indexOf("vc_gitem_image.png") >= 0
      ) {
        $(this).addClass("no-background-image");
        $(this).attr(
          "style",
          "background-image: linear-gradient(224deg, #f3ae43 0%, #e78b48 100%)!important"
        );
      } else {
        $(this).addClass("is-background-image");
      }
    });
  });

});
