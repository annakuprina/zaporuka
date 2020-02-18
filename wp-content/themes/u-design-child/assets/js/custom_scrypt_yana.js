jQuery(document).ready(function($) {
  $(function() {
    $(".one-tab-link").on("click", function() {
      console.log("tab is clicked");
      $(this).addClass("tab-active");

      var clickedTitleDataId = $(this).attr("data-id"); //get data-id attribute of clicked title
      console.log("clicked" + clickedTitleDataId);
      /*Find tab-content with same data-id attribute like clicked title*/
      $(".tabs_content").each(function() {
        var tabsContentDataId = $(this).attr("data-id");
        console.log("we have content with id " + tabsContentDataId);

        if (clickedTitleDataId == tabsContentDataId) {
          console.log("the same like " + clickedTitleDataId);

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

  $('.reviews-wrapper').on('click', '.pagination a', function(e){
    e.preventDefault();
    var link = $(this).attr('href');
    $('.reviews-wrapper').fadeOut(500, function(){
      $(this).load(link + ' #content', function() {
        $(this).fadeIn(500);
      });
    });
  });

});
