jQuery(document).ready(function($) {
  //call help sms modal from header
  $(
    "#custom-top-bar .top-bar-help-block a, .mob-menu-right .top-bar-help-block a"
  ).click(function(e) {
    e.preventDefault();
    $("#sendSmsModalfromHeader").addClass("opened");
    $("body").addClass("noscroll");
  });
  //close help sms modal from header
  $("#sendSmsModalfromHeader .closemodale").click(function(e) {
    e.preventDefault();
    $("#sendSmsModalfromHeader").removeClass("opened");
    $("body").removeClass("noscroll");
  });

  //call help sms modal from help block
  $(".help-right .help-item .sms-popup-show").click(function(e) {
    e.preventDefault();
    $("#sendSmsModalfromHelpForm").addClass("opened");
    $("body").addClass("noscroll");
  });
  //close help sms modal from help block
  $(
    "#sendSmsModalfromHelpForm .closemodale, #sendSmsModalfromHelpForm .help-other"
  ).click(function(e) {
    e.preventDefault();
    $("#sendSmsModalfromHelpForm").removeClass("opened");
    $("body").removeClass("noscroll");
  });

  //call help big modal
  $(".help-header-link a, .mob-menu-right #menu-item-305 a").click(function(e) {
    e.preventDefault();
    $("#ModalHelpForm").addClass("opened");
    $("body").addClass("noscroll");
  });
  //close help big modal
  $("#ModalHelpForm .closemodale").click(function(e) {
    e.preventDefault();
    $("#ModalHelpForm").removeClass("opened");
    $("body").removeClass("noscroll");
  });

  $(".home-page-section2 .section2-columns .section2-single-column").click(
    function() {
      var text = $(this)
        .find(".vc_cta3-actions")
        .find("a")
        .attr("href");
      window.location.href = text;
    }
  );

  //show amount summ on click 100, 250, 1000  in help form
  $(".help-form-amount-right .amount-button").click(function(e) {
    e.preventDefault();
    $(".help-form-amount-right .amount-button")
      .not(this)
      .removeClass("active");
    $(this).toggleClass("active");
    $("#paid").val($(this).attr("summ"));
  });

  $("#paid").on("input", function(e) {
    $(".help-form-amount-right .amount-button").removeClass("active");
  });

  $(".help_form .help-form-subscribe .subscribe-link").click(function(e) {
    e.preventDefault();
    $(".help_form .help-form-subscribe .subscribe-link").removeClass("active");
    $(this).addClass("active");
    $('.help_form input[name="pay_type"]').val($(this).attr("paytype"));
  });

  //news orange gradient for items without photo
  setTimeout(function() {
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
  }, 2500);

  //scroll to help form on project page
  $(".custom-container .content_column.help_column p").click(function(e) {
    $("html, body").animate(
      {
        scrollTop: $("#help_section").offset().top - 100
      },
      1000
    );
  });

  //active tab for shop filter
  var path = window.location.pathname;
  $(
    ".woocommerce-custom-category-filter .category-filter-item a[href*='" +
      path +
      "']"
  ).addClass("active-filter");
  $(".woocommerce-custom-category-filter .category-filter-item a.active-filter")
    .parent()
    .addClass("active");

  $(
    ".woocommerce-custom-product-filter .filter-cart-price-wrapper .woocommerce-custom-price-filter a"
  ).click(function(e) {
    e.preventDefault();
    $(".woocommerce-hidden-price-filter").toggleClass("show-me");
    $(this).toggleClass("active-filter");
  });

  $(".main-menu-shop-link").prepend($(".cart-count-in-main-header"));

  //change original woo quantity

  jQuery(
    ".fake-count .quantity-numers .quantity-nav .quantity-button.quantity-up"
  ).click(function() {
    jQuery(
      ".woocommerce.single-product .cart .quantity .quantity-button.quantity-up"
    ).click();
  });
  jQuery(
    ".fake-count .quantity-numers .quantity-nav .quantity-button.quantity-down"
  ).click(function() {
    jQuery(
      ".woocommerce.single-product .cart .quantity .quantity-button.quantity-down"
    ).click();
  });

  //help form validation
  jQuery.validator.addMethod(
    "lettersonly",
    function(value, element) {
      return this.optional(element) || /^[a-zA-Z|а-яА-Я|\s]+$/i.test(value);
    },
    "Letters only please"
  );

  var lang = jQuery(".lang-item.current-lang a")[0].getAttribute("lang");
  var message_amount_free,
    message_amount_not_number,
    message_fio_free,
    message_fio_not_text,
    message_mail_required,
    message_phone_required,
    message_phone_only_number,
    message_oferta_required;
  if (lang === "uk") {
    message_amount_free = "Введіть суму";
    message_amount_not_number = "Введіть, будь ласка, тільки цифри";
    message_fio_free = "Введіть, будь ласка, ПІБ";
    message_fio_not_text = "Введіть, будь ласка, тільки текст";
    message_mail_required = "Введіть, будь ласка, emai";
    message_phone_required = "Введіть, будь ласка, номер телефону";
    message_phone_only_number = "Введіть, будь ласка, тільки цифри";
    message_oferta_required = "Погодьтесь, будь ласка, з офертою";
  } else if (lang === "ru-RU") {
    message_amount_free = "Введите сумму";
    message_amount_not_number = "Введите, пожалуйста, только цифры";
    message_fio_free = "Введите, пожалуйста, ФИО";
    message_fio_not_text = "Введите, пожалуйста, только текст";
    message_mail_required = "Введите, пожалуйста, email";
    message_phone_required = "Введите, пожалуйста, номер телефона";
    message_phone_only_number = "Введите, пожалуйста, только цифры";
    message_oferta_required = "Согласитесь, пожалуйста, с офертой";
  } else if (lang === "en-US") {
    message_amount_free = "Enter amount";
    message_amount_not_number = "Please enter only numbers";
    message_fio_free = "Please enter your full name";
    message_fio_not_text = "Please enter only text";
    message_mail_required = "Please enter email";
    message_phone_required = "Please enter your phone number";
    message_phone_only_number = "Please enter only numbers";
    message_oferta_required = "Please agree with the offer";
  }

  $(".help_form").validate({
    rules: {
      paid: {
        required: true,
        number: true
      },
      fio: {
        required: true,
        lettersonly: true
      },
      mail: {
        required: true,
        email: true
      },
      phone: {
        required: true,
        digits: true
      },
      oferta: {
        required: true
      }
    },
    messages: {
      paid: {
        required: message_amount_free,
        number: message_amount_not_number
      },
      fio: {
        required: message_fio_free,
        lettersonly: message_fio_not_text
      },
      mail: {
        required: message_mail_required,
        email: message_mail_required
      },
      phone: {
        required: message_phone_required,
        digits: message_phone_only_number
      },
      oferta: {
        required: message_oferta_required
      }
    }
  });
});
