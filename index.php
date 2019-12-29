<?php
/*
  Plugin Name: WooCommerce Shop Wallet
  Plugin URI: https://github.com/JJS4ntos
  Description: Carteira para loja WooCommerce com a possibilidade de pagamento através de crédito ou cashback.
  Version: 1.0.0
  Author: Jair Júnior
  Author URI: https://github.com/JJS4ntos
*/
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('PLUGIN_NAME', 'Shop Wallet');
define('SD_PATH', plugin_dir_url( __FILE__ ));
define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('URL_SCOPE', 'wc-jj-shop-wallet-api');
define('PLUGIN_ROOT', basename(dirname(__FILE__)));

require_once 'vendor/autoload.php';
require_once 'src/Config/Setup.php';
require_once 'src/database/install.php';
require_once 'src/routes.php';
require_once 'src/database/gateway.php';
