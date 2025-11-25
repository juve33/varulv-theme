<?php

/**
 * Title: Header
 * Slug: varulv/header
 * Categories: header
 * Inserter: false
 */

?>

<?php

	if( function_exists( 'the_custom_logo' ) ) {

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id );

	}

?>

<div class="nav-rainbow"></div>
<nav class="main-nav">
    <div class="nav-logo">
        <a href="/" class="logo">
            <img src="
                
                <?php

                    if ( $logo ) {

                        echo $logo[0];

                    }

                ?>

                " alt="Logo" />
        </a>
    </div>
    <div class="nav-brown">
        <div class="nav-wrapper">
            <div class="nav-message">

                <?php

                    echo get_theme_mod( 'nav_message' );

                ?>

            </div>

            <?php

                wp_nav_menu(
                    
                    array(

                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul class="navigation">%3$s</ul>',
                        'after' => '<i class="fa-solid fa-chevron-down"></i>',
                        'fallback_cb' => 'lupustheme_empty_navigation',
                        'depth' => 2

                    )

                );

            ?>
    
        </div>
    </div>
    <div class="nav-white">
        <div class="nav-wrapper">
            <div class="nav-message">

                <?php

                    echo get_theme_mod( 'nav_message' );

                ?>

            </div>
            <ul class="socialmedia">

                <?php

                    $socialmedias = array(

                        array( 'Facebook', 'facebook', 'fab fa-facebook fa-fw' ),
                        array( 'Instagram', 'instagram', 'fab fa-instagram fa-fw' ),
                        array( 'TikTok', 'tiktok', 'fab fa-tiktok fa-fw' ),
                        array( 'X', 'x', 'fab fa-x-twitter fa-fw' ),
                        array( 'Threads', 'threads', 'fab fa-threads fa-fw' ),
                        array( 'GitHub', 'github', 'fab fa-github fa-fw' ),

                    );

                ?>

                <?php foreach ( $socialmedias as $socialmedia ) : ?>

                    <?php

                    $social_link = get_theme_mod( $socialmedia[1] . '_link', '' );

                    if ( $social_link && $social_link != '' ) {

                    ?>
                        <li class="menu-item">
                            <a href="<?php echo esc_attr( $social_link ); ?>"
                                title="<?php echo esc_html( $socialmedia[0] ); ?>" target="_blank">
                                <i class="<?php echo esc_html( $socialmedia[2] ); ?>"></i>
                            </a>
                        </li>

                    <?php } ?>

                <?php endforeach; ?>

                <li class="menu-item hamburger-icon">
                    <i class="fa-sharp fa-solid fa-bars" tabindex="0"></i>
                    <i class="fa-sharp fa-solid fa-xmark" tabindex="0"></i>
                </li>
            </ul>
        </div>
    </div>
</nav>