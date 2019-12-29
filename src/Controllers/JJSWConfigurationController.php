<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Config\Setup;

class JJSWConfigurationController extends Controller {

    public function index() {
        $orderby = 'name';
        $order = 'asc';
        $hide_empty = false ;
        $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
        );
        $product_categories = get_terms( 'product_cat', $cat_args );
        echo $this->generateView('configuration', ['options' => OPTIONS, 'categories' => $product_categories]);
    }

}