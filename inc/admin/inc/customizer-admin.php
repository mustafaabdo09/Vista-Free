<?php

function notify_about_premium_version() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>
            <?php _e( 'Enjoying the free version of our theme? Upgrade to <a href="https://www.templatemonster.com/wordpress-themes/vista-news-the-ultimate-wordpress-theme-for-magazines-and-news-websites-466140.html?_gl=1*1ip9odd*_gcl_au*mtk3otqyotmwms4xnzmwota0nji5*_ga*mtg3nte3ndgxmc4xnzmwota0nji2*_ga_ftpyegt5ly*mtczmtyynde1nc45ny4xlje3mze2mjg1nzuunjaumc4w" target="_blank">Premium Version</a> for more features and customizations!', 'my-theme' ); ?>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'notify_about_premium_version' );



function customizer_upgrade_section( $wp_customize ) {
    // Add a new section
    $wp_customize->add_section( 'upgrade_section', array(
        'title'    => __( 'Upgrade to Premium', 'my-theme' ),
        'priority' => 1,
    ) );

    // Add a description text without any input field
    $wp_customize->add_setting( 'upgrade_text_dummy', array(
        'sanitize_callback' => 'wp_filter_nohtml_kses', // Ensure no HTML is allowed in the setting
    ) );

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'upgrade_text_dummy',
        array(
            'label'       => __( 'Upgrade to Premium Version', 'my-theme' ),
            'section'     => 'upgrade_section',
            'settings'    => 'upgrade_text_dummy',
            'description' => __( 'Unlock more features by upgrading to the <a href="https://www.templatemonster.com/wordpress-themes/vista-news-the-ultimate-wordpress-theme-for-magazines-and-news-websites-466140.html?_gl=1*1ip9odd*_gcl_au*mtk3otqyotmwms4xnzmwota0nji5*_ga*mtg3nte3ndgxmc4xnzmwota0nji2*_ga_ftpyegt5ly*mtczmtyynde1nc45ny4xlje3mze2mjg1nzuunjaumc4w" target="_blank">Premium Version</a>!', 'my-theme' ),
            'type'        => 'hidden', // Hides the input field
        )
    ));
}
add_action( 'customize_register', 'customizer_upgrade_section' );




