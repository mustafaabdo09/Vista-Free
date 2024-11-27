    

    <!-- Start Recent Posts -->
    <section class="recent-posts">
        <div class="container recent-posts-container">
            <div class="recent-posts-title">
                <h2>Recent Posts</h2>
            </div>
            <div class="letter-background">
                Latest
            </div>
            <div class="row-post">
                <div class="col-post">

                <?php
                $posts_count = get_theme_mod('recent_posts_count', 6); // 6 هو العدد الافتراضي

// استعلام جلب المقالات
$recent_posts = new WP_Query(array(
    'posts_per_page' => $posts_count, // استخدام العدد من التخصيص
    'post_status'    => 'publish'
));

if ($recent_posts->have_posts()) :
    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
    
        <div class="post-container">
            <div class="post-thumb">
                <!-- عرض صورة المقال -->
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
                    <!-- عرض اسم الفئة مع رابط -->
                    <?php
                    $category = get_the_category();
                    if (!empty($category)) {
                        echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html($category[0]->name) . '</a>';
                    }
                    ?>
                </div>
                <!-- عرض عنوان المقال مع رابط -->
                <a href="<?php the_permalink(); ?>"><h3 class="post-title"><?php the_title(); ?></h3></a>
                
                <div class="meta">
                    <!-- تاريخ النشر -->
                    <div class="date"><?php echo get_the_date(); ?></div>
                    <!-- مدة القراءة المحسوبة -->
                    <span class="reading"><i class="fa-regular fa-clock"></i> <?php echo estimated_reading_time(); ?> mins read</span>
                    <!-- عدد المشاهدات -->
                    <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                </div>
                
                <!-- عرض مقتطف المقال -->
                <p class="post-extract"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                
                <!-- رابط "Read More" -->
                <a href="<?php the_permalink(); ?>" class="read-more">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
            </div>
        </div>
    
    <?php endwhile;
    wp_reset_postdata();
else : ?>
    <p>No recent posts available.</p>
<?php endif; ?>



                    
                </div>
                <?php get_sidebar();?>
            </div>




        </div>
    </section>



    <!-- End Recent Posts -->

