<?php
/**
 * Install and update database structure.
 */

global $wpdb;

$charset = $wpdb->get_charset_collate();
$prefix = "{$wpdb->prefix}sd_";

/**
 * Structure of tables that will be created.
 */
$tables = array();

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

foreach( $tables as $table ) {
    dbDelta( $table );
}

define('SWJJ_CASH_OPTION', 'wc_sw_jj_cash');

define(
    'SWJJ_OPTIONS',
    [ 
        # individual, general.
        /*'wc-jj-wallet-mode' => [
            'type' => 'select',
            'values' => [
               __('Valor geral') => 'general',
               __('') => 'individual',
            ],
            'label' => __('Tipo de carteira', 'wc-sw-jj'),
            'default' => 'general'
        ],*/
        'wc-jj-wallet-enabled' => [
            'type' => 'checkbox',
            'label' => __('Ativar uso de carteira', 'wc-sw-jj'),
            'default' => 0
        ], 
        # cashback is enabled
        'wc-jj-cashback' => [
            'type' => 'checkbox',
            'label' => __('Ativar Cashback', 'wc-sw-jj'),
            'default' => 0
        ], 
        # fixed, percent
        'wc-jj-cashback-mode' => [
            'type' => 'select',
            'values' => [
               __('Valor fixo a cada compra') => 'fixed',
               __('Valor percentual da compra') => 'percent',
            ],
            'label' => __('Tipo de Cashback', 'wc-sw-jj'),
            'default' => 'fixed'
        ], 
        # if cashback is enabled, wallet mode is general and cashback mode is percent then specify percent of cashback
        'wc-jj-cashback-percent' => [
            'type' => 'number',
            'label' => __('Percentual de CashBack por produto', 'wc-sw-jj'),
            'default' => 0,
            'placeholder' => __('Digite o percentual', 'wc-sw-jj'),
            'textHelp' => __('Após cada compra esse determinado percentual retornará ao usuário', 'wc-sw-jj')
        ], 
        'wc-jj-cashback-fixed-value' => [
            'type' => 'number',
            'label' => __('Valor fixo de CashBack por produto', 'wc-sw-jj'),
            'default' => 0,
            'placeholder' => __('Digite o valor', 'wc-sw-jj'),
            'textHelp' => __('Após cada compra esse determinado valor retornará ao usuário', 'wc-sw-jj')
        ], 
        # cash can be expired
        'wc-jj-cash-expire' => [
            'type' => 'checkbox',
            'label' => __('Ativar dinheiro em carteira expirável', 'wc-sw-jj'),
            'default' => 0
        ], 
        # cash day(s) to expire
        'wc-jj-cash-expire-days' => [
            'type' => 'number',
            'label' => __('Dias até que o dinheiro expire', 'wc-sw-jj'),
            'default' => 0,
            'placeholder' => __('Digite o número de dias', 'wc-sw-jj'),
            'textHelp' => __('Após atingido este limite de dias o crédito será zerado', 'wc-sw-jj')
        ], 
        # cash limit - 0 no limits
        'wc-jj-cash-limit' => [
            'type' => 'number',
            'label' => __('Limite de dinheiro em carteira', 'wc-sw-jj'),
            'default' => 10.0,
            'placeholder' => __('Digite o valor máximo', 'wc-sw-jj'),
            'textHelp' => __('Nenhum usuário poderá ter mais créditos em carteira do que isto', 'wc-sw-jj')
        ],
        # limite usage cash only these products
        'wc-jj-products' => [
            'type' => 'select2',
            'label' => __('Produtos que podem ser comprados usando a carteira', 'wc-sw-jj'),
            'default' => [],
            'placeholder' => __('Selecione os produtos', 'wc-sw-jj'),
            'textHelp' => __('Os créditos poderão ser utilizados somente nestes produtos ou em categorias selecionadas', 'wc-sw-jj')
        ],
        # limite usage cash only these product categories
        'wc-jj-products-categories' => [
            'type' => 'select2',
            'label' => __('Categoria de produtos que podem ser comprados usando a carteira', 'wc-sw-jj'),
            'default' => [],
            'placeholder' => __('Selecione as categorias', 'wc-sw-jj'),
            'textHelp' => __('Os créditos poderão ser utilizados somente nestas categorias ou em produtos selecionados', 'wc-sw-jj')
        ],
    ]);