<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra_News_-_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo ( has_site_icon() ? get_site_icon_url() : get_template_directory_uri() . '/image/favicon.png' ); ?>" type="image/x-icon">


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ultranews' ); ?></a>

	<header>
        <!-- القائمة العلوية -->
        <div class="header-top">
            <div class="container container-nav">
                <div class="nav-left">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'topbar',
                        'container' => false,
                        'menu_class' => 'nav-menu',
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

        <!-- الشعار -->
		<div class="header-logo">
			<div class="log">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo(); // استدعاء الشعار الديناميكي
					} else {
						// نص بديل إذا لم يتم رفع الشعار
						echo '<img src="' . esc_url( get_template_directory_uri() . '/images/default-logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
					}
					?>
				</a>
			</div>
		</div>

        <!-- القائمة السفلية -->
        <div class="container-header-bootom">
            <div class="container header-bootom">
                <a href="" class="header-sidbar">
                    <div class="bar">
                    <i class="fa-solid fa-bars"></i>
                    </div>
                </a>
                <div class="overlay"></div>
                <div class="menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'bottom_menu',
                        'container' => false,
                        'menu_class' => 'header-bottom-menu',
                    ) );
                    ?>
                </div>
                

                <div class="search-icons">
                    <button type="button" id="clic-search-btn"><i id="clic-search" class="fa-solid fa-search"></i></button>
                </div>
            </div>
        </div>
    </header>
    <?php get_template_part('search-open'); ?>
    