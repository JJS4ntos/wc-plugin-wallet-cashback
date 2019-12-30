<?php
add_filter( 'woocommerce_payment_gateways', function($gateways){
    $gateways[] = 'WC_SWJJPayment';
    return $gateways;
} );

add_action( 'plugins_loaded', 'wc_sw_init_gateway_class' );

function wc_sw_init_gateway_class() {
    
    class WC_SWJJPayment extends \WC_Payment_Gateway {

        public function __construct() {
            $this->id = 'wc-sw-jj-payment';
            $this->icon = '';
            $this->has_fields = false;
            $this->method_title = __('Carteira Virtual', 'wc-sw-jj');
            $this->method_description = __('Cria a possibilidade de o usuário comprar produtos específicos usando uma carteira virtual', 'wc-sw-jj');
            $this->supports = array(
                'products',
            );
            $this->init_form_fields();
            $this->init_settings();
            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->enabled = $this->get_option( 'enabled' );
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        /**
         * Initialize Gateway Settings Form Fields
         */
        public function init_form_fields() {
            $this->form_fields = apply_filters( 'wc_sw_jj_form_fields',
                array( 
                    'enabled' => array(
                        'title'   => __( 'Ativar/Desativar', 'wc-sw-jj' ),
                        'type'    => 'checkbox',
                        'label'   => __( 'Ativa o pagamento através de carteira virtual', 'wc-sw-jj' ),
                        'default' => 'yes'
                    ),

                    'title' => array(
                        'title'       => __( 'Pagar com a minha carteira virtual', 'wc-sw-jj' ),
                        'type'        => 'text',
                        'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'wc-sw-jj' ),
                        'default'     => __( 'Carteira Virtual', 'wc-sw-jj' ),
                        'desc_tip'    => true,
                    ),

                    'description' => array(
                        'title'       => __( 'Descrição', 'wc-sw-jj' ),
                        'type'        => 'textarea',
                        'description' => __( 'Você pode pagar utilizando o crédito que você tem em conta, na sua carteira virtual.', 'wc-sw-jj' ),
                        'default'     => __( 'Você pode pagar utilizando o crédito que você tem em conta, na sua carteira virtual.', 'wc-sw-jj' ),
                        'desc_tip'    => true,
                    ),

                    'instructions' => array(
                        'title'       => __( 'Instruções', 'wc-sw-jj' ),
                        'type'        => 'textarea',
                        'description' => __( 'O valor da compra foi descontado da sua carteira virtual com sucesso!', 'wc-sw-jj' ),
                        'default'     => __( 'O valor da compra foi descontado da sua carteira virtual com sucesso!', 'wc-sw-jj' ),
                        'desc_tip'    => true,
                    ),
            ) );
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            $user = $order->get_user();
            $cash = get_user_meta($user->ID, SWJJ_CASH_OPTION, true);
            update_user_meta($user->ID, SWJJ_CASH_OPTION, $cash - $order->get_total(), $cash);
            $order->update_status( 'processing', __( 'Pagamento via carteira virtual', 'wc-sw-jj' ) );
            // Reduce stock levels
            $order->reduce_order_stock();
            // Remove cart
            WC()->cart->empty_cart();
            // Return thankyou redirect
            return array(
                'result'    => 'success',
                'redirect'  => $this->get_return_url( $order )
            );
        }

        /**
         * Output for the order received page.
         */
        public function thankyou_page() {
            if ( $this->instructions ) {
                echo wpautop( wptexturize( $this->instructions ) );
            }
        }
            
            
        /**
         * Add content to the WC emails.
         *
         * @access public
         * @param WC_Order $order
         * @param bool $sent_to_admin
         * @param bool $plain_text
         */
        public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
                
            if ( $this->instructions && ! $sent_to_admin && 'offline' === $order->payment_method && $order->has_status( 'on-hold' ) ) {
                echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
            }
        }

        public function validate_fields() {
            global $woocommerce;
            $total = WC()->cart->total;
            $user_id = get_current_user_id();
            $cash = get_user_meta($user_id, SWJJ_CASH_OPTION, true);
            if( $total > $cash ) {
                wc_add_notice(  __('Você não possui créditos suficientes para realizar esta compra', 'wc-sw-jj'), 'error' );
                return false;
            }
            return true;
        }

    } 
}
