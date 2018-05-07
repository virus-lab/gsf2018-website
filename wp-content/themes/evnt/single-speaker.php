<?php get_header(); ?>

<section id="content speaker">
    <div class="container content-speaker">

        <?php
        get_template_part('inc/page-title');
        $speaker_work_title = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_title', true);

        $evnt_speaker_short_description = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_short_description', true);
        ?>
        <div class="row">
            <div class="col-sm-12">
                <?php if (have_posts()) : ?>

                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <div class="section-title headings text-center">


                            <h1> <?php
                                echo get_the_title();
                                ?>
                            </h1>


                            <h6>
                                <?php echo $speaker_work_title ?>
                            </h6>
                        </div>


                        <!--<div class="col-sm-7 post-thumb large-thumbnail">-->
                        <?php
                        the_post_thumbnail('evnt_speaker-full', array('class' => "speaker-photo"));
                        ?>

                        <!--</div>-->

                        <div class="entry-content profile dd">
                            <div class="">
                                <p class="summary">
                                    <?php
                                    echo $evnt_speaker_short_description;
                                    ?>
                                </p>
                                <?php
                                the_content();
                                ?>


                            </div>
        <?php
        $social_profiles = array();

        $facebook_url = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_facebook', true);
        $twitter_url = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_twitter', true);
        $linkedin_url = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_linkedin', true);
        $instagram_url = get_post_meta(evnt_get_the_post_id(), 'evnt_speaker_instagram', true);

        if (!empty($facebook_url) || !empty($twitter_url) || !empty($linkedin_url) || !empty($instagram_url)) {
            ?>
                                <div class="speaker-credits ">
                                    <div class="col-sm-12 text-center">
                                        <ul>
            <?php if (!empty($facebook_url)) { ?>
                                                <li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-lg fa-facebook"></i></a></li><?php
            }
            if (!empty($twitter_url)) {
                ?>
                                                <li><a href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-lg fa-twitter"></i></a></li><?php
                                            }
                                            if (!empty($instagram_url)) {
                                                ?>
                                                <li><a href="<?php echo esc_url($instagram_url); ?>"><i class="fa fa-lg fa-instagram"></i></a></li><?php
                                            }
                                            if (!empty($linkedin_url)) {
                                                ?>
                                                <li><a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-lg fa-linkedin"></i></a></li><?php } ?>
                                        </ul>
                                    </div>
                                </div>
        <?php }
        ?>

                        </div>

    <?php endwhile; ?>

                    <?php // evnt_paging_nav();        ?>

                <?php else : ?>

                    <?php //get_template_part( 'content', 'none' );        ?>

                <?php endif; ?>

            </div>

            <div class="col-sm-12 relatedposts">
                <hr>
<?php
global $post;

$args = array(
    'post_type' => 'class',
    'posts_per_page' => -1,
    'ignore_sticky_posts' => 1,
    'orderby' => 'rand',
);
$my_query = new wp_query($args);
if ($my_query->have_posts()) {
    while ($my_query->have_posts()) : $my_query->the_post();
        $do_not_duplicate[] = $post->ID;

        $speaker_parent = get_post_meta($post->ID, 'evnt_speaker_parent', true);
        if ($speaker_parent == evnt_get_the_post_id()) {
            ?>
                            <div class="single_related">
                                <div class="col-sm-4">
                            <?php
                            get_template_part('content', 'speaker');
                            ?>
                                </div>
                            </div>
                                    <?php
                                }
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
            </div>
        </div>

    </div>



</section>
<?php get_footer(); ?>
