$js = jQuery;
$js.noConflict();
jQuery(function () {


    jQuery(document).ready(function ($js) {
        var paid_sum;
        if ($js('#paid').length > 0) {
            paid_sum = $js('#paid').val();
        }
        $js('#paid').on('input propertychange', function(){
            paid_sum = $js('#paid').val();
            $js.removeCookie('selected_cost', { path: '/' });
            $js.cookie('selected_cost', paid_sum);
        })

        if(!$js.cookie('selected_course') || $js.cookie('selected_course') == 'undefined') {
            $js.removeCookie('selected_course', { path: '/' });
            if($js('.textarea.sel').length > 0)
             $js.cookie('selected_course', $js('.textarea.sel').val());
            else
            if($js('input[name=menu]').length > 0)
                $js.cookie('selected_course', $js('input[name=menu]').val());
        }else{
            if($js('.textarea.sel').length > 0)
                $js.cookie('selected_course', $js('.textarea.sel').val());
            else
            if($js('input[name=menu]').length > 0)
                $js.cookie('selected_course', $js('input[name=menu]').val());
        }
        if(!$js.cookie('selected_cost') || $js.cookie('selected_cost') == 'undefined') {
            $js.removeCookie('selected_cost', { path: '/' });
            $js.cookie('selected_cost', paid_sum);
        }else{
            $js.cookie('selected_cost', paid_sum);
        }
        $js(document).on('change', 'input[name=payment_method]:radio', function () {
            var payment_mathod = $js(this).val();
            $js.ajax({
                type: "POST",
                url: ajaxurl,
                dataType: 'json',
                data: {"action": 'update_payment_mathod', 'payment_mathod': payment_mathod},
                success: function (res) {
                    $js('body').trigger('update_checkout');
                }
            })
        })
        if(liqpay_object.liqpay_converter_type != "none") {
            $js.ajax({
                type: "POST",
                url: ajaxurl,
                dataType: 'json',
                data: {"action": 'get_liqpay_exchange_courses'},
                success: function (res) {
                    $js('.textarea.sel').on('change', function () {

                        console.log("--11--", res);

                        if (res.default == 'uah') {
                            if ($js(this).val() == 'USD') {
                                $js('#paid').val((paid_sum / res.liqpay_exc_s_USD).toFixed(2))
                            }
                            if ($js(this).val() == 'EUR') {
                                $js('#paid').val((paid_sum / res.liqpay_exc_s_EUR).toFixed(2))
                            }
                            if ($js(this).val() == 'RUB') {
                                $js('#paid').val((paid_sum / res.liqpay_exc_s_RUB).toFixed(2))
                            }
                            if ($js(this).val() == 'UAH') {
                                $js('#paid').val(paid_sum)
                            }
                        }
                        else if (res.default == 'usd') {
                            if ($js(this).val() == 'USD') {
                                $js('#paid').val(paid_sum)
                            }
                            if ($js(this).val() == 'EUR') {
                                $js('#paid').val((paid_sum * res.liqpay_exc_s_USD / res.liqpay_exc_s_EUR).toFixed(2))
                            }
                            if ($js(this).val() == 'RUB') {
                                $js('#paid').val((paid_sum * res.liqpay_exc_s_USD / res.liqpay_exc_s_RUB).toFixed(2))
                            }
                            if ($js(this).val() == 'UAH') {
                                $js('#paid').val((paid_sum * res.liqpay_exc_s_USD).toFixed(2))
                            }
                        }

                    })
                    $js('.textarea.sel option').prop('selected', false);
                    if (!$js.cookie('selected_course')) {
                        $js('.textarea.sel option[value="' + res.default.toUpperCase() + '"]').attr("selected", "selected");
                    } else {
                        $js('.textarea.sel option[value="' + $js.cookie('selected_course').toUpperCase() + '"]').attr("selected", "selected");
                        $js('#paid').val($js.cookie('selected_cost'));
                    }
//    $js('#paid').val(res.default.toUpperCase());
                }
            })
        }

        if ($js('.textarea.sel').attr('readonly')) {
            $js('.textarea.val').width(86);
        }
        else {
            $js('.textarea.val').width(74);
            $js('.textarea.sel').height(20);
        }
        /*if($('input[readonly="readonly"]')){

        }*/

//$js('.flag').removeClass("usd eur rub"); 

        if (document.getElementsByName('menu').length) {
            $js('.flag').addClass(document.getElementsByName('menu')[0].value.toLowerCase());
        }



        $js('.textarea.sel').on('change', function () {

            if (this.value == "UAH") {
                $js('.flag').removeClass("usd eur rub");
                $js('.flag').addClass("uah", 1500, "easeOutBounce");

            }
            else if (this.value == "USD") {
                $js('.flag').removeClass("uah eur rub");
                $js('.flag').addClass("usd", 1500, "easeOutBounce");
            }
            else if (this.value == "EUR") {
                $js('.flag').removeClass("uah usd rub");
                $js('.flag').addClass("eur", 1500, "easeOutBounce");
            }
            else if (this.value == "RUB") {
                $js('.flag').removeClass("uah usd eur");
                $js('.flag').addClass("rub", 1500, "easeOutBounce");
            }
            else {
                $js('.flag').removeClass("usd eur rub");
                $js('.flag').addClass("uah");
            }
        });


    });

});