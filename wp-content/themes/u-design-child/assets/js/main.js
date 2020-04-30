jQuery(document).ready(function ($) {
  // Homepage. Parnters slider. Desktop
  $(".home-parnters-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });

  // Homepage. Parnters slider. Mobile
  $(".home-parnters-slider-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });

  // About us page. Write about us slider. Mobile
  $(".write-aboutus-carousel-mob-wrapper .write-about-us-slick-mob").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });

  // FRIENDS SLIDER (DESKTOP AND MOBILE)
  $(".friends-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
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
  });

  // $(window).on("resize", function() {
  //   $(".project-partners-slick-mob").slick('reinit');
  //   $(".project-partners-slick-mob .slick-dots:not(:first-child)").slice(1).remove();
  // }).resize();

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

  //
  $(
    ".header-mob-nav, #header-mob #navigation-menu a, .top-bar-help-block a, .help-header-link a"
  ).click(function () {
    $(".header-mob-bottom").slideToggle();
    $(".header-mob-logo img").toggleClass("active");
    $("#header-mob").toggleClass("active");
    $(".hamburger").toggleClass("active");
    $(".header-mob-top .close").toggleClass("active");
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
  /*DROPDOWN FOR NEWS PAGE MOBILE*/
  // console.log("prr");
  // $(".section-news .vc_grid-filter").prepend(
  //   "<li class='category-mob-select'>Всi новини111</li>"
  // );

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
  });

  /*fix for IOS mobile. Single product page.Ralated products block.
  When user swipes slider with related product click(tap) effect appears.
  This fix removes click(tap) effect from swipe event*/
  // $(".woocommerce.single-product .related ul.products li.product").on(
  //   "hover",
  //   function (event) {
  //     $(this).toggleClass("related-product-active");
  //   }
  // );

  var isMobile = false; //initiate as false
  // device detection
  if (
    /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
      navigator.userAgent
    ) ||
    /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
      navigator.userAgent.substr(0, 4)
    )
  ) {
    isMobile = true;
  }

  if ((isMobile = true)) {
    $(".woocommerce.single-product .related ul.products li.product:not(a)").on(
      "click",
      function (event) {
        $(this).toggleClass("related-product-active");
      }
    );

    document.addEventListener("touchstart", handleTouchStart, false);
    document.addEventListener("touchmove", handleTouchMove, false);

    var xDown = null;
    var yDown = null;

    function getTouches(evt) {
      return (
        evt.touches || evt.originalEvent.touches // browser API
      ); // jQuery
    }

    function handleTouchStart(evt) {
      const firstTouch = getTouches(evt)[0];
      xDown = firstTouch.clientX;
      yDown = firstTouch.clientY;
    }

    function handleTouchMove(evt) {
      if (!xDown || !yDown) {
        return;
      }

      $(
        ".woocommerce.single - product.related ul.products li.product: not(a)"
      ).removeClass("related-product-active");

      /* reset values */
      xDown = null;
      yDown = null;
    }
  } else {
    $(".woocommerce.single-product .related ul.products li.product").on(
      "hover",
      function (event) {
        $(this).toggleClass("related-product-active");
      }
    );
  }

  // var touchmoved;
  // $(".woocommerce.single-product .related ul.products li.product")
  //   .on("touchend", function (e) {
  //     if (touchmoved != true) {
  //       // button click action
  //       console.log("you clicked!")
  //     }
  //   })
  //   .on("touchmove", function (e) {
  //     touchmoved = true;
  //   })
  //   .on("touchstart", function () {
  //     touchmoved = false;
  //   });

  /*Check if homepage contains Thanks block. Then add class "homepage-banner-with-thanks-block" to banner block*/
  if ($("div").hasClass("home-first-thanks-block")) {
    $(".homepage-banner").addClass("homepage-banner-with-thanks-block");
  }

  /*Check if homepage contains payment-cancel block. Then add class "homepage-banner-payment-cancel" to banner block*/
  if ($("div").hasClass("home-first-payment-cancel")) {
    $(".homepage-banner").addClass("homepage-banner-payment-cancel");
  }

  /*Iphone check. To add specific positions to cart */
  // var isIOS =
  //   /iPhone/.test(navigator.platform) ||
  //   (navigator.platform === "MacIntel" && navigator.maxTouchPoints > 1);

  // if (isIOS == true) {
  //   $(".single-product").css("color", "red !important");
  // }

  /*Check if count of products in cart is 1 then add class "disable" to minus*/

  /*1 Product page. Ralated products carousel.Every related produc
  has 2 sides: front and back. This code removes link to the product on front side */
  $(".products .product>.woocommerce-LoopProduct-link").removeAttr("href");
});
