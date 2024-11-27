<?php
/**
 * The template for displaying a page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ultra_News_-_Theme
 */

get_header();
?>

<main id="primary" class="site-main main-page-content">

	<section class="page-content recent-posts archive-posts">
		<div class="container">
			<div class="row-page-not-found">
				<div class="col-page-not-found">
					<img src="<?php echo get_template_directory_uri(); ?>/images/fogg-page-not-found.png" alt="Page not found">
				</div>
				<div class="col-page-not-found">
					<h1 class="mb-30"><?php esc_html_e( '404 - Page Not Found', 'your-theme-textdomain' ); ?></h1>
					
					<!-- نموذج البحث الديناميكي -->
					<form role="search" method="get" class="search-form d-lg-flex open-search mb-30" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<i class="icon-search"></i>
						<input type="search" class="form-control" placeholder="<?php esc_attr_e( 'Search...', 'your-theme-textdomain' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
					</form>

					<p class="link-not-fpund">
						<?php esc_html_e( 'The link you clicked may be broken or the page may have been removed.', 'your-theme-textdomain' ); ?><br>
						<?php esc_html_e( 'Visit the', 'your-theme-textdomain' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'your-theme-textdomain' ); ?></a> 
						<?php esc_html_e( 'or', 'your-theme-textdomain' ); ?> <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact us', 'your-theme-textdomain' ); ?></a> 
						<?php esc_html_e( 'about the problem.', 'your-theme-textdomain' ); ?>
					</p>

					<div class="form-group-not-found">
						<button class="tj-btn-primary">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button-contactForm mt-30"><?php esc_html_e( 'Home page', 'your-theme-textdomain' ); ?></a>
						</button>
					</div>
				</div>
			</div>
		</div>
    </section>
</main><!-- #main -->

<?php

get_footer();
