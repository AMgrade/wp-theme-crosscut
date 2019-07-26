<?php

/**
 * PHP Wordpress Removing Contact Form 7 Br tags
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/*function acf_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
}

add_filter( 'site_transient_update_plugins', 'acf_plugin_updates' );*/