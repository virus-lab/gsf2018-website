<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
    <?php
    $speaker_parent = get_post_meta(get_the_ID(), 'evnt_speaker_parent', true);
    $speaker_parent_multi = get_post_meta(get_the_ID(), 'evnt_speaker_parent_multiple', true);
    $speaker_title = get_the_title($speaker_parent);
    $speaker_content = evnt_related_post_get_the_excerpt($speaker_parent);
    $evnt_speaker_short_description = get_post_meta($speaker_parent, 'evnt_speaker_short_description', true);
    $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
    $speaker_facebook = get_post_meta($speaker_parent, 'evnt_speaker_facebook', true);
    $speaker_linkedin = get_post_meta($speaker_parent, 'evnt_speaker_linkedin', true);
    $speaker_twitter = get_post_meta($speaker_parent, 'evnt_speaker_twitter', true);
    $img = get_post_meta(get_the_ID(), '_wcs_image', true);
    $locations = get_the_terms($post->ID, 'wcs-room', 'string');
    ?>

    <section id="single-class">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="headings">
                        <?php
                        the_title('<h1 class="post-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h1>');
                        ?>
                        <div class="meta">
                            <div class="time-meta">
                                <?php
                                the_time('M d, Y');
                                ?>
                            </div>
                            <?php if ($locations) { ?>
                                <div class="locations-meta">
                                    <?php
                                    foreach ($locations as $location) {
                                        echo "&nbsp;&nbsp;" . $location->name;
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    if (is_category() || is_archive() || is_search()) {
                        the_excerpt();
                    } else {
                        the_content('');
                    }
                    ?>	
                </div>
            </div>

            <?php if (!empty($speaker_parent)) {
                ?>
                <hr>
                <div class="author">
                    <div class="row">
                        <?php if (!empty($speaker_parent_multi)) { ?>
                            <h3><?php echo esc_html_e("Speaker team leader", 'evnt') ?></h3>
                        <?php } ?>
                        <div class="col-sm-2">
                            <?php echo get_the_post_thumbnail($speaker_parent, 'thumbnail', array('class' => "img-responsive  img-circle")); ?>
                        </div>
                        <div class="col-sm-10">
                            <h4 class="name"><?php echo esc_attr($speaker_title); ?></h4>
                            <h6 class="work-title"><?php echo esc_attr($speaker_work_title); ?></h6>
                            <p><?php echo esc_attr($evnt_speaker_short_description); ?></p>
                            <p><a href="<?php echo esc_url(get_permalink($speaker_parent)); ?>" class="btn btn-primary"><?php esc_attr_e('View profile', 'evnt'); ?></a></p>
                        </div>
                    </div>
                </div>
                <hr>
            <?php
            }
            if (!empty($speaker_parent_multi)) {
                ?>
                <hr>
                <h3><?php echo esc_html_e("The rest of the team", 'evnt') ?></h3>
                <?php
                foreach ($speaker_parent_multi as $multiplespeaker) {
                    ?>

                    <div class="author">
                        <div class="row">
                            <div class="col-sm-2">
        <?php echo get_the_post_thumbnail($multiplespeaker, 'thumbnail', array('class' => "img-responsive  img-circle")); ?>
                            </div>
                            <div class="col-sm-10">
                                <h4 class="name"><?php echo get_the_title($multiplespeaker); ?></h4>
                                <h6 class="work-title"><?php echo get_post_meta($multiplespeaker, 'evnt_speaker_title', true); ?></h6>
                                <p><?php echo esc_attr(get_post_meta($multiplespeaker, 'evnt_speaker_short_description', true)); ?></p>
                                <p><a href="<?php echo esc_url(get_permalink($multiplespeaker)); ?>" class="btn btn-primary"><?php esc_attr_e('View profile', 'evnt'); ?></a></p>
                            </div>
                        </div>
                    </div>



                    <?php
                }
            }
            ?>
            <hr>
        </div>
    </section>
    <div class="relatedposts">
        <?php
        global $post;
        $terms = get_the_terms($post->ID, 'wcs-type', 'string');

        $do_not_duplicate[] = $post->ID;

        if (!empty($terms)) {
            foreach ($terms as $term) {


                $args = array(
                    'post_type' => 'class',
                    'posts_per_page' => 3,
                    'ignore_sticky_posts' => 1,
                    'orderby' => 'rand',
                    'post__not_in' => $do_not_duplicate,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'wcs-type',
                            'field' => 'slug',
                            'terms' => $term,
                        )
                    )
                );
                $my_query = new wp_query($args);
                if ($my_query->have_posts()) {
                    while ($my_query->have_posts()) : $my_query->the_post();
                        $do_not_duplicate[] = $post->ID;
                        ?>
                        <div class="single_related">
                            <div class="col-sm-4">
                                <?php
                                get_template_part('content', 'related');
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                }
            }
        }
        ?>
    </div>


</article>







