<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ultra_News_-_Theme
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) :
        ?>
        
        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ultranews' ); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().
    ?>

    <!-- نموذج التعليقات المخصص -->
    <div class="comment-respond">
        <h3 class="comment-reply-title">
            <span class="tj-comment__title">Leave a Reply</span>
        </h3>

        <?php
        $comments_args = array(
            'title_reply'          => '',
            'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">Your email address will not be published.</span><span class="required-field-message">Required fields are marked <span class="required">*</span></span></p>',
            'label_submit'         => 'Post Comment',
            'fields'               => array(
                'author' => '<div class="form_group form_group-top"><input class="form-control" placeholder="Enter Name" id="author" name="author" type="text" aria-required="true" />',
                'email'  => '<input class="form-control" placeholder="Enter Email" id="email" name="email" type="email" aria-required="true" /></div>',
            ),
            'comment_field'        => '<div class="row-form-comment"><div class="col-md-12"><div class="form_group"><textarea class="msg-box form-control" placeholder="Enter Your Comments" id="comment" name="comment" cols="45" rows="8"></textarea></div></div><div class="clearfix"></div></div>',
            'class_form'           => 'tj-post-comment__form',
            'class_submit'         => 'tj-btn-primary submit',
            'comment_notes_after'  => '',
            'submit_button'        => '<button class="tj-btn-primary submit" type="submit">%2$s</button>',
        );

        // إضافة حقل مخفي لنقل معرف المقال
        $comments_args['hidden_fields'] = '<input type="hidden" name="comment_post_ID" value="' . get_the_ID() . '" />';

        comment_form( $comments_args );
        ?>
    </div><!-- .comment-respond -->

</div><!-- #comments -->
