<?php
/**
 * Vista News - Theme (Free) functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ultra_News_-_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function ultranews_setup() {
    load_theme_textdomain( 'ultranews', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'ultranews' ),
            'topbar'  => __( 'Top Bar Menu', 'ultranews' ),
            'bottom_menu' => __( 'Bottom Menu', 'ultranews' ),
            
        )
    );


    function ultra_news_register_menus() {
        register_nav_menus(array(
            'footer-menu' => __('Footer Menu', 'ultra-news-theme'),
        ));
    }
    add_action('init', 'ultra_news_register_menus');

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'ultranews_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action( 'after_setup_theme', 'ultranews_setup' );


// تمكين دعم المؤلفين في القالب
if (!function_exists('ultranews_author_bio_support')) {
    function ultranews_author_bio_support() {
        add_action('show_user_profile', 'add_author_bio_field');
        add_action('edit_user_profile', 'add_author_bio_field');

        add_action('personal_options_update', 'save_author_bio_field');
        add_action('edit_user_profile_update', 'save_author_bio_field');
    }

    function add_author_bio_field($user) {
        ?>
        <h3><?php _e("Author Bio", "your_textdomain"); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="description"><?php _e("Biography"); ?></label></th>
                <td>
                    <textarea name="description" id="description" rows="5" cols="30"><?php echo esc_textarea(get_the_author_meta('description', $user->ID)); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
    }

    function save_author_bio_field($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        update_user_meta($user_id, 'description', $_POST['description']);
    }

    add_action('init', 'ultranews_author_bio_support');
}


function ultranews_author_bio_support() {
    add_post_type_support('post', 'author');
}
add_action('init', 'ultranews_author_bio_support');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function ultranews_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ultranews_content_width', 640 );
}
add_action( 'after_setup_theme', 'ultranews_content_width', 0 );



// ويدجيت الشبكات الاجتماعية 

function ultranews_register_sidebars() {
    register_sidebar( array(
        'name' => __( 'Sidebar Top', 'ultranews' ),
        'id' => 'sidebar-top',
        'description' => __( 'Widget area at the top of the sidebar', 'ultranews' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'ultranews_register_sidebars' );



// ويدجيت الشبكات الاجتماعية 

class Social_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'social_widget', 
            __('Social Follow Widget', 'ultranews'),
            array( 'description' => __( 'Display social follow buttons with custom links and follower counts', 'ultranews' ))
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('Follow Us', 'ultranews');
        echo $args['before_title'] . $title . $args['after_title'];

        // الشبكات الاجتماعية
        $social_networks = array('facebook', 'twitter', 'instagram', 'pinterest', 'tiktok', 'linkedin', 'youtube', 'github');

        echo '<div class="social-container">';
        foreach ($social_networks as $network) {
            $url = !empty($instance[$network.'_url']) ? esc_url($instance[$network.'_url']) : '#';
            $followers = !empty($instance[$network.'_followers']) ? esc_html($instance[$network.'_followers']) : '0';
            if ($url !== '#') {
                echo '<div class="social-box ' . $network . '">
                    <a href="' . $url . '">
                        <i class="fab fa-' . $network . '"></i>
                        <span class="name-count">' . ucfirst($network) . '</span>
                        <strong data-count="' . $followers . '">' . $followers . '</strong>
                        <span class="num-count">K</span>
                    </a>
                </div>';
            }
        }
        echo '</div>';

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Follow Us', 'ultranews');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php

        // الشبكات الاجتماعية
        $social_networks = array('facebook', 'twitter', 'instagram', 'pinterest', 'tiktok', 'linkedin', 'youtube', 'github');
        foreach ($social_networks as $network) {
            $url = !empty($instance[$network.'_url']) ? $instance[$network.'_url'] : '';
            $followers = !empty($instance[$network.'_followers']) ? $instance[$network.'_followers'] : '0';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($network.'_url')); ?>"><?php echo ucfirst($network); ?> URL:</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($network.'_url')); ?>" name="<?php echo esc_attr($this->get_field_name($network.'_url')); ?>" type="text" value="<?php echo esc_attr($url); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($network.'_followers')); ?>"><?php echo ucfirst($network); ?> Followers (K):</label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($network.'_followers')); ?>" name="<?php echo esc_attr($this->get_field_name($network.'_followers')); ?>" type="number" value="<?php echo esc_attr($followers); ?>">
            </p>
            <?php
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $social_networks = array('facebook', 'twitter', 'instagram', 'pinterest', 'tiktok', 'linkedin', 'youtube', 'github');
        foreach ($social_networks as $network) {
            $instance[$network.'_url'] = (!empty($new_instance[$network.'_url'])) ? strip_tags($new_instance[$network.'_url']) : '';
            $instance[$network.'_followers'] = (!empty($new_instance[$network.'_followers'])) ? strip_tags($new_instance[$network.'_followers']) : '0';
        }
        return $instance;
    }
}

// تسجيل الويدجيت
function register_social_widget() {
    register_widget('Social_Widget');
}
add_action('widgets_init', 'register_social_widget');


//  انتهاء ويدجيت الشبكات الاجتماعية 













/**
 * Register widget area.
 */
