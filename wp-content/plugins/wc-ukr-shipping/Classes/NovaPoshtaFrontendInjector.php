<?php

namespace kirillbdev\WCUkrShipping\Classes;

use kirillbdev\WCUkrShipping\Api\NovaPoshtaApi;
use kirillbdev\WCUkrShipping\DB\NovaPoshtaRepository;
use kirillbdev\WCUkrShipping\Services\CalculationService;
use kirillbdev\WCUkrShipping\Services\StorageService;

if ( ! defined('ABSPATH')) {
  exit;
}

class NovaPoshtaFrontendInjector
{
  /**
   * @var NPTranslator
   */
  private $translator;

  public function __construct()
  {
    $this->translator = new NPTranslator();

    add_action('wp_head', [ $this, 'injectGlobals' ]);
    add_action('wp_enqueue_scripts', [ $this, 'injectScripts' ]);
    add_action($this->getInjectActionName(), [ $this, 'injectShippingFields' ]);

    // Prevent default WooCommerce rate caching
    add_filter('woocommerce_shipping_rate_label', function ($label, $rate) {
      if ($rate->get_method_id() === 'nova_poshta_shipping') {
        $label = $this->translator->getTranslates()['method_title'];
      }

      return $label;
    }, 10, 2);
  }

  public function injectGlobals()
  {
    if ( ! is_checkout()) {
      return;
    }

    ?>
    <style>
      .wc-ukr-shipping-np-fields {
        padding: 1px 0;
      }

      .wcus-state-loading:after {
        border-color: <?= get_option('wc_ukr_shipping_spinner_color', '#dddddd'); ?>;
        border-left-color: #fff;
      }
    </style>
  <?php
  }

  public function injectScripts()
  {
	  if ( ! is_checkout()) {
		  return;
	  }

    wp_enqueue_style(
      'wc_ukr_shipping_css',
      WC_UKR_SHIPPING_PLUGIN_URL . 'assets/css/style.min.css'
    );

    wp_enqueue_script(
      'wc_ukr_shipping_nova_poshta_checkout',
      WC_UKR_SHIPPING_PLUGIN_URL . 'assets/js/nova-poshta-checkout.js',
      [ 'jquery' ],
      filemtime(WC_UKR_SHIPPING_PLUGIN_DIR . 'assets/js/nova-poshta-checkout.js'),
      true
    );
  }

  public function injectShippingFields()
  {
	  if ( ! is_checkout()) {
		  return;
	  }

	  $translates = $this->translator->getTranslates();
	  $areaAttributes = $this->getAreaSelectAttributes($translates['placeholder_area']);
	  $cityAttributes = $this->getCitySelectAttributes($translates['placeholder_city']);
	  $warehouseAttributes = $this->getWarehouseSelectAttributes($translates['placeholder_warehouse']);

    ?>
      <div id="<?= WC_UKR_SHIPPING_NP_SHIPPING_NAME; ?>_fields" class="wc-ukr-shipping-np-fields">
        <h3><?= $translates['block_title']; ?></h3>
        <div id="nova-poshta-shipping-info">
          <?php
          //Region
          woocommerce_form_field(WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_area', [
            'type' => 'select',
            'options' => $areaAttributes['options'],
            'input_class' => [
              'wc-ukr-shipping-select'
            ],
            'label' => '',
            'default' => $areaAttributes['default']
          ]);

          //City
          woocommerce_form_field(WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_city', [
            'type' => 'select',
            'options' => $cityAttributes['options'],
            'input_class' => [
              'wc-ukr-shipping-select'
            ],
            'label' => '',
            'default' => $cityAttributes['default']
          ]);

          //Warehouse
          woocommerce_form_field(WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_warehouse', [
            'type' => 'select',
            'options' => $warehouseAttributes['options'],
            'input_class' => [
              'wc-ukr-shipping-select'
            ],
            'label' => '',
            'default' => $warehouseAttributes['default']
          ]);

          ?>
        </div>

        <?php if ((int)get_option('wc_ukr_shipping_address_shipping', 1) === 1) { ?>
          <div class="wc-urk-shipping-form-group" style="padding: 10px 5px;">
            <label class="wc-ukr-shipping-checkbox">
              <input id="np_custom_address" type="checkbox" name="np_custom_address" value="1">
              <?= $translates['address_title']; ?>
            </label>
          </div>

          <div id="np_custom_address_block">
            <?php

            // Custom address field
            woocommerce_form_field(WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_custom_address', [
              'type' => 'text',
              'input_class' => [
                'input-text'
              ],
              'label' => '',
              'placeholder' => $translates['address_placeholder']
            ]);
            ?>
          </div>
        <?php } ?>
      </div>
    <?php
  }

  private function getAreaSelectAttributes($placeholder)
  {
    $options = [
      '' => $placeholder
    ];

    $translator = new NPTranslator();
    $repository = new NovaPoshtaRepository();
    $areas = $translator->translateAreas($repository->getAreas());

    foreach ($areas as $area) {
      $options[$area['ref']] = $area['description'];
    }

    return [
      'options' => $options,
      'default' => StorageService::getValue('wc_ukr_shipping_np_selected_area', '')
    ];
  }

  private function getCitySelectAttributes($placeholder)
  {
    $options = [
      '' => $placeholder
    ];

    if (StorageService::getValue('wc_ukr_shipping_np_selected_area')) {
      $repository = new NovaPoshtaRepository();
      $cities = $repository->getCities(StorageService::getValue('wc_ukr_shipping_np_selected_area'));

      foreach ($cities as $city) {
        $options[$city['ref']] = get_option('wc_ukr_shipping_np_lang', 'uk') === 'uk' ?
          $city['description'] :
          $city['description_ru'];
      }
    }

    return [
      'options' => $options,
      'default' => StorageService::getValue('wc_ukr_shipping_np_selected_city', '')
    ];
  }

  private function getWarehouseSelectAttributes($placeholder)
  {
    $options = [
      '' => $placeholder
    ];

    if (StorageService::getValue('wc_ukr_shipping_np_selected_city')) {
      $repository = new NovaPoshtaRepository();
      $warehouses = $repository->getWarehouses(StorageService::getValue('wc_ukr_shipping_np_selected_city'));

      foreach ($warehouses as $warehouse) {
        $options[$warehouse['ref']] = get_option('wc_ukr_shipping_np_lang', 'uk') === 'uk' ?
          $warehouse['description'] :
          $warehouse['description_ru'];
      }
    }

    return [
      'options' => $options,
      'default' => StorageService::getValue('wc_ukr_shipping_np_selected_warehouse', '')
    ];
  }

  private function getInjectActionName()
  {
    return 'additional' === wc_ukr_shipping_get_option('wc_ukr_shipping_np_block_pos')
      ? 'woocommerce_before_order_notes'
      : 'woocommerce_after_checkout_billing_form';
  }
}