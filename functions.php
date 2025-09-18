<?php

function varulvtheme_customize_register( $wp_customize ) {

    $wp_customize->add_setting(

        'nav_message',
        array(
            
            'default' => ""

        )

    );

    $wp_customize->add_control(

        new WP_Customize_Control(

            $wp_customize,
            'nav_message',
            array(

                'label' => 'Navigation Message',
                'description' => 
                                'Message that is displayed in the navigation on desktop version',
                'section' => 'title_tagline',
                'settings' => 'nav_message',

            )

        )

    );

    $controls = array(

        'nav_text_transform',
        'subtitle_text_transform',
        'emphasized_text_transform',
        'emphasized_letter_spacing'

    );

    foreach ( $controls as $control ) :

        $wp_customize->remove_control( $control );
        $wp_customize->remove_setting( $control );
    
    endforeach;

}

add_action('customize_register', 'varulvtheme_customize_register', 20);



function varulvtheme_register_scripts() {

    $version = wp_get_theme( get_stylesheet() )->get( 'Version' );

    $scripts = array(

        'main',

    );

    foreach ( $scripts as $script ) :

        wp_dequeue_script( 'lupustheme-' . $script );
        wp_enqueue_script( 'varulvtheme-' . $script, get_stylesheet_directory_uri() . '/assets/js/' . $script . '.js', array(), $version, true );
    
    endforeach;

}

add_action('wp_enqueue_scripts', 'varulvtheme_register_scripts', 20);



function varulvtheme_register_styles() {

    $version = wp_get_theme( get_stylesheet() )->get( 'Version' );
    
    $overwrite_stylesheets = array(

        'nav',

    );

    $additional_stylesheets = array(

        'variables',

    );

    foreach ( $overwrite_stylesheets as $stylesheet ) :

        wp_dequeue_style( 'lupustheme-' . $stylesheet );
        wp_enqueue_style( 'varulvtheme-' . $stylesheet, get_stylesheet_directory_uri() . '/assets/css/' . $stylesheet. '.css', array(), $version, 'all' );
    
    endforeach;

    foreach ( $additional_stylesheets as $stylesheet ) :

        wp_enqueue_style( 'varulvtheme-' . $stylesheet, get_stylesheet_directory_uri() . '/assets/css/' . $stylesheet. '.css', array(), $version, 'all' );
    
    endforeach;

    if ( ! function_exists( 'is_plugin_active' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $plugin_stylesheets = array(
        
        array( 'lupus-plugin', 'lupus-plugin/lupus-plugin.php' ),

    );

    foreach ( $plugin_stylesheets as $plugin_stylesheet ) :

        if ( is_plugin_active( $plugin_stylesheet[1] ) ) {

            wp_enqueue_style( 'varulvtheme-' . $plugin_stylesheet[0], get_stylesheet_directory_uri() . '/assets/css/' . $plugin_stylesheet[0] . '.css', array(), $version, 'all' );
        
        }

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