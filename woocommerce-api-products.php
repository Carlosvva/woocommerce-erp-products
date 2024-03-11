<?php
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/includes/class-api-client.php';
require_once __DIR__ . '/includes/class-api-products.php';
require_once __DIR__ . '/includes/class-order-handler.php';
require_once __DIR__ . '/admin/class-plugin-settings.php';

function wcap_init() {
    new API_Products();
    new Order_Handler();
    new Plugin_Settings();
}
add_action( 'plugins_loaded', 'wcap_init' );