function ultranews_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'ultranews' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'ultranews' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'ultranews_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ultranews_scripts() {
    wp_enqueue_style( 'ultranews-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'ultranews-style', 'rtl', 'replace' );

    wp_enqueue_script( 'ultranews-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );


    // إضافة ملف CSS مخصص
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/style.css', array(), _S_VERSION );

    // إضافة ملف JavaScript مخصص
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/assets/main.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script( 'ajax-comment', get_template_directory_uri() . '/js/ajax-comment.js', array('jquery'), _S_VERSION, true );

      // تمرير URL الخاص بـ admin-ajax.php إلى الجافاسكريبت
      wp_localize_script( 'custom-script', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

     // إضافة Font Awesome
     wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), null, 'all' );

     // إضافة Google Fonts
     wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), null, 'all' );
 

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ultranews_scripts' );

/**
 * Enqueue scripts and styles Ultra Theme.
 */



 




/**
 * Customizer additions.
 */
function theme_customize_register( $wp_customize ) {
  

    // روابط الشبكات الاجتماعية
    $wp_customize->add_section( 'social_links_section', array(
        'title'       => __( 'Social Links', 'ultranews' ),
        'priority'    => 30,
    ) );

    // إضافة الروابط الاجتماعية
    $social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'tiktok' );
    foreach ( $social_networks as $network ) {
        $wp_customize->add_setting( $network . '_link', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( $network . '_link', array(
            'label'    => ucfirst($network) . ' Link',
            'section'  => 'social_links_section',
            'type'     => 'url',
        ) );
    }
}
add_action( 'customize_register', 'theme_customize_register' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/admin/inc/customizer-admin.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}




add_theme_support('post-thumbnails');





// تحديث عدد المشاهدات للمقالة
function ultranews_set_post_views($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// استدعاء الدالة عند عرض المقالة
function ultranews_track_post_views($post_id) {
    if (!is_single()) return; // فقط في حالة عرض المقالات الفردية
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    ultranews_set_post_views($post_id);
}
add_action('wp_head', 'ultranews_track_post_views');





// إعدادات الفوتر


function ultra_news_theme_customizer_settings($wp_customize) {
    // قسم About Us
    $wp_customize->add_section('footer_about_section', array(
        'title'    => __('About Us', 'ultra-news-theme'),
        'priority' => 30,
    ));

    // حقل وصف الموقع
    $wp_customize->add_setting('footer_about_description', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_about_description', array(
        'label'   => __('Description', 'ultra-news-theme'),
        'section' => 'footer_about_section',
        'type'    => 'textarea',
    ));

    // حقل العنوان
    $wp_customize->add_setting('footer_address', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_address', array(
        'label'   => __('Address', 'ultra-news-theme'),
        'section' => 'footer_about_section',
        'type'    => 'text',
    ));

    // حقل الهاتف
    $wp_customize->add_setting('footer_phone', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_phone', array(
        'label'   => __('Phone', 'ultra-news-theme'),
        'section' => 'footer_about_section',
        'type'    => 'text',
    ));

    // حقل البريد الإلكتروني
    $wp_customize->add_setting('footer_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('footer_email', array(
        'label'   => __('Email', 'ultra-news-theme'),
        'section' => 'footer_about_section',
        'type'    => 'email',
    ));


}
add_action('customize_register', 'ultra_news_theme_customizer_settings');






