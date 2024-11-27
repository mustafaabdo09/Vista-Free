<!---------------------------------- Start Slider ------------------------------------>
<section>
    <div class="container">
        <div class="slider">
            <div class="slides">
                <?php
                // إعداد الاستعلام لاسترجاع آخر 6 مقالات
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                );
                $query = new WP_Query($args);

                // التحقق مما إذا كانت هناك مقالات
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <div class="slide">
                            <div class="content">
                                <div class="category">
                                    <?php
                                    // عرض فئة المقالات كرابط
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="category-label">' . esc_html($categories[0]->name) . '</a>';
                                    }
                                    ?>
                                </div>
                                <h2 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="meta">
                                    <span class="date"><?php echo get_the_date(); ?></span>
                                    <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'views', true); ?> views</span>
                                </div>
                                <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                <div class="author">
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 32); // عرض صورة المؤلف ?>
                                    </a>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-name">
                                        <?php the_author(); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="image">
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
                        </div>
                        <?php
                    }
                    wp_reset_postdata(); // إعادة تعيين البيانات
                } else {
                    echo '<p>No posts found.</p>'; // في حالة عدم وجود مقالات
                }
                ?>
                <div class="navigation">
                <button class="prev"><i class="fa-solid fa-arrow-left-long"></i></button>
                <button class="next"><i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
            </div>

            
        </div>
    </div>
</section>
<!-- End - Slider -->
