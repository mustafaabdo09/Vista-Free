<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ultra_News_-_Theme
 */

get_header();
?>

<main id="primary" class="site-main maim-singel">
    <section class="section-singel-post">
        <div class="container singel-post-container">
            <div class="row-singel-post">

                <div class="singel-post">
                    <div class="single-post-header">
                        <div class="category-post">
                            <?php
                            // عرض التصنيفات
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                            }
                            ?>
                        </div>
                        <div class="title-singel-post">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="meta-singel-post">
                            <span class="author">By 
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <span class="name-author"><?php echo esc_html(get_the_author_meta('display_name')); ?></span>
                                </a>
                            </span>
                            <span class="date"><?php echo get_the_date(); ?></span>
                            <span class="red"><span><?php echo estimated_reading_time(); ?></span> mins read</span> <!-- مدة القراءة -->
                            <span class="views"><i class="fas fa-eye"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                        </div>
                        <div class="share-singel-post">
                            <div class="comments-icon-post">
                                <i class="fa-regular fa-message"></i>
                                <span class="comments"><?php echo get_comments_number(); ?></span>
                            </div>
                            <div class="share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="single-content">
                        <div class="single-thumnail">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('large');
                            } ?>
                        </div>
                        <?php the_content(); ?> <!-- عرض محتوى المقال -->
                        <div class="tags-singel-post tags-footer">
                            <ul>
                                <?php
                                $post_tags = get_the_tags();
                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . esc_html($tag->name) . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- Share Buttons (Bottom) -->
                        <div class="share share-bottom">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                    <div class="author-singel-post">
						<div class="avatar-singel-post">
							<div class="image-author-singel-post">
								<?php 
								$author_id = get_the_author_meta('ID'); // استرجاع ID المؤلف
								echo get_avatar($author_id, 150); // عرض صورة المؤلف
								?>
							</div>
							<div class="info-author-singel-post">
								<a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
									<h4><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></h4>
								</a>
								<p>
									<?php 
									$author_description = get_the_author_meta('description', $author_id); 
									echo $author_description ? esc_html($author_description) : 'لا يوجد وصف متاح للمؤلف.';
									?>
								</p>
							</div>
						</div>
					</div>

                </div>

                <!-- Start sidebar widget Posts -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();
?>
