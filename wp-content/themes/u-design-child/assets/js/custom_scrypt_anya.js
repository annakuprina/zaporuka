jQuery(document).ready(function($) {

  var callHelpPopup = false;
 
  //call help sms modal from header
  $("#custom-top-bar .top-bar-help-block a, #header-mob .top-bar-help-block a").click(function(e) {
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
  $(".help-header-link a,.mob-menu-right #menu-item-305 a, #menu-Futer-Dopomogti-ukr li:eq(0) a,#menu-Futer-Dopomogti-rus  li:eq(0) a,#menu-Futer-Dopomogti-en li:eq(0) a").click(function(e) {
    e.preventDefault();
    callHelpPopup = true;
    $("#ModalHelpForm").addClass("opened");
    $("body").addClass("noscroll");
  });
  //close help big modal
  $("#ModalHelpForm .closemodale").click(function(e) {
    e.preventDefault();
    callHelpPopup = false;
    $("#ModalHelpForm").removeClass("opened");
    $("body").removeClass("noscroll");
  });

  $(".home-page-section2 .section2-columns .section2-single-column").click(function() {
    var text = $(this).find(".vc_cta3-actions").find("a").attr("href");
      window.location.href = text;
    }
  );

  $(".help_form .amount-button").click(function(e) {
    e.preventDefault();
    var parent = jQuery(this).parent();
    parent.find('.amount-button').not(this).removeClass("active");
    $(this).toggleClass("active");
    $(parent).parent().find('.help-form-amount-left #paid').val($(this).attr("summ"));
  });

  $(".help_form #paid").on("input", function(e) {
    var parent = jQuery(this).parents('.help_form');
    parent.find('.amount-button').removeClass("active");
  });   

  $(".help_form .help-form-subscribe .subscribe-link").click(function(e) {
    e.preventDefault();
    var parent = jQuery(this).parents('.help_form');
    parent.find(".help-form-subscribe .subscribe-link").removeClass("active");
    $(this).addClass("active");
    parent.find('input[name="pay_type"]').val($(this).attr("paytype"));      
    change_payment_description($(this).attr("paytype"));
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
    message_oferta_required,
    onetime_project_label,
    subscribe_project_label,
    onetime_fond_lable,
    subscribe_fond_lable;
  if (lang === "uk") {
    message_amount_free = "Введіть суму";
    message_amount_not_number = "Введіть, будь ласка, тільки цифри";
    message_fio_free = "Введіть, будь ласка, ПІБ";
    message_fio_not_text = "Введіть, будь ласка, тільки текст";
    message_mail_required = "Введіть, будь ласка, emai";
    message_phone_required = "Введіть, будь ласка, номер телефону";
    message_phone_only_number = "Введіть, будь ласка, тільки цифри";
    message_oferta_required = "Погодьтесь, будь ласка, з офертою";
    onetime_project_label = "Одноразове перерахування коштів на проект ";
    subscribe_project_label = "Щомісячне перерахування коштів на проект ";
    onetime_fond_lable = "Одноразове пожертвування в БФ Запорука";
    subscribe_fond_lable = "Щомісячне перерахування коштів в БФ Запорука";
  } else if (lang === "ru-RU") {
    message_amount_free = "Введите сумму";
    message_amount_not_number = "Введите, пожалуйста, только цифры";
    message_fio_free = "Введите, пожалуйста, ФИО";
    message_fio_not_text = "Введите, пожалуйста, только текст";
    message_mail_required = "Введите, пожалуйста, email";
    message_phone_required = "Введите, пожалуйста, номер телефона";
    message_phone_only_number = "Введите, пожалуйста, только цифры";
    message_oferta_required = "Согласитесь, пожалуйста, с офертой";
    onetime_project_label = "Единоразовое перечисление средств на проект ";
    subscribe_project_label = "Ежемесячное перечисление средств на проект ";
    onetime_fond_lable = "Единоразовое пожертвование в БФ Запорука";
    subscribe_fond_lable = "Ежемесячное перечисление средств в БФ Запорука";
  } else if (lang === "en-US") {
    message_amount_free = "Enter amount";
    message_amount_not_number = "Please enter only numbers";
    message_fio_free = "Please enter your full name";
    message_fio_not_text = "Please enter only text";
    message_mail_required = "Please enter email";
    message_phone_required = "Please enter your phone number";
    message_phone_only_number = "Please enter only numbers";
    message_oferta_required = "Please agree with the offer";
    onetime_project_label = "One-time transfer of funds for the project ";
    subscribe_project_label = "Monthly transfer of funds for the project ";
    onetime_fond_lable = "One-time donation to the СF Zaporuka";
    subscribe_fond_lable = "Monthly transfer of funds to the BF Zaporuka";
  }

  var form_popup_parent = $( ".help_form" ).parents('.modal-body');
  var form_page_parent = $( ".help_form" ).parents('.wpb_wrapper');

  form_popup_parent.find('.help_form').validate({
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

  form_page_parent.find('.help_form').validate({
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

  //add payment description to Help form
  function change_payment_description(type_of_help){
     if(window.location.href.indexOf("/projects/") > -1) {
        var project_name = $('#page-title .single-pagetitle').text();
        var project_id_full =  $('.single-projects article.projects ').attr('id');
        var project_id_full_arr = project_id_full.split('-');
         var project_id = project_id_full_arr[1];
        if(type_of_help == 'pay'){
          $('.help_form #plata').val(onetime_project_label + project_name);
        }
        else{
          $('.help_form #plata').val(subscribe_project_label + project_name);
        }
        $('.help_form #liqpay_post_id').val(project_id);
      }
      else{
        if(type_of_help == 'pay'){
          $('.help_form #plata').val(onetime_fond_lable);
        }
        else{
          $('.help_form #plata').val(subscribe_fond_lable);
        }
        $('.help_form #liqpay_post_id').val('823'); //823 = project id of "Запорука" private project
      }
  }

  change_payment_description('pay');


  $('.cancel_subscription_form').submit(function(e){
    $.ajax({
          type: 'POST',
          dataType: 'json',
          url: MyAjax.ajaxurl,
          data: { 
              'action': 'send_cancel_subscription_email'
          },
          success: function(data){
             console.log(data.result );
            if( data.result ) {
              $('.cansel-message').show();
            }
            else{
              $('.cansel-message').text(data.message);
              $('.cansel-message').show();
            }
          }
      });
    e.preventDefault();
  });

});
