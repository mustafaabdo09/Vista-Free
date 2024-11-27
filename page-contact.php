<?php
/**
 * Template Name: Contact Page
 *
 * This is the template for displaying the contact page.
 *
 * @package Ultra_News_-_Theme
 */

get_header();
?>

<main id="primary" class="site-main main-contact-page">

    <!-- بداية قسم نموذج الاتصال -->
    <section class="contact-section page-content recent-posts archive-posts">
        <div class="container">
            <div class="header-page-content header-archive-posts">
                <h1><?php the_title(); ?></h1> <!-- عنوان الصفحة -->
                <div class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a>
                    <span><i class="fa-solid fa-chevron-right"></i></span>
                    Contact
                </div>
            </div>

            <div class="contact-form-area">
                <div class="comment-respond">
                    <h3 class="comment-reply-title">
                        <span class="tj-comment__title">Send Us a Message</span>
                    </h3>
                    <div id="form-message" style="display:none;"></div>

                    <form action="process-contact.php" method="POST" class="tj-post-comment__form">
                        <p class="comment-notes">
                            <span class="required-field-message">Required fields are marked <span class="required">*</span></span>
                        </p>
                        <div class="form_group form_group-top ">
                            <input class="form-control" placeholder="Enter Name" id="author" name="name" type="text" required />
                            <input class="form-control" placeholder="Enter Email" id="email" name="email" type="email" required />
                        </div>
                        <div class="form_group form_group-top ">
                            <input class="form-control" placeholder="Enter Subject" id="subject" name="subject" type="text" required />
                        </div>
                        <div class="row-form-comment">
                            <div class="col-md-12">
                                <div class="form_group">
                                    <textarea class="msg-box form-control" placeholder="Enter Your Message" id="message" name="message" cols="45" rows="8" required></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <button class="tj-btn-primary submit" type="submit">Send Message</button>
                    </form>
                    <div id="form-message" style="display:none;"></div>

                </div>

                <div class="col-contact-details">
                    <img src="<?php echo get_template_directory_uri() . '/images/contact-us.png'; ?>" alt="">
                    
                </div>
            </div>

            <!-- إضافة خريطة Google Maps -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d110524.09923717925!2d31.43816786093751!3d30.040354833383837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1727867531168!5m2!1sar!2seg" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <!-- نهاية قسم نموذج الاتصال -->

</main><!-- #main -->

<?php
get_footer();
?>
