<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ultra_News_-_Theme
 */

get_header();
?>

<main id="primary" class="site-main main-archive-posts">

    <section class="recent-posts archive-posts">
        <div class="container">
            <div class="header-archive-posts">
                <h1>
                    <?php
                    // عرض عنوان الأرشيف بناءً على نوعه
                    if (is_category()) {
                        single_cat_title(); // عرض اسم الفئة
                    } elseif (is_tag()) {
                        single_tag_title(); // عرض اسم الوسم
                    } elseif (is_author()) {
                        the_author(); // عرض اسم الكاتب
                    } elseif (is_date()) {
                        the_time('F Y'); // عرض التاريخ
                    } else {
                        _e('Archives', 'your-theme-textdomain'); // العنوان الافتراضي للأرشيف
                    }
                    ?>
                </h1> <!-- عنوان الأرشيف -->
                
                <div class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a>
                    <span><i class="fa-solid fa-chevron-right"></i></span>
                    <?php
                    // عرض اسم الأرشيف بناءً على نوعه
                    if (is_category()) {
                        single_cat_title(); // عرض اسم الفئة
                    } elseif (is_tag()) {
                        single_tag_title(); // عرض اسم الوسم
                    } elseif (is_author()) {
                        the_author(); // عرض اسم الكاتب
                    } elseif (is_date()) {
                        the_time('F Y'); // عرض التاريخ
                    } else {
                        _e('Archives', 'your-theme-textdomain'); // اسم افتراضي للأرشيف
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="container recent-posts-container container-archive-posts">
            <div class="row-post">
                <div class="col-posts-archive">
                    <div class="col-post">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
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
                                    <?php echo get_parent_category(get_the_ID()); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="post-title"><?php echo trim_post_title(get_the_title(), 6); ?></h3>
                                    </a>
                                    <div class="meta">
                                        <div class="date"><?php echo get_the_date(); ?></div>
                                        <span class="reading"><i class="fa-regular fa-clock"></i> <?php echo estimated_reading_time(); ?> mins read</span>
                                        <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                                    </div>
                                    <p class="post-extract"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php _e('No posts found'); ?></p>
                    <?php endif; ?>
                    </div>
                    <div class="pagination-area">
                        <ul class="pagination-archive">
                            <?php
                            // التصفح (Pagination)
                            the_posts_pagination(array(
                                'mid_size'  => 2,
                                'prev_text' => '<i class="fas fa-angle-left"></i>',
                                'next_text' => '<i class="fas fa-angle-right"></i>',
                            ));
                            ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Start Sidebar Widget -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php

get_footer();
?>
