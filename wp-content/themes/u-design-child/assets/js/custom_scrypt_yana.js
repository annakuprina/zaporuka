jQuery(document).ready(function($) {
  $(function() {
    $(".one-tab-link").on("click", function() {
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
    slidesToScroll: 4
  });
  $(".write_about_us_carousel .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });

  var countProgress = function() {
    $(".other-projects-row .vc_grid-item").each(function() {
      var moneyTotalAmount = $(this)
        .find(".project-money-collected-inner")
        .text();
      var moneyCurrentCollected = $(this)
        .find(".project-money-quantity-inner")
        .text();
      var progressBarTimeline =
        (moneyCurrentCollected * 100) / moneyTotalAmount;
      $(this)
        .find(".progress-done")
        .width(progressBarTimeline + "%");
    });
  };
  countProgress();
  setTimeout(countProgress, 1000);
  $(".other-projects-single-project .vc_pageable-slide-wrapper").slick({
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 3
  });

  // $('.reviews-block').on('click', '.pagination-block a', function(e){
  //   e.preventDefault();
  //   $('.page-numbers').removeClass('current');
  //   $(this).addClass('current');
  //   var link = $(this).attr('href');
  //   $('.reviews-wrapper').fadeOut(0, function(){
  //     $(this).load(link + ' .reviews-wrapper', function() {
  //       $(this).fadeIn(0);
  //     });
  //   });
  // });
  $('.pagination-block').on('click', '#post', function(e) {
    console.log('pagClick');
    e.preventDefault();
    var nth  = jQuery("#post").attr('data-cpta');
    var lmt  = jQuery("#post").attr('data-limit');
    var ajax_url = ajax_params.ajax_url;
    var cpta = jQuery("#post").attr('data-posttype');
    jQuery.ajax({
      url		:ajax_url,
      type	:'post',
      data	:{ 'action':'cptapagination','number':nth,'limit':lmt,'cptapost':cpta },
      beforeSend	: function(){
        jQuery(".reviews-wrapper").html("<p style='text-align:center;'>Loading please wait...!</p>");
      },
      success :function(pvalue){
        jQuery(".reviews-wrapper").html(pvalue);
      }
    });
  });
});
