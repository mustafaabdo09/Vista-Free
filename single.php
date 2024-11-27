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
                <?php while (have_posts()) : the_post(); ?>
                    <div class="single-post-header">
                        <div class="category-post">
                            <?php
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
                            <span class="author">By <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
                            <span class="date"><?php echo get_the_date(); ?></span>
                            <span class="red"><?php echo estimated_reading_time(); ?> min read</span>
                            <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                        </div>
                        <div class="share-singel-post">
                            <div class="comments-icon-post">
                                <i class="fa-regular fa-message"></i>
                                <span class="comments"><?php comments_number('0', '1', '%'); ?></span>
                            </div>
                            <div class="share">
							<a href="#" onclick="openPopup('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-facebook-f"></i></a>
							<a href="#" onclick="openPopup('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>')"><i class="fab fa-twitter"></i></a>
							<a href="#" onclick="openPopup('https://www.instagram.com/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-instagram"></i></a>
							<a href="#" onclick="openPopup('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" onclick="openPopup('https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="single-content">
                        <div class="single-thumnail">
                        
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="content-body">
						<?php the_content(); ?>
						</div>
                        <div class="tags-singel-post tags-footer">
                            <ul>
                                <?php
                                $tags = get_the_tags();
                                if ($tags) {
                                    foreach ($tags as $tag) {
                                        echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="share share-bottom">
						<a href="#" onclick="openPopup('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-facebook-f"></i></a>
						<a href="#" onclick="openPopup('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>')"><i class="fab fa-twitter"></i></a>
						<a href="#" onclick="openPopup('https://www.instagram.com/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-instagram"></i></a>
						<a href="#" onclick="openPopup('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-linkedin-in"></i></a>
						<a href="#" onclick="openPopup('https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>')"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                    <div class="author-singel-post">
                        <div class="avatar-singel-post">
                            <div class="image-author-singel-post">
                                <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                            </div>
                            <div class="info-author-singel-post">
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <h4><?php the_author(); ?></h4>
                                </a>
                                <p><?php echo get_the_author_meta('description'); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="col-post related-posts">
                    <h2 class="title-related-posts">Related posts</h2>

                    <?php
                    // الحصول على التصنيفات المرتبطة بالمقال الحالي
                    $categories = get_the_category(get_the_ID());

                    if ($categories) {
                        $category_ids = array();

                        // جمع معرفات التصنيفات المرتبطة بالمقال
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }

                        // إعداد استعلام للحصول على المقالات ذات الصلة
                        $args = array(
                            'category__in' => $category_ids, // من نفس التصنيف
                            'post__not_in' => array(get_the_ID()), // استبعاد المقال الحالي
                            'posts_per_page' => 3, // جلب 3 مقالات فقط
                            'ignore_sticky_posts' => 1, // تجاهل المقالات المثبتة
                        );

                        $related_query = new WP_Query($args);

                        // التحقق مما إذا كانت هناك مقالات ذات صلة
                        if ($related_query->have_posts()) {
                            while ($related_query->have_posts()) {
                                $related_query->the_post();
                                ?>
                                <div class="post-container">
                                    <div class="post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                            <?php 
                                            // عرض الصورة المميزة للمقال
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('full', array('alt' => get_the_title())); // عرض الصورة
                                            } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/images/default-thumbnail.jpg'; ?>" alt="<?php the_title(); ?>">
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="category-post">
                                            <?php
                                            // عرض أول تصنيف فقط
                                            $category = get_the_category();
                                            if (!empty($category)) {
                                                echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html($category[0]->name) . '</a>';
                                            }
                                            ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>">
                                            <h3 class="post-title"><?php the_title(); ?></h3>
                                        </a>
                                        <div class="meta">
                                            <div class="date"><?php echo get_the_date(); ?></div>
                                            <span class="reading"><i class="fa-regular fa-clock"></i> <?php echo estimated_reading_time(); ?> mins read</span>
                                            <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                                        </div>
                                        <p class="post-extract"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>No related posts found.</p>';
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>

                


                <?php comments_template(); ?>
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
