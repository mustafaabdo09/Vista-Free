<div class="header-top">
    <div class="container container-nav">
        <div class="nav-left">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'topbar',
                'container' => false,
                'menu_class' => '',
                'link_before' => '<a>',
                'link_after' => '</a>',
            ) );
            ?>
        </div>
        <div class="nav-right">
            <a href="<?php echo esc_url( get_theme_mod( 'facebook_link' ) ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="<?php echo esc_url( get_theme_mod( 'twitter_link' ) ); ?>"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="<?php echo esc_url( get_theme_mod( 'instagram_link' ) ); ?>"><i class="fa-brands fa-instagram"></i></a>
            <a href="<?php echo esc_url( get_theme_mod( 'linkedin_link' ) ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="<?php echo esc_url( get_theme_mod( 'tiktok_link' ) ); ?>"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </div>
</div>
