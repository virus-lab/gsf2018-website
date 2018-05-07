<?php

/* Recent Blog Posts
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('recent_blog_posts')) {

    function recent_blog_posts($atts, $content = null) {

        extract(shortcode_atts(array(
            "layout" => "carousel",
            "autoplay" => "",
            "posts" => 2,
            "columns" => 2,
            "categories" => "",
            "el_class" => ""
                        ), $atts));

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts,
            'cat' => $categories
        );

        $output = '';

        $blog_query = new WP_Query($args);

        if ($blog_query->have_posts()) {

            if (!empty($el_class))
                $el_class = ' ' . $el_class;

            if ($layout == 'carousel') {

                wp_enqueue_script('owl-carousel');

                if (!empty($autoplay)) {
                    $autoplay = ' data-autoplay="' . $autoplay . '"';
                }

                $output .= '<div class="recent-blog-posts owl-carousel' . $el_class . '" data-columns="' . $columns . '"' . $autoplay . '>';
            } else {

                $output .= '<div class="recent-blog-posts row columns-' . $columns . $el_class . '">';

                switch ($columns) {
                    case 2:
                        $column_class = 'col-sm-6';
                        break;

                    case 3:
                        $column_class = 'col-sm-4';
                        break;

                    default:
                        $column_class = 'col-sm-3';
                        break;
                }
            }

            while ($blog_query->have_posts()) {

                $blog_query->the_post();

                if ($layout == 'carousel') {
                    $output .= '<div class="blog-item">';
                } else {
                    $output .= '<div class="' . $column_class . '">';
                }

                if (has_post_thumbnail()) {
                    $output .= '<a href="' . esc_url(get_permalink()) . '">' . get_the_post_thumbnail(get_the_ID(), 'blog', array('class' => 'img-responsive')) . '</a>';
                }

                $output .= '<h4><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title(get_the_ID()) . '</a></h4>';

                // Replicate comments_nubmer()
                $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

                if (comments_open()) {
                    if ($num_comments == 0) {
                        $comments = __('No Comments', 'evnt-vc-extensions');
                    } elseif ($num_comments > 1) {
                        $comments = $num_comments . __(' Comments', 'evnt');
                    } else {
                        $comments = __('1 Comment', 'evnt-vc-extensions');
                    }
                    $write_comments = '<span><i class="fa fa-comment"></i><a href="' . esc_url(get_permalink()) . '#comments">' . $comments . '</a></span>';
                } else {
                    $write_comments = '';
                }

                $output .= '<h5><span><i class="fa fa-calendar"></i>' . get_the_time('d/m/Y') . '</span>' . $write_comments . '</h5>';

                $output .= '<p>' . get_the_excerpt() . '</p>';

                $output .= '<p><a href="' . esc_url(get_permalink()) . '" class="btn btn-primary">' . __("Read more", "evnt-vc-extensions") . '</a></p>';

                $output .= '</div>';
            }

            $output .= '</div>';
        }

        wp_reset_postdata();

        return $output;
    }

}

add_shortcode('recent-blog-posts', 'recent_blog_posts');