function ultra_news_customize_register($wp_customize) {
    // إضافة قسم للفوتر
    $wp_customize->add_section('ultra_news_footer_section', array(
        'title'    => __('Footer Settings', 'ultra-news-theme'),
        'priority' => 130,
    ));

    // إضافة إعداد نص حقوق الملكية
    $wp_customize->add_setting('ultra_news_copyright_text', array(
        'default'   => '© 2024 My Website',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));

    // عنصر الإدخال لنص حقوق الملكية
    $wp_customize->add_control('ultra_news_copyright_text_control', array(
        'label'    => __('Copyright Text', 'ultra-news-theme'),
        'section'  => 'ultra_news_footer_section',
        'settings' => 'ultra_news_copyright_text',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'ultra_news_customize_register');



// تسجيل ويدجيت المقالات الشعبية
// إضافة ويدجيت للمقالات الشعبية
class Popular_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'popular_posts_widget', // Base ID
            __('Popular Posts', 'ultra-news-theme'), // Name
            array('description' => __('Displays popular posts', 'ultra-news-theme'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="post-footer">';
        
        // استعلام لجلب المقالات الأكثر شعبية
        $popular_posts = new WP_Query(array(
            'posts_per_page' => 4,
            'meta_key' => 'post_views_count', // تأكد من استخدام meta_key الصحيح لعدد المشاهدات
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));

        if ($popular_posts->have_posts()) {
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                ?>

                <div class="footer-articles">
                    <div class="content-post-footer">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('thumbnail'); // احصل على الصورة المصغرة
                            } ?>
                        </a>
                    </div>
                    <div class="meta-post-footer">
                        <h3><a href="<?php the_permalink(); ?>"><?php echo trim_post_title(get_the_title(), 6); ?></a></h3>
                        <span class="date"><?php echo get_the_date(); ?></span>
                        <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'post_views_count', true); ?></span>
                    </div>
                </div>

                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p>No popular posts found.</p>';
        }

        echo '</div>';
        echo $args['after_widget'];
    }
}

// تسجيل الويدجيت
function register_popular_posts_widget() {
    register_widget('Popular_Posts_Widget');
}
add_action('widgets_init', 'register_popular_posts_widget');


// تسجيل منطقة الويدجيت للفوتر
function register_footer_widget_area() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'ultra-news-theme'),
        'id'            => 'footer-widget-area',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'register_footer_widget_area');


function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
add_action('wp_head', 'track_post_views');
function track_post_views() {
    if (is_single()) {
        global $post;
        set_post_views($post->ID);
    }
}



