$js = jQuery;
$js.noConflict();
jQuery(function () {


    jQuery(document).ready(function ($js) {
        $js("#pay_type").on("change", function () {

            if (this.value == "subscribe") {
                $js("#subscribe_type").css("display", "inline-block");
            } else {
                $js("#subscribe_type").css("display", "none");
            }
        })
        if ($js("[name='liqpay_thanks']").val() == "yes") {
            $js("tr.link_to_page").hide();
            $js("tr.link_to_page").hide();
        }else{
            $js(".thank_page_content").hide();
        }

        $js("[name='liqpay_thanks']").on("change", function () {
            if ($js(this).val() == "yes") {
                $js("tr.link_to_page").toggle("slow");
                $js(".thank_page_content").toggle("slow");
            } else {
                $js("tr.link_to_page").toggle("slow");
                $js(".thank_page_content").toggle("slow");
            }
        })
    });

});