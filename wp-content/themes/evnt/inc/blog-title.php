<?php
if (is_home() and ! is_front_page()) {

    $blog_page_id = get_option('page_for_posts', true);

    $blog_page_title = get_post_meta($blog_page_id, '_evnt_page_title_show', true);

    if ($blog_page_title != 'hide') {

        $blog_title_text = get_the_title(get_option('page_for_posts', true));

        $blog_subtitle_text = get_post_meta($blog_page_id, '_evnt_page_title_subtitle', true);

        if (empty($blog_title_text))
            $blog_title = esc_html__('Blog', 'evnt');
        ?>

        <section id="title">
            <div class="text-center">
                <h1><?php echo esc_html($blog_title_text); ?></h1>
                <?php if (!empty($blog_subtitle_text)) { ?><h4><?php echo esc_html($blog_subtitle_text); ?></h4><?php } ?>
            </div>
        </section><?php
    }
} else if (is_search()) {
    ?>

    <section id="title">
        <div class="text-center">
            <h1><?php esc_html_e('Search Results', 'evnt'); ?></h1>
            <h4><?php printf(esc_html__('for: "%s"', 'evnt'), get_search_query()); ?></h4>
        </div>
    </section><?php } else if (is_single()) {
    ?>

    <section id="title">
        <div class="container">
            <div class="row">
                <div class="col-sm-2"><?php echo get_avatar($post->post_author, 140); ?></div>
                <div class="col-sm-10"><?php
                    the_title('<h1>', '</h1>');
                    get_template_part('inc/post-meta');
                    ?></div>
            </div>
        </div>
    </section>
    <?php
} else if (is_home() and is_front_page()) {
    $blog_title = esc_html__('Blog posts', 'evnt');
    ?>

    <section id="title">
        <div class="text-center">
            <h1><?php echo esc_html($blog_title); ?></h1>
        </div>
    </section><?php
}

?>
