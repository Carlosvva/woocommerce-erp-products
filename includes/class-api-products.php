<?php
class API_Products {
    private $api_client;

    public function __construct() {
        $this->api_client = new API_Client();

        add_action('init', array($this, 'register_product_post_type'));
        add_shortcode('wcap_products', array($this, 'display_products_shortcode'));
    }

    public function register_product_post_type() {
        register_post_type('wcap_product', array(
            'public' => false,
            'show_ui' => false,
            'show_in_rest' => false,
            'supports' => array(),
            'label' => 'API Products',
            'description' => 'Products retrieved from the API',
            'hierarchical' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_position' => null,
            'menu_icon' => null,
            'capability_type' => 'post',
            'has_archive' => false,
        ));
    }

    public function display_products_shortcode() {
        $products = $this->api_client->get_products();

        if (is_wp_error($products)) {
            return sprintf('<p class="error">%s</p>', esc_html($products->get_error_message()));
        }

        if (empty($products)) {
            return '<p class="error">No se encontraron productos.</p>';
        }

        $output = '<ul class="wcap-products">';

        foreach ($products as $product) {
            $output .= sprintf(
                '<li class="wcap-product">
                    <a href="%s">
                        <img src="%s" alt="%s" />
                        <h3>%s</h3>
                        <span class="price">%s</span>
                    </a>
                </li>',
                esc_url(get_permalink(wc_get_page_id('shop')) . '?add-to-cart=' . $product['m_product_id']),
                esc_url($product['imageurl']),
                esc_attr($product['name']),
                esc_html($product['name']),
                esc_html(wc_price($product['pricelist']))
            );
        }

        $output .= '</ul>';

        return $output;
    }
}
