$js=jQuery;

$js.noConflict();

jQuery(function(){







    jQuery(document).ready(function($js) {

        $js('#menu_products').on('change', function() {

            var selected = $js('#menu_products option:selected' ).text();

            selected = selected.split('|');

            console.log ( selected);

            $js('#plata').val(selected[0]);

            $js('#liqpay_gen_button_check_summa').val(selected[1]);

            $js('#menu_valuta').val(selected[2]);

            $js('#name_button_buy').val('Купить');

        })



        if($js('#liqpay_converter_type').val() == 'none' ){

            $js('.currency_exchange').css('display','none');

        }

        else if($js('#liqpay_converter_type').val() == 'privatb' ){

            $js('.currency_exchange').css('display','table-row');

            $js('.currency_exchange.custom').css('display','none');

        }

        else {

            $js('.currency_exchange').css('display','none');

            $js('.currency_exchange.custom').css('display','table-row');

        }



        $js('#liqpay_converter_type').on('change', function() {

            if($js(this).val() == 'none' ){

                $js('.currency_exchange').css('display','none');

            }

            else if($js(this).val() == 'privatb' ){

                $js('.currency_exchange').css('display','table-row');

                $js('.currency_exchange.custom').css('display','none');

            }

            else {

                $js('.currency_exchange').css('display','none');

                $js('.currency_exchange.custom').css('display','table-row');

            }

        })



if ($js('#table_list').length > 0) {

        oTable = $js('#table_list').dataTable({

            'bProcessing': true,

            'bServerSide': true,

            orderCellsTop: true,



            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],

            "order": [[ 1, "desc" ]],

            columns: [

                { "tooltip":"Tooltip text", title: "Order_id"},

                { "tooltip":"Tooltip text", title: "Дата" },

                { "tooltip":"Tooltip text", title: "№ Транзакции" },

                { "tooltip":"Tooltip text", title: "Статус" ,



                    render : function ( data, type, full, meta ) {

                        if (data == 'success')

                            return '<b><p style="color: #0a9e01">'+data+'</p></b>';

                        else if(data == 'failure')

                            return '<b><p style="color: tomato">'+data+'</p></b>';

                        else if (data == 'wait_secure')

                            return '<b><p style="color: orange">'+data+'</p></b>';

                        else if (data == 'delayed')

                            return '<b><p style="color: #0000C3">'+data+'</p></b>';

                        else

                            return '<b><p>'+data+'</p></b>';

                    }},

                { "tooltip":"Tooltip text", title: "Код Ошибки" },

                { "tooltip":"Tooltip text", title: "Сумма" },

                { "tooltip":"Tooltip text", title: "Валюта"},

                { "tooltip":"Tooltip text", title: "Телефон" },

                { "tooltip":"Tooltip text", title: "Коментарий" },

                { "tooltip":"Tooltip text", title: "Email" },

                { "tooltip":"Tooltip text", title: "IP" },

            ],

            "columnDefs": [

                { "visible": false, "targets": [4] },

                { "visible": false, "targets": [6] },

            ],

            //'sAjaxSource': ajaxurl+'?page=liqpay_list',

            'ajax':{

                'url': ajaxurl+'?action=get_liqpay_list_page',

                "dataType": "json"

            },

            "sServerMethod": "POST",



        }).yadcf([

            {

                column_number: 0,

                filter_type: "text",

                filter_delay: 500



            },

            {

                column_number: 1,

                filter_type: 'range_date',

                date_format: 'mm/dd/yyyy'

            },

            {

                column_number: 2,

                filter_type: "text",

                filter_delay: 500


            },

            {

                column_number: 3,

                filter_type: "text",

                filter_delay: 500

            },

            {

                column_number: 4,

                filter_type: "text",

                filter_delay: 50

            },

            {

                column_number: 5,

                filter_type: "range_number",

                filter_delay: 500

            },

            {

                column_number: 6,

                filter_type: "text",

                filter_delay: 500

            },

            {

                column_number: 7,

                filter_type: "text",

                filter_delay: 500

            },
            {

                column_number: 8,

                filter_type: "text",

                filter_delay: 500

            },

            {

                column_number: 9,

                filter_type: "text",

                filter_delay: 500

            },

            {

                column_number: 10,

                filter_type: "text",

                filter_delay: 500

            }


        ]);

    }

    });

});