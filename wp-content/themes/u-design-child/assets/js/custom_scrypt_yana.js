jQuery(document).ready(function($) {
  $(function() {
    $(".one-tab-link").on("click", function() {
      $(".one-tab-link").removeClass("tab-active");
      $(this).addClass("tab-active");
      var clickedTitleDataId = $(this).attr("data-id"); //get data-id attribute of clicked title
      /*Find tab-content with same data-id attribute like clicked title*/
      $(".tabs_content").each(function() {
        var tabsContentDataId = $(this).attr("data-id");
        if (clickedTitleDataId == tabsContentDataId) {
          $(".tabs_content").removeClass("active");
          $(this).addClass("active");
        }
      });
    });
  });

  $(".carousel-news-posts .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });
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
          dots: true
        }
      },
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      }
    ]
  });
  $(".write_about_us_carousel .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });

  $(".other-projects-single-project .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });
  $(document).on("click", ".pagination-block a", function(e) {
    e.preventDefault();
    var nth = $(this).attr("data-cpta");
    var ajax_url = "/wp-content/themes/u-design-child/inc/custom_ajax.php";
    var prev = $(this).attr("data-prev");
    var post_type = $(this).attr("data-type");
    var limit = $(this).attr("data-limit");
    jQuery.ajax({
      url: ajax_url,
      type: "post",
      data: {
        custom_action: "true",
        number: nth,
        prev: prev,
        post_type: post_type,
        limit: limit
      },
      beforeSend: function() {
        $(".preloader").css("display", "block");
      },
      success: function(pvalue) {
        jQuery(".reviews-block").html(pvalue);
        $(".preloader").css("display", "none");
      }
    });
  });
  $(document).on("click", ".pagination-children a", function(e) {
    e.preventDefault();
    var nth = $(this).attr("data-cpta");
    var ajax_url = "/wp-content/themes/u-design-child/inc/custom_ajax.php";
    var prev = $(this).attr("data-prev");
    var post_type = $(this).attr("data-type");
    var limit = $(this).attr("data-limit");
    jQuery.ajax({
      url: ajax_url,
      type: "post",
      data: {
        show_children: "true",
        number: nth,
        prev: prev,
        post_type: post_type,
        limit: limit
      },
      beforeSend: function() {
        $(".preloader").css("display", "block");
      },
      success: function(pvalue) {
        jQuery(".children-block").html(pvalue);
        $(".preloader").css("display", "none");
      }
    });
  });
  $(".video_button").slickLightbox({});

  $(".post_photo_gallery").slick({
    dots: true,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1
  });
});
