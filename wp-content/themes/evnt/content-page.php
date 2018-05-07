<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?> >
    <?php
    $speaker_parent = get_post_meta(get_the_ID(), 'evnt_speaker_parent', true);
    $speaker_title = get_the_title($speaker_parent);
    $speaker_content = evnt_related_post_get_the_excerpt($speaker_parent);
    $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
    ?>

    <div class="section">

        <?php
        if (is_sticky()) {
            $featured_class = "featured";
        } else {
            $featured_class = "";
        }
        ?>
        <div class="post <?php echo esc_attr($featured_class); ?>">
            <?php
            get_template_part('inc/thumbnail');
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
                    if (!is_home()) {
                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'evnt') . '</span>',
                            'after' => '</div>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'evnt') . ' </span>%',
                            'separator' => '<span class="screen-reader-text">, </span>',
                        ));
                    }
                }
                ?></div>

            <?php
            if ($speaker_parent) {
                ?>
                <div class="author">
                    <a href="<?php echo esc_url(get_permalink($speaker_parent)); ?>">
                        <?php echo get_the_post_thumbnail($speaker_parent, 'thumbnail', array('class' => "")); ?>

                        <div class="name"><?php echo esc_attr($speaker_title); ?></div>
                    </a>
                    <div class="title work-title"><?php echo esc_attr($speaker_work_title); ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

