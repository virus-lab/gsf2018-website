<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
    <?php
    $speaker_parent = get_post_meta(get_the_ID(), 'speaker_parent', true);
    $speaker_title = get_the_title($speaker_parent);
    $speaker_content = get_post_field('post_content', $speaker_parent);
    $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
    ?>

    <section>

        <?php
        if (is_sticky()) {
            $featured_class = "featured";
        } else {
            $featured_class = "";
        }
        ?>
        <div class="post <?php echo esc_attr($featured_class); ?>">
            <?php
            $img = get_post_meta(get_the_ID(), '_wcs_image', true);
            if (!empty($img)) {
                ?>
                <div class="image-box">
                    <img src="<?php echo esc_url($img); ?>" class="img-responsive image image-hover">
                </div>

                <?php
            }
            ?>
            <?php
            the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
            get_template_part('inc/post-meta');
            ?>
            <div class="summary"><?php
                if (is_category() || is_archive() || is_search()) {
                    the_excerpt();
                } else {
                    the_content('');
                }
                ?></div>

        </div>
    </section>
</article>
