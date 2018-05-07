<?php
get_header();
?>
<div class="blog-page">
    <?php
    get_template_part('inc/blog-title');
    ?>
    <section id="content">
        <div class="container">
            <div class="row">
                <?php
                if (have_posts()) :
                    ?>
                    <div class="col-sm-12">             
                        <?php
                        $do_not_duplicate = array();
                        $my_query = new WP_Query('posts_per_page=2');
                        while ($my_query->have_posts()) : $my_query->the_post();
                            $do_not_duplicate[] = $post->ID;
                            if (!is_single() && (get_post_type() != 'post')) {
                                if (is_sticky()) {
                                    ?>
                                    <div class="col-sm-6 stickywhile">
                                        <?php
                                        get_template_part('content', 'page');
                                        ?>
                                    </div>
                                    <?php
                                }
                            }

                        endwhile;
                        ?>
                    </div>
                    <div class="col-sm-12">             
                        <?php
                        while (have_posts()) : the_post();

                            if (is_single() && (get_post_type() == 'post')) {
                                get_template_part('content-single', get_post_format());
                            } else {
                                if (!is_sticky()) {
                                    ?>
                                    <div class="col-sm-4 nonstickywhile">
                                        <?php
                                        get_template_part('content', 'page');
                                        ?>
                                    </div>
                                    <?php
                                }
                            }

                        endwhile;
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                                <ul class="pager">
                                    <li><?php previous_posts_link('<i class="fa fa-angle-left"></i> Prev '); ?></i></li>
                                    <li><?php next_posts_link('Next <i class="fa fa-angle-right"></i>'); ?></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <?php
                else :

                    get_template_part('content', 'none');

                endif;
                ?>

            </div>

        </div>
    </section>
</div>
<?php get_footer(); ?>