<?php

namespace kirillbdev\WCUkrShipping\Classes;

use kirillbdev\WCUkrShipping\Http\NovaPoshtaAjax;

if ( ! defined('ABSPATH')) {
  exit;
}

final class WCUkrShipping
{
  private static $instance = null;

  private $activator;
  private $assetsLoader;
  private $optionsPage;
  private $ajax;

  private function __construct()
  {
    $this->activator = new Activator();
    $this->assetsLoader = new AssetsLoader();
    $this->optionsPage = new OptionsPage();
    $this->ajax = new NovaPoshtaAjax();
  }

  private function __clone() { }
  private function __wakeup() { }

  public static function instance()
  {
    if ( ! self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function __get($name)
  {
    return $this->$name;
  }
}