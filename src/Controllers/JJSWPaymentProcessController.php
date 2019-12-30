<?php
namespace App\Controllers;

use App\Controllers\Controller;

class JJSWPaymentProcessController extends Controller {

    public function __construct() {
        add_action( 'woocommerce_payment_complete', array($this, 'paid') );
    }

    /**
     * When user paid a order and gateway confirm.
     */
    public function paid( $order_id ) {
        $order = wc_get_order( $order_id );
        $user = $order->get_user();
        $total = $order->get_total();
        if( $order->get_payment_method() !== 'wc-sw-jj-payment' ) {
            $this->cashback($total, $user->ID);
        }
    }

    private function cashback($total, $user_id) {
        $user_cash = doubleval(get_user_meta($user->ID, SWJJ_CASH_OPTION, true));        
        if( get_option('wc-jj-cashback', false) ) {
            if( get_option('wc-jj-cashback-mode', false) == 'fixed' ) {
                $fixed_cashback = doubleval(get_option('wc-jj-cashback-value', 0));
                $user_cash += $fixed_cashback; 
            } elseif( get_option('wc-jj-cashback-mode', false) == 'percent' ) {
                $percent_cashback = doubleval(get_option('wc-jj-cashback-percent', 0));
                $cashback = $percent_cashback * $total / 100;
                $user_cash += $cashback; 
            }
        }
        update_user_meta($user_id, SWJJ_CASH_OPTION, $user_cash);
    }

}