function my_custom_footer_menu($wp_customize) {
    $wp_customize->add_section('footer_menu_section', array(
        'title' => __('Quick Links', 'ultra-news-theme'),
        'priority' => 30,
    ));

    for ($i = 1; $i <= 4; $i++) {
        // حقل لاسم الصفحة (الذي سيظهر في الفوتر)
        $wp_customize->add_setting("footer_menu_item_{$i}_page_name", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        // حقل للرابط
        $wp_customize->add_setting("footer_menu_item_{$i}_link", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // إضافة عناصر التحكم
        $wp_customize->add_control("footer_menu_item_{$i}_page_name", array(
            'label' => __("Menu Item {$i} Page Name", 'ultra-news-theme'),
            'section' => 'footer_menu_section',
            'type' => 'text',
        ));
        
        $wp_customize->add_control("footer_menu_item_{$i}_link", array(
            'label' => __("Menu Item {$i} Link", 'ultra-news-theme'),
            'section' => 'footer_menu_section',
            'type' => 'url',
        ));
    }
}

add_action('customize_register', 'my_custom_footer_menu');



function my_custom_footer_categories($wp_customize) {
    // إضافة قسم للفئات
    $wp_customize->add_section('footer_categories_section', array(
        'title' => __('Categories', 'ultra-news-theme'),
        'priority' => 31,
    ));

    // الحصول على جميع الفئات
    $categories = get_categories(array(
        'hide_empty' => false, // يعرض جميع الفئات بغض النظر عن كونها تحتوي على مقالات أم لا
    ));
    
    // إضافة خانة اختيار لكل فئة
    foreach ($categories as $category) {
        $wp_customize->add_setting("footer_category_{$category->term_id}", array(
            'default' => '0',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("footer_category_{$category->term_id}", array(
            'label' => sprintf(__('Show %s', 'ultra-news-theme'), $category->name),
            'section' => 'footer_categories_section',
            'type' => 'checkbox',
        ));
    }
}

add_action('customize_register', 'my_custom_footer_categories');




// تسجيل ويدجت الاشتراك في النشرة الإخبارية
function register_subscribe_widget() {
    register_sidebar(array(
        'name'          => __('Footer Subscribe Widget', 'ultra-news-theme'),
        'id'            => 'footer-subscribe-widget',
        'before_widget' => '<div class="subscribe-footer">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'register_subscribe_widget');

// إضافة خيارات تخصيص الكود للاشتراك
function customize_subscribe_widget($wp_customize) {
    $wp_customize->add_section('subscribe_widget_section', array(
        'title' => __('Subscribe Widget', 'ultra-news-theme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('subscribe_code', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('subscribe_code', array(
        'label' => __('Subscribe Code', 'ultra-news-theme'),
        'section' => 'subscribe_widget_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'customize_subscribe_widget');


//  إضافة مدة القراءة

function estimated_reading_time() {
    // جلب محتوى المقال
    $post_content = get_post_field('post_content', get_the_ID());
    // حساب عدد الكلمات
    $word_count = str_word_count(strip_tags($post_content));
    // افتراض أن الشخص يقرأ 200 كلمة في الدقيقة
    $reading_time = ceil($word_count / 200);

    // إذا كانت مدة القراءة أقل من دقيقة نعرض دقيقة واحدة على الأقل
    return $reading_time < 1 ? 1 : $reading_time;
}



    // إعداد جديد للتحكم في عدد المقالات


    function ultranews_customize_register($wp_customize) {
        $wp_customize->add_setting('recent_posts_count', array(
            'default' => 6, // القيمة الافتراضية
            'sanitize_callback' => 'absint',
        ));
    
        $wp_customize->add_section('ultranews_recent_posts_section', array(
            'title'    => __('Recent Posts Settings', 'ultranews'),
            'priority' => 30,
        ));
    
        $wp_customize->add_control('recent_posts_count', array(
            'label'   => __('Number of Recent Posts', 'ultranews'),
            'section' => 'ultranews_recent_posts_section',
            'type'    => 'number',
        ));
    }
    add_action('customize_register', 'ultranews_customize_register');
    


           // انشاء ويدجت متعدد الاقسام


           
        

           $popular_args = array(
            'posts_per_page' => 5, // عدد المشاركات المعروضة
            'meta_key' => 'post_views_count', // هنا نجلب المشاركات الأكثر مشاهدة
            'orderby' => 'meta_value_num', // الترتيب حسب عدد المشاهدات
            'order' => 'DESC'
        );
        $popular_posts = new WP_Query($popular_args);

        




        $featured_args = array(
            'meta_key' => 'featured', 
            'meta_value' => '1', // استعلام يجلب المشاركات المميزة فقط
            'posts_per_page' => 5, 
            'order' => 'DESC'
        );
        $featured_posts = new WP_Query($featured_args);

        








        // استعلام المشاركات المميزة
$featured_args = array(
    'meta_query' => array(
        array(
            'key' => 'featured',
            'value' => '1',
            'compare' => '='
        ),
    ),
    'posts_per_page' => 5
);
$featured_posts = new WP_Query($featured_args);



      //  =====================================



// اضافة ميزة المشاركات المميزة في المشاركات

function add_featured_meta_box() {
    add_meta_box('featured_meta_box', 'Featured Post', 'show_featured_meta_box', 'post', 'side', 'high');
}
add_action('add_meta_boxes', 'add_featured_meta_box');

function show_featured_meta_box($post) {
    $value = get_post_meta($post->ID, 'featured', true);
    ?>
    <label for="featured">
        <input type="checkbox" name="featured" value="1" <?php checked($value, 1); ?> /> Mark as Featured
    </label>
    <?php
}

function save_featured_meta_box($post_id) {
    if (array_key_exists('featured', $_POST)) {
        update_post_meta($post_id, 'featured', 1);
    } else {
        delete_post_meta($post_id, 'featured');
    }
}
add_action('save_post', 'save_featured_meta_box');






      //  ===================================== ويدجيت متعدد التبويب  


      class UltraNews_Multi_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'ultra_news_multi_widget',
                esc_html__('Multi Widget', 'ultra-news-theme'),
                array('description' => esc_html__('A Widget with Multiple Tabs', 'ultra-news-theme'))
            );
        }
    
        public function widget($args, $instance) {
            echo $args['before_widget']; ?>
    
            <!-- Start Multi widget Posts -->
            <div class="warpper">
                <input class="radio" id="one" name="group" type="radio" checked>
                <input class="radio" id="two" name="group" type="radio">
                <input class="radio" id="three" name="group" type="radio">
                <div class="tabs">
                    <label class="tab" id="one-tab" for="one">Popular</label>
                    <label class="tab" id="two-tab" for="two">Feature</label>
                    <label class="tab" id="three-tab" for="three">Comments</label>
                </div>
                <div class="panels">
                    <!-- Popular Posts -->
                    <div class="panel" id="one-panel">
                        <?php
                        $popular_posts = new WP_Query(array(
                            'posts_per_page' => 4,
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                        ));
                        if ($popular_posts->have_posts()) :
                            while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                                <div class="post-footer popular-post-widgit">
                                    <div class="content-post-footer">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                    </div>
                                    <div class="meta-post-footer">
                                        <div class="category-post"><?php the_category(', '); ?></div>
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo trim_post_title(get_the_title(), 6); ?></a></h3>
                                        <span class="date"><?php echo get_the_date(); ?></span>
                                        <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'post_views_count', true); ?> views</span>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                    
                    <!-- Feature Posts -->
                    <div class="panel" id="two-panel">
                        <div class="feature-posts">
                        <?php
                        $feature_posts = new WP_Query(array(
                            'posts_per_page' => 4,
                            'meta_key' => 'featured',
                            'meta_value' => '1',
                        ));
                        if ($feature_posts->have_posts()) :
                            while ($feature_posts->have_posts()) : $feature_posts->the_post(); ?>
                            <div class="feature-posts-widgit">
                            <div class="post-footer feature-post">
                                    <div class="content-post-footer">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                    </div>
                                    <div class="meta-post-footer">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo trim_post_title(get_the_title(), 6); ?></a></h3>
                                        <span class="date"><?php echo get_the_date(); ?></span>
                                        <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'post_views_count', true); ?></span>
                                    </div>
                                </div>
                            </div>
                                
                            <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                        </div>
                        
                    </div>
    
                    <!-- Posts with Comments -->
                    <div class="panel" id="three-panel">
                        <?php
                        $commented_posts = new WP_Query(array(
                            'posts_per_page' => 4,
                            'orderby' => 'comment_count',
                            'order' => 'DESC',
                        ));
                        if ($commented_posts->have_posts()) :
                            while ($commented_posts->have_posts()) : $commented_posts->the_post(); ?>
                                <div class="post-footer popular-post-widgit">
                                    <div class="content-post-footer">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                    </div>
                                    <div class="meta-post-footer">
                                        <div class="category-post"><?php the_category(', '); ?></div>
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo trim_post_title(get_the_title(), 6); ?></a></h3>
                                        <span class="date"><?php echo get_the_date(); ?></span>
                                        <span class="views"><i class="fa fa-bolt fa-fw"></i> <?php echo get_post_meta(get_the_ID(), 'post_views_count', true); ?> views</span>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Multi widget Posts -->
    
            <?php
            echo $args['after_widget'];
        }
    
        public function form($instance) {
            // Form fields here (optional)
        }
    
        public function update($new_instance, $old_instance) {
            $instance = array();
            return $instance;
        }
    }
    
    function ultra_news_register_multi_widget() {
        register_widget('UltraNews_Multi_Widget');
    }
    
    add_action('widgets_init', 'ultra_news_register_multi_widget');
    


//====================== =======صورة مصغرة


function display_post_thumbnail_or_first_image_or_default() {
    global $post;

    // 1. إذا كانت هناك صورة مميزة
    if (has_post_thumbnail()) {
        the_post_thumbnail('large'); // عرض الصورة المميزة بحجم كبير
    } else {
        // 2. البحث عن أول صورة في محتوى المقال
        $content = $post->post_content;
        $first_img = '';
        
        // استخدام تعبير عادي للعثور على أول صورة في محتوى المقال
        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);

        if (!empty($matches[1])) {
            $first_img = $matches[1];
        }

        // 3. إذا وجدت صورة داخل المقال، عرضها
        if ($first_img) {
            echo '<img src="' . esc_url($first_img) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            // 4. إذا لم يكن هناك صورة مميزة ولا صورة داخل المقال، عرض الصورة الافتراضية
            $default_image = get_template_directory_uri() . '/images/default-thumbnail.jpg'; // مسار الصورة الافتراضية

            if (file_exists(get_template_directory() . '/images/default-thumbnail.jpg')) {
                echo '<img src="' . esc_url($default_image) . '" alt="Default Image" />';
            } else {
                echo '<p>Default image not found. Please upload an image to the theme\'s /images folder.</p>';
            }
        }
    }
}


// عرض الفئة الأم فقط

function get_parent_category($post_id) {
    $categories = get_the_category($post_id);

    if (!empty($categories)) {
        foreach ($categories as $category) {
            if ($category->category_parent == 0) {
                return '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
            }
        }
    }

    return '';
}


// قطع العنوان الى 6 كلمات ...

function trim_post_title($title, $limit = 6) {
    $title_array = explode(' ', $title);
    
    if (count($title_array) > $limit) {
        $title_array = array_slice($title_array, 0, $limit);
        $title = implode(' ', $title_array) . '...';
    }
    
    return $title;
}







//=========================================================
    function custom_comment_reply_link($link, $args, $comment, $post) {
        // استبدال نص الرابط بأيقونة واحدة فقط
        $icon = '<i class="fas fa-reply"></i>';
    
        // التأكد من أن النص يتم استبداله مرة واحدة فقط بإزالة النص الأصلي بين الوسمين
        $link = preg_replace('/>([^<]+)</', '>' . $icon . '<', $link);
    
        return $link;
    }
    add_filter('comment_reply_link', 'custom_comment_reply_link', 10, 4);
    
    
    
    
    function replace_comment_edit_link($comment_text, $comment) {
        // الحصول على رابط تعديل التعليق
        $edit_link = get_edit_comment_link($comment->comment_ID);
        
        // تحقق إذا كان المستخدم لديه صلاحيات التعديل
        if (current_user_can('edit_comment', $comment->comment_ID)) {
            // استبدال رابط النص بأيقونة
            $icon = '<i class="fas fa-edit"></i>'; // استخدم Font Awesome أو أي أيقونة تفضلها
            $comment_text .= ' ' . '<a href="' . esc_url($edit_link) . '">' . $icon . '</a>';
        }
        
        return $comment_text;
    }
    add_filter('comment_text', 'replace_comment_edit_link', 10, 2);
    
    


















    // إنشاء ويدجيت التصنيفات مع عدد المقالات
class Category_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'category_widget',
            __('تصنيفات المقالات', 'ultra-news-theme'),
            array('description' => __('عرض التصنيفات مع عدد المقالات', 'ultra-news-theme'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $category_slugs = !empty($instance['category_slugs']) ? $instance['category_slugs'] : array();

        foreach ($category_slugs as $category_slug) {
            $category = get_category_by_slug($category_slug);

            if ($category) {
                $category_name = $category->name;
                $category_count = $category->count;

                echo '<p><a href="' . get_category_link($category->term_id) . '">' . $category_name . '</a> (' . $category_count . ')</p>';
            }
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $category_slugs = !empty($instance['category_slugs']) ? $instance['category_slugs'] : array();
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('category_slugs'); ?>"><?php _e('اختر التصنيفات:'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('category_slugs'); ?>"
        name="<?php echo $this->get_field_name('category_slugs'); ?>[]" multiple>
        <?php
                $categories = get_categories();
                foreach ($categories as $cat) {
                    echo '<option value="' . esc_attr($cat->slug) . '" ' . selected(in_array($cat->slug, $category_slugs), true, false) . '>' . esc_html($cat->name) . '</option>';
                }
                ?>
    </select>
</p>
<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['category_slugs'] = (!empty($new_instance['category_slugs'])) ? array_map('sanitize_title', $new_instance['category_slugs']) : array();
        return $instance;
    }
}

function register_category_widget() {
    register_widget('Category_Widget');
}

add_action('widgets_init', 'register_category_widget');

// دعم نموذج الاتصال

function handle_contact_form_submission() {
    // التأكد من وجود البيانات المطلوبة
    if (isset($_POST['form_data'])) {
        // تحويل السلسلة المرسلة إلى مصفوفة
        parse_str($_POST['form_data'], $form_data);

        // استخراج البيانات من المصفوفة
        $name = sanitize_text_field($form_data['name']);
        $email = sanitize_email($form_data['email']);
        $subject = sanitize_text_field($form_data['subject']);
        $message = sanitize_textarea_field($form_data['message']);

        // إعداد البريد الإلكتروني
        // استخدام البريد الإلكتروني المسجل
        $to = get_option('ultranews_contact_email'); // الحصول على البريد الإلكتروني من الإعدادات
        $email_subject = $subject;
        $email_message = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // إرسال البريد الإلكتروني
        if (wp_mail($to, $email_subject, $email_message)) {
            // استجابة ناجحة
            wp_send_json_success();
        } else {
            // استجابة فاشلة
            wp_send_json_error();
        }
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_submit_contact_form', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form_submission');

// نموذج استقبال الرسائل

// أضف هذا الكود إلى ملف functions.php في القالب الخاص بك

// إضافة صفحة إعدادات مخصصة
function ultranews_add_admin_menu() {
    add_options_page('Contact Form Settings', 'Contact Form', 'manage_options', 'contact_form', 'ultranews_contact_form_options_page');
}
add_action('admin_menu', 'ultranews_add_admin_menu');

// تسجيل الإعدادات
function ultranews_settings_init() {
    register_setting('contactForm', 'ultranews_contact_email');

    add_settings_section(
        'ultranews_contactForm_section',
        __('Customize your contact form settings', 'ultranews'),
        null,
        'contactForm'
    );

    add_settings_field(
        'ultranews_contact_email',
        __('Contact Email', 'ultranews'),
        'ultranews_contact_email_render',
        'contactForm',
        'ultranews_contactForm_section'
    );
}
add_action('admin_init', 'ultranews_settings_init');

// دالة عرض الحقل
function ultranews_contact_email_render() {
    $options = get_option('ultranews_contact_email');
    ?>
    <input type='text' name='ultranews_contact_email' value='<?php echo esc_attr($options); ?>' />
    <?php
}

// دالة عرض صفحة الإعدادات
function ultranews_contact_form_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Contact Form Settings</h2>
        <?php
        settings_fields('contactForm');
        do_settings_sections('contactForm');
        submit_button();
        ?>
    </form>
    <?php
}




//===========================================صفحة استقبال الرسائل


// ويدجيت اشتراك القائمة البريدية الموقع


function custom_subscribe_widget_init() {
    register_widget('Custom_Subscribe_Widget');
}
add_action('widgets_init', 'custom_subscribe_widget_init');

class Custom_Subscribe_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'custom_subscribe_widget',
            __('Subscribe Widget', 'ultra-news-theme'),
            array(
                'description' => __('A custom subscribe widget with Mailchimp integration', 'ultra-news-theme'),
                'customize_selective_refresh' => true,
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? esc_attr($instance['title']) : __('Subscribe via Email', 'ultra-news-theme');
        $mailchimp_code = !empty($instance['mailchimp_code']) ? $instance['mailchimp_code'] : '';
        $description = !empty($instance['description']) ? esc_html($instance['description']) : '';

        echo '<div class="widget sibForm">';
        echo '<div class="widget-content" data-shortcode="' . esc_attr($mailchimp_code) . '">';
        echo '<div class="follow-by-email">';
        echo '<h3 class="follow-by-email-title">' . esc_html($title) . '</h3>';

        // Print description if available
        if (!empty($description)) {
            echo '<p class="follow-by-email-caption">' . esc_html($description) . '</p>';
        }

        echo '<div class="follow-by-email-inner">';
        echo '<form action="' . esc_url('') . '" method="post" name="sib-subscribe-form" novalidate="" onsubmit="window.open(&quot;https://hubwebz.us10.list-manage.com/subscribe?u=45c4bf57d97dd1ff884a16494&amp;id=8d41a8d434&quot;,&quot;popupwindow&quot;,&quot;scrollbars=yes,width=550,height=520&quot;);return true" target="popupwindow">';
        echo '<div class="subscribe-button-wrapper">';
        echo '<input class="follow-by-email-address" name="EMAIL" placeholder="Email Address" type="email" value="">';
        echo '<input class="follow-by-email-submit" name="subscribe" type="submit" value="' . esc_attr__('Subscribe', 'ultra-news-theme') . '">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '<div class="Follow-by-alert">' . esc_html__('* We promise not to send spam!', 'ultra-news-theme') . '</div>';
        echo '</div>';
        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $mailchimp_code = isset($instance['mailchimp_code']) ? esc_textarea($instance['mailchimp_code']) : '';
        $description = isset($instance['description']) ? esc_textarea($instance['description']) : '';
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'ultra-news-theme'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
    <label
        for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Widget Description:', 'ultra-news-theme'); ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>"
        name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
</p>
<p>
    <label
        for="<?php echo $this->get_field_id('mailchimp_code'); ?>"><?php _e('Mailchimp Embed Code:', 'ultra-news-theme'); ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('mailchimp_code'); ?>"
        name="<?php echo $this->get_field_name('mailchimp_code'); ?>"><?php echo $mailchimp_code; ?></textarea>
</p>
<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? $new_instance['description'] : '';
        $instance['mailchimp_code'] = (!empty($new_instance['mailchimp_code'])) ? $new_instance['mailchimp_code'] : '';
        return $instance;
    }

}








function custom_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Custom Widget Area', 'ultra-news-theme' ),
        'id'            => 'custom-widget-area',
        'description'   => __( 'Add widgets here to appear in the Customizer.', 'ultra-news-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );

add_theme_support( 'widgets' );











//======================================================





//======================


//=========================

// التعامل مع إدخال الرمز

// التعامل مع إدخال الرمز
add_action('admin_init', 'handle_license_activation');
function handle_license_activation() {
    if (isset($_POST['activate_license'])) {
        $license_key = sanitize_text_field($_POST['license_key']);
        
        // بناء URL للتحقق من الرمز
        $verify_url = 'https://daz.fnp.mybluehost.me/verify_license.php?license_key=' . urlencode($license_key) . '&site_url=' . urlencode(home_url());

        // إرسال طلب للتحقق من الرمز
        $response = file_get_contents($verify_url);

        // التحقق من الرد
        $body = json_decode($response, true);
        
        // التحقق من وجود المفتاح "status"
        if (isset($body['status']) && $body['status'] == 'valid') {
            update_option('theme_is_activated', 'yes');
            echo '<div class="notice notice-success"><p>' . __('Theme activated successfully.', 'your-text-domain') . '</p></div>';
            update_option('license_key', $license_key); // حفظ الرمز المفعّل
        } else {
            update_option('theme_is_activated', 'no');
            echo '<div class="notice notice-error"><p>' . __('Activation key is invalid or another error occurred.', 'your-text-domain') . '</p></div>';
        }
    }
}

// إضافة صفحة إدخال رمز التفعيل في لوحة التحكم
add_action('admin_menu', 'add_license_menu');
function add_license_menu() {
    add_menu_page(__('Theme Activation', 'your-text-domain'), __('Theme Activation', 'your-text-domain'), 'manage_options', 'theme-activation', 'license_activation_page');
}

// صفحة إدخال رمز التفعيل
function license_activation_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Activate Theme', 'your-text-domain'); ?></h1>
        <?php if (get_option('theme_is_activated') == 'yes'): ?>
            <div style="color: green; font-size: 20px;">
                <span style="color: green;">&#10003;</span> <?php _e('Activated', 'your-text-domain'); ?>
            </div>
        <?php else: ?>
            <form method="post" action="">
                <label for="license_key"><?php _e('Enter Activation Key:', 'your-text-domain'); ?></label>
                <input type="text" name="license_key" id="license_key" required>
                <input type="submit" name="activate_license" value="<?php _e('Activate', 'your-text-domain'); ?>">
            </form>
        <?php endif; ?>
    </div>
    <?php
}


// إضافة CSS لتحسين تصميم صفحة التفعيل
add_action('admin_enqueue_scripts', 'enqueue_license_activation_styles');
function enqueue_license_activation_styles() {
    echo '<style>
        .wrap {
            
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #0073aa;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #005177;
        }
    </style>';
}




