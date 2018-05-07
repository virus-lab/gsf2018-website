<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Evnt
 * @since Evnt 1.0
 */
get_header();
?>
<div class="container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            // Start the loop.
            while (have_posts()) : the_post();
                /*
                 * Include the post format-specific template for the content. If you want to
                 * use this in a child theme, then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                if (get_post_type() === 'class') {
                    get_template_part('content', "class");
                } else {
                    get_template_part('content', get_post_format());
                }
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

                // Previous/next post navigation.
                the_post_navigation(array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'evnt') . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__('Next post:', 'evnt') . '</span> ' .
                    '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'evnt') . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__('Previous post:', 'evnt') . '</span> ' .
                    '<span class="post-title">%title</span>',
                ));

            // End the loop.
            endwhile;
            ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>
