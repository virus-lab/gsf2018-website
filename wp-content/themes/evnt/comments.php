<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package evnt
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area comments">

    <?php // You can start editing here -- including this comment!  ?>

    <?php if (have_comments()) : ?>
        <h2 class="comments-title"><?php comments_number(esc_html__('No Comments', 'evnt'), esc_html__('1 Comment', 'evnt'), esc_html__('% Comments', 'evnt')); ?></h2>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'evnt'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'evnt')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'evnt')); ?></div>
            </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation  ?>

        <div class="comment-list media-list">
            <?php
            wp_list_comments(array(
                'style' => 'div',
                'short_ping' => true,
                'callback' => 'evnt_comment',
                'max_depth' => 3
            ));
            ?>
        </div><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'evnt'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'evnt')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'evnt')); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation  ?>

    <?php endif; // have_comments()  ?>

    <?php
    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );

    // Custom Fields
    $fields = array(
        'author' => '<div class="form-group"><label for="author">' . esc_html__('Name *', 'evnt') . '</label><input name="author" class="form-control" type="text" placeholder="' . esc_html__('John Doe', 'evnt') . '" size="30"' . $aria_req . '></div>',
        'email' => '<div class="form-group"><label for="email">' . esc_html__('Email *', 'evnt') . '</label><input name="email" class="form-control" type="text" placeholder="' . esc_html__('name@domain.com', 'evnt') . '" size="30"' . $aria_req . '></div>',
        'website' => '<div class="form-group"><label for="website">' . esc_html__('Website (not required)', 'evnt') . '</label><input name="website" class="form-control" type="text" placeholder="' . esc_html__('www.domain.com', 'evnt') . '" size="30"></div>',
    );

    //Comment Form Args
    $comments_args = array(
        'fields' => $fields,
        'title_reply' => esc_html__('Leave a Comment', 'evnt'),
        'comment_field' => '<div class="form-group"><label for="comment">' . esc_html__('Message', 'evnt') . '</label><textarea id="comment" name="comment" class="form-control" cols="10" rows="6" tabindex="4"' . $aria_req . '></textarea></div>',
        'label_submit' => esc_html__('Submit', 'evnt'),
        'class_submit'      => 'btn btn-primary'
    );
    ?>

    <!--<hr>-->

    <?php comment_form($comments_args); ?>

</div><!-- #comments -->
