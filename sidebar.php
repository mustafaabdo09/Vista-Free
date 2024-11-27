<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra_News_-_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


<div class="sidbar-home">

<?php if ( is_active_sidebar( 'sidebar-top' ) ) : ?>
    <div class="sidebar-top-widget-area">
        <?php dynamic_sidebar( 'sidebar-top' ); ?>
    </div>
<?php endif; ?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
                
</div