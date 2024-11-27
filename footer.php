<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ultra_News_-_Theme
 */

?>

	    <!--------------------------------- Start Footer ---------------------------------------->
    <footer>
        <div class="container footer-container">
            <div class="row-container about-footer">
                    <h2>About Us</h2>
                    <div class="letter-background">
                        A
                    </div>
					<div class="description">
					<p class="about-description"><?php echo esc_html(get_theme_mod('footer_about_description', 'Default description here...')); ?></p>
				</div>
				<div class="address">
					<h3>Address</h3>
					<p><?php echo esc_html(get_theme_mod('footer_address', '123 Street, City, Country')); ?></p>
					<h3>Phone</h3>
					<p>Phone: <?php echo esc_html(get_theme_mod('footer_phone', '+1 123 456 7890')); ?></p>
					<h3>Email</h3>
					<p>Email: <?php echo esc_html(get_theme_mod('footer_email', 'info@example.com')); ?></p>
				</div>
            </div>
            <div class="row-container posts-footer">
				<h2>Popular Posts</h2>
				<div class="letter-background">
					P
				</div>
				
					<?php if (is_active_sidebar('footer-widget-area')) : ?>
						<div class="footer-widget-area">
							<?php dynamic_sidebar('footer-widget-area'); ?>
						</div>
					<?php else : ?>
						<p>No popular posts widget added yet.</p>
					<?php endif; ?>
			</div>

            <div class="row-container links-footer">
                <h2>Quick Links</h2>
                <div class="letter-background">
                    Q
                </div>
                <div class="menu-footer">
					<ul>
						<?php for ($i = 1; $i <= 4; $i++): ?>
							<?php 
								$item_page_name = get_theme_mod("footer_menu_item_{$i}_page_name");
								$item_link = get_theme_mod("footer_menu_item_{$i}_link");
								if ($item_page_name && $item_link): 
							?>
								<li><a href="<?php echo esc_url($item_link); ?>"><?php echo esc_html($item_page_name); ?></a></li>
							<?php endif; ?>
						<?php endfor; ?>
					</ul>
				</div>



                <div class="row-container tags-footer">
                    <div class="tags-link">
                        <h2>Categories</2>
                            <div class="letter-background">
                                C
                            </div>
							<div class="tags-list">
								<ul>
								<?php
									$categories = get_categories(array(
										'hide_empty' => false, // يعرض جميع الفئات بغض النظر عن كونها تحتوي على مقالات أم لا
									));
									
									foreach ($categories as $category) {
										$show_category = get_theme_mod("footer_category_{$category->term_id}", '0');
										if ($show_category) {
											// استخدم get_term_link للحصول على الرابط
											$link = get_term_link($category);
											echo '<li><a href="' . esc_url($link) . '">' . esc_html($category->name) . '</a></li>';
										}
									}
									?>
								</ul>
							</div>
                    </div>
                </div>
            </div>
            <div class="row-container newsletter-footer">
                <h2>Newsletter</h2>
                <div class="letter-background">
                    N
                </div>
				<div class="subscribe-footer">
					<p>Subscribe To Our Newsletter.</p>
					<form action="#" method="POST">
						<input type="email" placeholder="Email Address" required>
						<button type="submit"><i class="fa-regular fa-envelope"></i></button>
					</form>
				</div>
            </div>
        </div>
        <div class="container copy-right-footer">
			<div class="text-copy-right">
				<p>
					<?php echo esc_html(get_theme_mod('ultra_news_copyright_text', '© 2024 My Website')); ?>
					<span>- | Design by <a href="#">Mustafa Abdo</a></span>.
				</p>
			</div>
			<div class="mnue-footer-bottom">
			<?php
			if (has_nav_menu('footer-menu')) {
				wp_nav_menu(array(
					'theme_location' => 'footer-menu',
					'container'      => '',
					'menu_class'     => '',
					'items_wrap'     => '%3$s',
					'depth'          => 1,
				));
			} else {
				echo '<p>Please assign a menu to the footer menu location.</p>';
			}
			?>
			</div>
		</div>
		

	</div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
