jQuery(document).ready(function($) {
  // PARTNERS SLIDER DESKTOP
  $(".partners-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    // autoplay: true
    autoplaySpeed: 10000
  });

  // PARTNERS SLIDER MOBILE
  $(".partners-slider-mob").slick({
    dots: true,
    vertical: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    verticalSwiping: true
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

  // PHOTO SLIDER
  $(".photo-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true
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
    dots: true
  });
  // lightbox for video slider
  $(".video-slider").slickLightbox({});

  // DOCUMENTS SLIDER
  $(".documents-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true
  });

  // lightbox for documents slider
  $(".documents-slider").slickLightbox({
    src: "src",
    itemSelector: ".documents-slide > img"
  });


   // hide all sliders inside tab content wrapper but first slider
  $(".media-slider:not(:eq(0))").css("opacity", "0");

  /*CHANGE SLIDER (Photo, Video or Documents by click on appropriate on tab)*/
  $(".media-slider-one-tab").on("click", function() {
    var clickedTabDataId = $(this).attr("data-id"); //get data-id attribute of clicked tab
    /*Find tab-content with same data-id attribute like clicked title*/
    $(".media-slider").each(function() {

	    var tabsContentDataId = $(this).attr("data-id");
	    /*hide all sliders but the slider with the same data-id like clicked tab*/
	    if (clickedTabDataId == tabsContentDataId) {

		    var currentSliderHeight = jQuery(this).height();/*array with sliders should have the same height like current visible slider.*/
		    $(".media-sliders-wrapper").height(currentSliderHeight + 50);
	        $(".media-slider").css({"opacity": "0","z-index":"-1"});
	        $(this).css({"opacity": "1","z-index":"3"});

	    }
    });

    /*if second tab is clicked*/
	if ( $(this).attr("data-id") == 2 ) {
		console.log('this is 2');
		// console.log('offset'+$(this).position().left);

		$(this).position().left;
	    var currentSliderHeight = $(".media-slider:eq(1)").height();/*count height of current visible slider.*/
		$(".media-slider:eq(1)").css('top', - (currentSliderHeight - 35) + 'px')
	}


    /*if third tab is clicked*/
	if ( $(this).attr("data-id") == 3 ) {
		console.log('this is 3');
	    var currentSliderHeight = $(".media-slider:eq(2)").height();/*count height of current visible slider.*/
	    var previousSliderHeight = $(".media-slider:eq(1)").height();/*count height of previous visible slider.*/
		$(".media-slider:eq(2)").css('top', - (currentSliderHeight + previousSliderHeight - 72) + 'px')
	}
  });

   $('.slide').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      //adaptiveHeight: true
    });


	$('#tabs').tabs().find( 'ul.ui-tabs-nav a' ).bind( 'click', function(e){
        e.preventDefault();
	});


    $('.media-slider-one-tab').click(function(e){
       $(".slick-media-slider").slick('refresh');
    });

    $('.proj-timeline-one-step').click(function(e){
       $(".slick-media-slider").slick('refresh');
    });


});
