<?php
class Order_Handler {
    private $api_client;

    public function __construct() {
        $this->api_client = new API_Client();

        add_action('woocommerce_thankyou', array($this, 'send_order_to_api'), 10, 1);
    }

    public function send_order_to_api($order_id) {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'woocommerce-pay')) {
            return;
        }

        $order = wc_get_order($order_id);

        if ($order->get_status() !== 'processing') {
            return;
        }

        $data = array(
            'id' => $order->get_id(),
            'number' => $order->get_order_number(),
            'currency' => $order->get_currency(),
            'total' => $order->get_total(),
            'subtotal' => $order->get_subtotal(),
            'total_tax' => $order->get_total_tax(),
            'shipping_total' => $order->get_shipping_total(),
            'customer' => array(
                'id' => $order->get_customer_id(),
                'first_name' => $order->get_billing_first_name(),
                'last_name' => $order->get_billing_last_name(),
                'email' => $order->get_billing_email(),
                'phone' => $order->get_billing_phone(),
            ),
            'billing_address' => array(
                'first_name' => $order->get_billing_first_name(),
                'last_name' => $order->get_billing_last_name(),
                'company' => $order->get_billing_company(),
                'address_1' => $order->get_billing_address_1(),
                'address_2' => $order->get_billing_address_2(),
                'city' => $order->get_billing_city(),
                'state' => $order->get_billing_state(),
                'postcode' => $order->get_billing_postcode(),
                'country' => $order->get_billing_country(),
            ),
            'shipping_address' => array(
                'first_name' => $order->get_shipping_first_name(),
                'last_name' => $order->get_shipping_last_name(),
                'company' => $order->get_shipping_company(),
                'address_1' => $order->get_shipping_address_1(),
                'address_2' => $order->get_shipping_address_2(),
                'city' => $order->get_shipping_city(),
                'state' => $order->get_shipping_state(),
                'postcode' => $order->get_shipping_postcode(),
                'country' => $order->get_shipping_country(),
            ),
            'line_items' => array(),
        );

        foreach ($order->get_items() as $item) {
            $data['line_items'][] = array(
                'id' => $item->get_product_id(),
                'name' => $item->get_name(),
                'sku' => $item->get_sku(),
                'quantity' => $item->get_quantity(),
                'price' => $item->get_total(),
            );
        }

        // URL de API
        $url = 'https://example.com/api/orders';

        $response = wp_remote_post($url, array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => json_encode($data),
        ));

        if (is_wp_error($response)) {
            // Maneja el error de la solicitud
        } else {
            // La orden se envió correctamente a la API
        }
    }
}
