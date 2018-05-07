<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
    <?php
    $speaker_parent = get_post_meta(get_the_ID(), 'speaker_parent', true);
    $speaker_title = get_the_title($speaker_parent);
    $speaker_content = evnt_related_post_get_the_excerpt($speaker_parent);
    $evnt_speaker_short_description = get_post_meta($speaker_parent, 'evnt_speaker_short_description', true);
    $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
    $speaker_facebook = get_post_meta($speaker_parent, 'evnt_speaker_facebook', true);
    $speaker_linkedin = get_post_meta($speaker_parent, 'evnt_speaker_linkedin', true);
    $speaker_twitter = get_post_meta($speaker_parent, 'evnt_speaker_twitter', true);
    ?>

    <section id="single-post">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="headings">
                        <?php
                        the_title('<h1 class="post-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h1>');
                        ?> 
                        <div class="meta">

                            <?php the_time('M d, Y'); ?> by <?php the_author(); ?> in <?php
                            $categorys = get_the_category(get_the_ID());
                            foreach ($categorys as $category) {
                                echo "&nbsp;" . $category->name;
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    get_template_part('inc/thumbnail');
                    if (is_category() || is_archive() || is_search()) {
                        the_excerpt();
                    } else {

                        the_content('');
                    }
                    ?>	
                </div>
            </div>
            <?php if (!empty($speaker_parent)) { ?>
                <div class="author">
                    <div class="row">
                        <div class="col-sm-2">
                            <?php echo get_the_post_thumbnail($speaker_parent, 'thumbnail', array('class' => "img-responsive  img-circle")); ?>
                        </div>
                        <div class="col-sm-10">
                            <h4><?php echo esc_attr($speaker_title); ?></h4>
                            <h6><?php echo esc_attr($speaker_work_title); ?></h6>
                            <p><?php echo esc_attr($evnt_speaker_short_description); ?></p>
                            <p><a href="<?php echo esc_url(get_permalink($speaker_parent)); ?>" class="btn btn-primary"><?php echo esc_html_e('View profile', 'evnt'); ?></a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php
    $orig_post = $post;
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
        $category_ids = array();
        foreach ($categories as $individual_category){
            $category_ids[] = $individual_category->term_id;
        }
        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3, // Number of related posts that will be displayed.
            'ignore_sticky_posts' => 1,
            'orderby' => 'rand' // Randomize the posts
        );
        $my_query = new wp_query($args);
        if ($my_query->have_posts()) {
            echo '<div class="post_related_by-category" class="clear">';
            ?>


            <?php
            while ($my_query->have_posts()) {
                $my_query->the_post();
                ?>
                <div class="col-sm-4">
                    <?php
                    get_template_part('content', 'page');
                    ?>
                </div>

                <?php
            }
            echo '</div>';
            $post = $orig_post;
            wp_reset_postdata();
        }
    }
    ?>
</article>







