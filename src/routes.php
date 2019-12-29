<?php
/**
 * Route controllers to execute functions according urls.
 */
namespace App;

use App\Controllers\RouterController;
use App\Shortcodes\Register;

$register = new Register();
$router = new RouterController();

$router->register_admin_page('Configurações', 'wc-jj-sw-config', 'JJSWConfigurationController@index');