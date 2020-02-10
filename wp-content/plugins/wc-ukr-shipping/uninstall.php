<?php

if ( ! defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

include_once 'autoload.php';

$wcUkrShippingNPRepository = new \kirillbdev\WCUkrShipping\DB\NovaPoshtaRepository();
$wcUkrShippingNPRepository->dropTables();

$wcUkrShippingOptionsRepository = new \kirillbdev\WCUkrShipping\DB\OptionsRepository();
$wcUkrShippingOptionsRepository->deleteAll();