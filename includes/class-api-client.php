<?php
class API_Client {
    private $idapi;
    private $apikey;
    private $apiproducts;

    public function __construct() {
        $this->idapi = get_option('wcap_idapi');
        $this->apikey = get_option('wcap_apikey');
        $this->apiproducts = get_option('wcap_apiproducts');
    }

    public function get_products() {
        if (!$this->idapi || !$this->apikey || !$this->apiproducts) {
            return new WP_Error('missing_credentials', 'Faltan credenciales de la API.');
        }

        $url = sprintf('%s?IDAPI=%s&APIKEY=%s', $this->apiproducts, $this->idapi, $this->apikey);

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return $response;
        }

        $body = wp_remote_retrieve_body($response);
        $products = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('invalid_json', 'Respuesta JSON inválida.');
        }

        return $products;
    }
}
