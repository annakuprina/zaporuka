jQuery(document).ready(function ($) {
  // Homepage. Parnters slider. Desktop
  $(".home-parnters-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    waitForAnimate: false,
  });

  // Homepage. Parnters slider. Mobile
  $(".home-parnters-slider-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    waitForAnimate: false,
  });

  // About us page. Write about us slider. Mobile
  $(".write-aboutus-carousel-mob-wrapper .write-about-us-slick-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    waitForAnimate: false,
  });

  // FRIENDS SLIDER (DESKTOP AND MOBILE)
  $(".friends-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    waitForAnimate: false,
  });

  // PHOTO SLIDER
  $(".photo-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  // lightbox for photo slider
  $(".photo-slider").slickLightbox({
    src: "src",
    itemSelector: ".photo-slide > img",
  });

  // VIDEO SLIDER
  $(".video-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  // lightbox for video slider
  $(".video-slider").slickLightbox({});

  // DOCUMENTS SLIDER
  $(".documents-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  // lightbox for documents slider
  $(".documents-slider").slickLightbox({
    src: "src",
    itemSelector: ".documents-slide > img",
  });

  // make link inside Label tag clickable (contact form, "oferta" link)
  $(document).on("tap click", "label a", function (event, data) {
    event.stopPropagation();
    event.preventDefault();
    window.open($(this).attr("href"), $(this).attr("target"));
    return false;
  });

  /*TABS WITH SLIDERS. one project page*/
  $(".sliders-tabs-wrapper .one-tab-link").on("click", function () {
    $(".sliders-tabs-wrapper .one-tab-link").removeClass("tab-active");
    $(this).addClass("tab-active");

    var clickedTitleDataId = $(this).attr("data-id"); //get data-id attribute of clicked title
    /*Find tab-content with same data-id attribute like clicked title*/
    $(".slider_tabs_content").each(function () {
      var tabsContentDataId = $(this).attr("data-id");
      if (clickedTitleDataId == tabsContentDataId) {
        $(".slider_tabs_content ").css({
          "z-index": "-1",
          position: "absolute",
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
    waitForAnimate: false,
  });

  //REWARDS SLIDER DESKTOP(index page)
  $(".rewards-desktop").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true,
        },
      },
    ],
  });

  //RELATED PRODUCTS SLIDER (single product page)
  $(".single-product ul.products").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 950,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true,
        },
      },
    ],
  });

  //REWARDS SLIDER MOBILE(index page)
  $(".rewards-slider-mob").slick({
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
    ],
  });

  //ABOUT US PAGE.DOCUMENTS BLOCK. Mobile
  $(".shortcode-fund-documents-mob .fund-documents-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 2,
    slidesToScroll: 2,
    infinite: true,
    waitForAnimate: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  // change arrow near language switcher in header menu
  $(".header-mob-lang-switcher").click(function () {
    $(".header-mob-lang").slideToggle();
    $(this).find(".expand-button").toggleClass("expand-button-opened");
  });

  $(
    ".header-mob-nav, #header-mob #navigation-menu a, .top-bar-help-block a, .help-header-link a"
  ).click(function () {
    if ($("#header-mob").css("display") == "flex") {
      $(".header-mob-bottom").slideToggle();
      $(".header-mob-logo img").toggleClass("active");
      $("#header-mob").toggleClass("active");
      $(".hamburger").toggleClass("active");
      $(".header-mob-top .close").toggleClass("active");
    }
  });

  /*DROPDOWNS FOR SHOP AND REPORTS PAGES MOBILE*/
  // Toggle dropdown
  $(".category-mob-select").on("click", function () {
    $(this).closest("ul").children("li").slice(1).toggle();

    $(this).parent().toggleClass("active");

    $(this)
      .not(".one-tab-link,.reports-list-title")
      .find(".category-expand-button")
      .toggleClass("active");
  });

  /*Change current category name inside dropdown on Shop page*/
  k = 0;
  setInterval(function () {
    if (k == 0) {
      if ($("a").hasClass("active-filter")) {
        var currentCategory = $(".active-filter").text();
        $(".current-category-mob").text(currentCategory);
        k = 1;
      }
    }
  }, 10);

  $(".list_reports_wrapper ul li").on("click", function () {
    $(this).closest("ul").children("li").slice(1).toggle();
    $(this).parent().toggleClass("active");

    var currentYear = $(this).text();
    $(".reports-list-title span:eq(0)").text(currentYear);
    $(".list_reports_wrapper .category-expand-button").toggleClass("active");
  });

  /*Count progressbar width*/
  var countProgress = function () {
    jQuery(".other-projects-row .vc_grid-item").each(function () {
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

  /*Set orange background for news without pictures*/
  $(window).bind("grid:items:added", function () {
    $(".section-news-hover-wrapper").each(function (index) {
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

  /*1 Article page. Post photo gallery. Contains photo with different height.
  Make slick slider change it's height that equals current active slide height.*/
  function updateHeightPhotoGallery() {
    $(".post_photo_gallery")
      .find(".slick-list")
      .height(
        $(".post_photo_gallery").find(".slick-slide.slick-active").height()
      ); //count current active slide height.
  }

  $(".post_photo_gallery .slick-dots li").each(function (index) {
    $(this).click(function () {
      //by click on navigation dots
      $(".post_photo_gallery") = $(this);
      setTimeout(updateHeightPhotoGallery, 500); //change slider's height.
    });
  });

  /*initialize wow animations*/

  new WOW().init();

  var maxItems = $(
    ".project-partners-carousel .vc_pageable-slide-wrapper"
  ).children("div").length;
  if (maxItems > 4) {
    $(".project-partners-carousel").addClass(
      "project-partners-carousel-initialized"
    );

    maxItems = 4;
    $(".project-partners-carousel .vc_pageable-slide-wrapper").slick({
      dots: true,
      arrows: false,
      slidesToShow: 4,
      slidesToScroll: 4,
      waitForAnimate: false,

      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 900,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            dots: true,
          },
        },
      ],
    });
  } else {
    $(".project-partners-carousel").addClass(
      "project-partners-carousel-not-initialized"
    );
  }
  $(".partners-slider2").slick({
    slidesToShow: maxItems,
    slidesToScroll: maxItems,
    arrows: false,
    dots: true,
    waitForAnimate: false,
  });

  /* For One product and Shop pages. Detect user device. 
  If device is tablet or mobile then add class "product-mobile" to one product item.
  If device is desktop add class "product-desktop" */

  /*detect device. If it is mobile device*/
  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    $(".product").addClass("product-mobile");
  } else {
    /*If it desktop*/
    $(".product").addClass("product-desktop");
  }

  /*Check if homepage contains Thanks block. Then add class "homepage-banner-with-thanks-block" to banner block*/
  if ($("div").hasClass("home-first-thanks-block")) {
    $(".homepage-banner").addClass("homepage-banner-with-thanks-block");
  }

  /*Check if homepage contains payment-cancel block. Then add class "homepage-banner-payment-cancel" to banner block*/
  if ($("div").hasClass("home-first-payment-cancel")) {
    $(".homepage-banner").addClass("homepage-banner-payment-cancel");
  }

  /*One product page. Check value of product number(input field).
  If number = 1 the make minus btn disable(add class).
  If number is > 9, then move minus to the right*/
  var currentCounterValue = $("#shop-counter").val();
  currentCounterValue == 1
    ? $(".quantity-down").addClass("disable")
    : $(".quantity-down").removeClass("disable");

  $("#shop-counter").on("change paste keyup", function () {
    var currentCounterValue = $(this).val();
    console.log(currentCounterValue);
    currentCounterValue > 9
      ? $(".quantity-down").addClass("move-right")
      : $(".quantity-down").removeClass("move-right");
    currentCounterValue == 1
      ? $(".quantity-down").addClass("disable")
      : $(".quantity-down").removeClass("disable");
  });

  /*DETECT IOS DEVICE. add class "iosDevice" to the body if IOS is detected.*/
  var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
  if (iOS == true) {
    $("body").addClass("iosDevice");
  }
});
