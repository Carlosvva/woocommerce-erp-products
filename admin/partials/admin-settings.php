<div class="wrap">
    <h1>API Products Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields('wcap_settings_group'); ?>
        <?php do_settings_sections('wcap_settings_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">IDAPI</th>
                <td><input type="text" name="wcap_idapi" value="<?php echo esc_attr(get_option('wcap_idapi')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">APIKEY</th>
                <td><input type="text" name="wcap_apikey" value="<?php echo esc_attr(get_option('wcap_apikey')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">APIPRODUCTS</th>
                <td><input type="url" name="wcap_apiproducts" value="<?php echo esc_url(get_option('wcap_apiproducts')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
