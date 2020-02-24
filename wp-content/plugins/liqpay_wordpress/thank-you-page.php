<?php

if (!isset($wpdb))

    require_once('../../../wp-config.php');

?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" type="text/css" media="all">

    <script>

        $js = jQuery;

        $js.noConflict();

        $js(function () {

            $js(document).ready(function ($js) {

                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

                var status = '';

                var params = {};

                var get_payment_status;

                window.location.search

                    .replace(/[?&]+([^=&]+)=([^&]*)/gi, function (str, key, value) {

                            params[key] = value;

                        }

                    );



                var order_id;

                if (params.server_order_id) {

                    order_id = params.server_order_id;

                }



                /*$js.ajax({

                    type: "POST",

                    url: ajaxurl,

                    async: false,

                    data: {"action": 'get_payment_status', 'server_order_id': order_id},

                    success: function (res) {

                        status = res;

                    }

                })*/



                get_payment_status = setInterval(function () {

                    $js.ajax({

                        type: "POST",

                        url: ajaxurl,

                        data: {"action": 'get_payment_status', 'server_order_id': order_id},

                        success: function (res) {




                            if (status != res) {

                                status = res;

                                location.reload();

                            }else {
                               

                                if (status == "failure" || status == "success" || status == "sandbox") {
                                    clearInterval(get_payment_status);
                                    console.log('post-interval');

                                }

                            }

                        }

                    })



                }, 3000);



            });



        });

    </script>



<?php





if (isset($_REQUEST['action']) && $_REQUEST['action'] == "thank_you_page_state") {

    $order_id = $_REQUEST["order_id"];

    $status = $_REQUEST["status"];

    print_r($_REQUEST['action']);

    update_option('liqpay_thankyou_' . $order_id, $status);

    $status = get_option("liqpay_thankyou_" . $order_id);

    print_r("<br>");

    print_r($status);

    if (isset($_GET['server_order_id'])) {

        $server_order_id2 = $_GET['server_order_id'];

        $status2 = get_option("liqpay_thankyou_" . $server_order_id);

    }

    if ($order_id && $server_order_id2) {

        if ($order_id == $server_order_id2) {

            header("Refresh:0");

        }

    }



}



if (isset($_GET['server_order_id'])) {

    $server_order_id = $_GET['server_order_id'];

    $status = get_option("liqpay_thankyou_" . $server_order_id);

} else {

    die;

}



if ($status == "failure") {

    $content = get_option('thank_page_content_error');

    echo $content;

    die;

} elseif ($status == "success" || $status == "sandbox") {
    $order_id = $_REQUEST["order_id"];

    var_dump($order_id);

     global $woocommerce;

    $order = new WC_Order($order_id);

    $result_url = $order->get_checkout_order_received_url();


    var_dump($result_url)

    $content = get_option('thank_page_content_success');

    //echo $content;

    die;

} else {

    echo "<style>

html, body {

  background: #e78b48;

  width: 100%;

  overflow-x: hidden;

  overflow-y: hidden;

  height: 152px;

}



.bar {

  position: relative;

  height: 2px;

  width: 500px;

  margin: 0 auto;

  background: #fff;

  margin-top: 150px;

}



.circle {

  position: absolute;

  top: -30px;

  margin-left: -30px;

  height: 60px;

  width: 60px;

  left: 0;

  background: #fff;

  border-radius: 30%;

  -webkit-animation: move 5s infinite;

}



p {

  position: absolute;

  top: -35px;

  right: -85px;

  text-transform: uppercase;

  color: rgb(122, 183, 43);

  font-family: helvetica, sans-serif;

  font-weight: bold;

}



@-webkit-keyframes move {

  0% {left: 0;}

  50% {left: 100%; -webkit-transform: rotate(450deg); width: 150px; height: 150px;}

  75% {left: 100%; -webkit-transform: rotate(450deg); width: 150px; height: 150px;}

  100 {right: 100%;}

} 

</style>";

    echo "<div class=\"bar\">

  <div class=\"circle\"></div>

  <p>Loading</p>

</div>";

}

