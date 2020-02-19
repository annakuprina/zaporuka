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
  if( $( ".pagination-block" ).length ) {
    $( ".pagination-block" ).wpPagination();
  }
  $.fn.wpPagination = function( options ) {
    options = $.extend({
      links: "a",
      action: "my_pagination",
      ajaxURL: "http://" + location.host + "/wp-admin/admin-ajax.php",
      next: ".next",
      previous: ".previous",
      disablePreviousNext: true
    }, options);

    function WPPagination( element ) {
      this.$el = $( element );
      this.init();
    }

    WPPagination.prototype = {
      init: function() {
        this.createLoader();
        this.handlePreviousNextLinks();
        this.handleLinks();
      },
      createLoader: function() {
        var self = this;
        self.$el.before( "<div id='pagination-loader'></div>" );
      },
      handlePreviousNextLinks: function() {
        var self = this;
        var $previous = $( options.previous, self.$el );
        var $next = $( options.next, self.$el );

        if( options.disablePreviousNext ) {
          $previous.remove();
          $next.remove();
        } else {
          $previous.addClass( "clicked" );
          $next.addClass( "clicked" );
        }
      },
      handleLinks: function() {
        var self = this,
            $links = $( options.links, self.$el ),
            $loader = $( "#pagination-loader" );

        $links.click(function( e ) {
          e.preventDefault();
          var $a = $( this ),
              url = $a.attr( "href" ),
              page = url.match( /\d+/ ), // Get the page number
              pageNumber = page[0],
              data = {
                action: options.action, // Pass the AJAX action name along with the page number
                page: pageNumber
              };

          if( !$a.hasClass( "clicked" ) ) { // We don't want duplicated posts

            $loader.show(); // Show the loader

            $.get( options.ajaxURL, data, function( html ) {
              $loader.hide(); // Hide the loader
              $loader.before( html ); // Insert posts
              $a.addClass( "clicked" ); // Flag the current link as clicked
            });

          }
        });
      }
    };

    return this.each(function() {
      var element = this;
      var pagination = new WPPagination( element );
    });
  };
});
