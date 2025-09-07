<?php

function varulvtheme_register_styles() {

    $version = wp_get_theme( get_template() )->get( 'Version' );
    
    $stylesheets = array(
    );

    foreach ( $stylesheets as $stylesheet ) :
        wp_dequeue_style( 'lupustheme-' . $stylesheet[0] );
        wp_enqueue_style( 'varulvtheme-' . $stylesheet[0], get_stylesheet_directory_uri() . '/assets/css/' . $stylesheet[0]. '.css', array(), $version, 'all' );
    endforeach;

}

add_action('wp_enqueue_scripts', 'varulvtheme_register_styles', 20);



function varulvtheme_update($transient) {
    if (!is_object($transient)) {
        $transient = new stdClass();
    }

    $theme_slug = 'varulv';
    $current_version = wp_get_theme($theme_slug)->get('Version');
    
    $response = wp_remote_get('https://juve33.github.io/wp-theme-updater/varulv.json');

    if (!is_wp_error($response)) {
        $body = json_decode(wp_remote_retrieve_body($response));
        if (($body != NULL) && (version_compare($current_version, $body->version, '<'))) {
            $transient->response[$theme_slug] = array(
                'theme'       => $theme_slug,
                'new_version' => $body->version,
                'package'     => $body->download_url
            );
        }
    }
    return $transient;
}

add_filter('site_transient_update_themes', 'varulvtheme_update');

?>