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
            <div class="header-page-content header-archive-posts">
                <h1><?php the_title(); ?></h1> <!-- عنوان الصفحة -->
                <div class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a>
                    <span><i class="fa-solid fa-chevron-right"></i></span>
                    <?php the_title(); ?> <!-- اسم الصفحة -->
                </div>
            </div>
        </div>

        <div class="container page-content-container recent-posts-container container-archive-posts">
            <div class="row-page">
                <div class="col-page-content col-posts-archive">
                    <div class="col-content">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <div class="content-container">
                                    <div class="page-content">
                                        <?php
                                        // عرض محتوى الصفحة
                                        the_content();
                                        ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p><?php _e('No content found'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Start Sidebar Widget -->
                
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php

get_footer();
