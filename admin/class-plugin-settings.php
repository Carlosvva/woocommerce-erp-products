<?php
class Plugin_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_settings_menu'));
        add_action('admin_init', array($this, 'register_plugin_settings'));
    }

    public function add_plugin_settings_menu() {
        add_submenu_page(
            'woocommerce', // Slug del menú principal (WooCommerce)
            'API Products Settings', // Título de la página
            'API Products', // Título del menú
            'manage_options', // Capacidad requerida
            'wcap_settings', // Slug de la página
            array($this, 'display_plugin_settings_page') // Función de devolución de llamada para mostrar la página
        );
    }

    public function register_plugin_settings() {
        register_setting(
            'wcap_settings_group', // Grupo de opciones
            'wcap_idapi', // Nombre de la opción (IDAPI)
            array(
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        register_setting(
            'wcap_settings_group', // Grupo de opciones
            'wcap_apikey', // Nombre de la opción (APIKEY)
            array(
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        register_setting(
            'wcap_settings_group', // Grupo de opciones
            'wcap_apiproducts', // Nombre de la opción (APIPRODUCTS)
            array(
                'type' => 'string',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
    }

    public function display_plugin_settings_page() {
        include_once plugin_dir_path(__DIR__) . 'partials/admin-settings.php';
    }
}
