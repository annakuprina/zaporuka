jQuery(document).ready(function ($) {
  $(function () {
    $(".one-tab-link").on("click", function () {
      $(".one-tab-link").removeClass("tab-active");
      $(this).addClass("tab-active");
      var clickedTitleDataId = $(this).attr("data-id"); //get data-id attribute of clicked title
      /*Find tab-content with same data-id attribute like clicked title*/
      $(".tabs_content").each(function () {
        var tabsContentDataId = $(this).attr("data-id");
        if (clickedTitleDataId == tabsContentDataId) {
          $(".tabs_content").removeClass("active");
          $(this).addClass("active");
        }
      });
    });
  });

  // One Project page. Project news carousel
  $(".carousel-news-posts .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
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

  $(".write_about_us_carousel .write-about-us-slick-desk").slick({
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

  $(".other-projects-single-project .vc_pageable-slide-wrapper").slick({
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

  /*About us page / Block "what we do" With projects*/
  $(".about-us-project-section .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
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

  $(document).on("click", ".pagination-block a", function (e) {
    e.preventDefault();
    var nth = $(this).attr("data-cpta");
    var ajax_url = "/wp-content/themes/u-design-child/inc/custom_ajax.php";
    var post_type = $(this).attr("data-type");
    var limit = $(this).attr("data-limit");
    var pag_check = $(".pagination-check").attr("data-type");
    jQuery.ajax({
      url: ajax_url,
      type: "post",
      data: {
        custom_action: "true",
        number: nth,
        post_type: post_type,
        limit: limit,
        pag_check: pag_check,
      },
      beforeSend: function () {
        $(".preloader").css("display", "block");
      },
      success: function (pvalue) {
        jQuery(".reviews-block").html(pvalue);
        $(".preloader").css("display", "none");
      },
    });
  });
  $(document).on("click", ".pagination-children a", function (e) {
    e.preventDefault();
    var nth = $(this).attr("data-cpta");
    var ajax_url = "/wp-content/themes/u-design-child/inc/custom_ajax.php";
    var post_type = $(this).attr("data-type");
    var limit = $(this).attr("data-limit");
    jQuery.ajax({
      url: ajax_url,
      type: "post",
      data: {
        show_children: "true",
        number: nth,
        post_type: post_type,
        limit: limit,
      },
      beforeSend: function () {
        $(".preloader").css("display", "block");
      },
      success: function (pvalue) {
        jQuery(".children-block").html(pvalue);
        $(".preloader").css("display", "none");
      },
    });
  });
  $(".video_button").slickLightbox({});

  $(".post_photo_gallery").slick({
    dots: true,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
  });

  /*FDunction fo Formatting prices. Split by 3 numbers*/
  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
  }

  $(window).bind("grid:items:added", function () {
    $(".other-projects-row .vc_grid-item").each(function () {
      var moneyTotalAmount = $(this)
        .find(".project-money-collected-inner")
        .text();

      /*variable with formatted number*/
      var moneyTotalAmountFormatted = formatNumber(moneyTotalAmount);
      /*return formatted number the to block*/
      $(this)
        .find(".project-money-collected-inner")
        .text(moneyTotalAmountFormatted);
      if (moneyTotalAmount == "") {
        $(this)
          .find($(".singl-project-timeline-custom"))
          .css("display", "none");
      } else {
        var moneyCurrentCollected = $(this)
          .find(".project-money-quantity-inner")
          .text();

        /*variable with formatted number*/
        var moneyCurrentCollectedFormatted = formatNumber(
          moneyCurrentCollected
        );
        /*return formatted number the to block*/
        $(this)
          .find(".project-money-quantity-inner")
          .text(moneyCurrentCollectedFormatted);
        var progressBarTimeline =
          (moneyCurrentCollected * 100) / moneyTotalAmount;
        $(this)
          .find(".progress-done")
          .width(progressBarTimeline + "%");
      }
    });

    /*Formatting numbers on all pages*/
    $(
      "span.woocommerce-Price-amount.amount , .one-project span.project-money-quantity, .project-money-quantity-inner, .project-money-collected-inner, .left-to-collect-amount"
    ).each(function () {
      var currentNumber = $(this).text(); /*get current not formated number*/
      var formattedNumber = formatNumber(
        currentNumber
      ); /*format the number(split by 3 numbers)*/
      $(this).text(formattedNumber); /*return formatted number to block*/
    });

    var lang = jQuery(".lang-item.current-lang a")[0].getAttribute("lang");
    var phone_label;
    if (lang === "en-US") {
      $(".field_5e1d98b8bab85_labeled span").each(function () {
        $(this).text("phone: ");
      });
    }
  });
});
