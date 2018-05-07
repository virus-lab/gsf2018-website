<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Evnt
 * @since Evnt 1.0beta
 */
get_header();
?>

<div id="primary" class="content-area">
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
                        <p><img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/404.gif" alt="<?php esc_attr_e('Error 404', 'evnt'); ?>" class="img-responsive" /></p>
                    </div>
                    <div class="col-sm-6">
                        <div class="headings">
                            <h1><?php esc_html_e('Error 404', 'evnt'); ?></h1>
                            <h6><?php esc_attr_e("It looks like you're lost", 'evnt'); ?></h6>
                        </div>
                        <p><?php esc_attr_e('Page not been found.', 'evnt') ?><br>
                            <?php esc_attr_e('Hit the ', 'evnt'); ?><a href="<?php esc_js('javascript:history.go(-1)'); ?>"><i class="fa fa-arrow-left"></i> <?php esc_attr_e('back button', 'evnt'); ?></a> <?php esc_attr_e('or go to', 'evnt'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_attr_e('home page', 'evnt'); ?></a>.</p>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
