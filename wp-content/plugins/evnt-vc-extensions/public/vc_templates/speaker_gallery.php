<?php

// speakers Gallery

if (!function_exists('speakers_gallery')) {

    function speakers_gallery($atts, $content = null) {

        // Change slugs here for speakers:
        $post_type = 'speaker';
        $post_category = 'speaker_category';
        $post_tag = 'speaker_tag';

        $output = $el_class = '';

        extract(shortcode_atts(array(
            'layout' => 'speakers1',
            'per_page' => -1,
            'pagination' => 0,
            'columns' => "4",
            'include_categories' => '',
            'include_tags' => '',
            'selected_posts' => '',
            'sort_order' => 'ASC',
            'order' => 'title',
            'post__in' => '',
            'el_class' => '',
                        ), $atts));

        // Query speakers posts
        global $wp_query;
        $paged = get_query_var("paged") ? get_query_var("paged") : 1;
        $args = array(
            "post_type" => $post_type,
            "posts_per_page" => $per_page,
            "post_status" => "publish",
            "orderby" => $order,
            "order" => $sort_order,
            "paged" => $paged,
        );

        if ($order == "post__in") {
            $post__in = explode(",", $post__in);
            $args['post__in'] = $post__in;
        }


        if (!empty($include_categories)) {

            $include_categories = explode(",", $include_categories);

            if (!$pagination) {
                $field = 'name';
            } else {
                $field = 'id';
            }

            $args['tax_query'] = array(
                array(
                    'taxonomy' => $post_category,
                    'field' => $field,
                    'terms' => $include_categories,
                ),
            );
        }

        if (!empty($include_tags)) {

            $included_tags = explode(",", $include_tags);

            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'speaker_tag',
                    'field' => 'slug',
                    'terms' => $included_tags,
                ),
            );
        }
        if (!empty($selected_posts)) {
            $selected_posts = explode(",", $selected_posts);
            $args['post__in'] = $selected_posts;
        }

        // Run query
        $speakers_query = new WP_Query($args);

        // Start loop
        if ($speakers_query->have_posts()) :
            if (!$layout || $layout == 'speakers1') {
                $output .= '<div class="speakers1">';
            }
            if ($layout == 'speakers2') {
                $output .= '<div class="speakers2">';
            }
            if ($layout == 'speakers3') {
                $output .= '<div class="speakers3">';
            }
            if ($layout == 'speakers4') {
                $output .= '<div class="row speakers4">';
            }
            $speakers2_count = 0;
            while ($speakers_query->have_posts()) : $speakers_query->the_post();
                $speakers2_count++;
                $thumb = get_the_post_thumbnail(get_the_ID(), 'gallery-' . $columns, array('class' => "img-responsive"));

                $title = get_the_title(get_the_ID());
                $content = apply_filters('the_excerpt', get_post_field('post_excerpt', get_the_ID()));

                $speaker_title = get_post_meta(get_the_ID(), 'evnt_speaker_title', true);
                $speaker_facebook = get_post_meta(get_the_ID(), 'evnt_speaker_facebook', true);
                $speaker_linkedin = get_post_meta(get_the_ID(), 'evnt_speaker_linkedin', true);
                $speaker_twitter = get_post_meta(get_the_ID(), 'evnt_speaker_twitter', true);
                // Get item tags
                $terms = get_the_terms(get_the_ID(), $post_tag);

                if (has_post_thumbnail()) {

                    if (!$layout || $layout == 'speakers1') {

                        switch ($columns) {
                            case 2:
                                $column_class = '6';
                                break;

                            case 3:
                                $column_class = '4';
                                break;

                            default:
                                $column_class = '3';
                                break;
                        }
                        $output .= '<div class="col-sm-' . $column_class . '">';


                        $output .= '<div class="speaker">
                                            <div class="flipper">
                                                    <div class="front">
                                                    ' . $thumb . '
                                                            <h5>' . $title . '</h5>
                                                            <h6>' . $speaker_title . '</h6>
                                                    </div>
                                                    <div class="back">
                                                            <div class="content">
                                                                    <p>';
                        if ($speaker_twitter) {
                            $output .= '<a href="' . $speaker_twitter . '"  target="_blank"><i class="fa fa-twitter"></i></a>';
                        }
                        if ($speaker_facebook) {
                            $output .= '<a href="' . $speaker_facebook . '" target="_blank"><i class="fa fa-facebook"></i></a>';
                        }
                        if ($speaker_linkedin) {
                            $output .= '<a href="' . $speaker_linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
                        }
                        $output .= '</p><p><a href="' . get_permalink() . '" class="btn btn-secondary">' . __("View profile", "evnt-vc-extensions") . '</a></p>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>';
                    }

                    if (!$layout || $layout == 'speakers2') {
                        $output .= '<!-- Speaker 1 Start -->
                                        <a href="' . get_permalink() . '" class="speaker ';
                        if (($speakers2_count % 7) == 1) {
                            $output .= 'large';
                        };

                        $output .= '">
                            ' . $thumb . '
                                    <span class="back">
                                            <span class="content">
                                                    <span class="name">' . $title . '</span>
                                                    <span class="title">' . $speaker_title . '</span>
                                            </span>
                                    </span>
                            </a>
                            <!-- Speaker 1 End -->';
//                        }
                    }

                    if ($layout == 'speakers3') {
                        $thumb_circle = get_the_post_thumbnail(get_the_ID(), 'gallery-' . $columns, array('class' => "img-responsive img-circle"));
                        $output .= '<div class="row">';
                        $output .= '<div class="col-sm-2">
                                                <a href="' . get_permalink() . '">' . $thumb_circle . '</a>
                                        </div>
                                        <div class="col-sm-10">
                                                <div class="info-box">
                                                        <div class="content">
                                                                <h4><a href="' . get_permalink() . '">' . $title . '</a></h4>
                                                                <h6>' . $speaker_title . '</h6>
                                                                <p>' . $content . '</p>
                                                        </div>
                                                        <footer>
                                                            <ul>';
                        if ($speaker_facebook) {
                            $output .= '<li><a href="' . $speaker_facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                        }
                        if ($speaker_twitter) {
                            $output .= '<li><a href="' . $speaker_twitter . '"  target="_blank"><i class="fa fa-twitter"></i></a></li>';
                        }
                        if ($speaker_linkedin) {
                            $output .= '<li><a href="' . $speaker_linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                        }
                        $output .= '
                                                            </ul>
                                                        </footer>
                                                </div>
                                        </div>
                                </div>';
                    }
                    if ($layout == 'speakers4') {
                        $output .= '<!-- Speaker 1 Start -->
                                            <div class="speaker col-sm-6 col-lg-4">
                                                    <a href="' . get_permalink() . '" class="hover">' . $thumb . '</a>
                                                    <div class="content">
                                                            <h4><a href="' . get_permalink() . '">' . $title . '</a></h4>
                                                            <h6>' . $speaker_title . '</h6>
                                                            <p>' . $content . '</p>
                                                    </div>
                                                    <footer>
                                                        <ul>';
                        if ($speaker_facebook) {
                            $output .= '<li><a href="' . $speaker_facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                        }
                        if ($speaker_twitter) {
                            $output .= '<li><a href="' . $speaker_twitter . '"  target="_blank"><i class="fa fa-twitter"></i></a></li>';
                        }
                        if ($speaker_linkedin) {
                            $output .= '<li><a href="' . $speaker_linkedin . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                        }
                        $output .= '</ul>
                                                </footer>
                                        </div>
                                        <!-- Speaker 1 End -->';
                    }
                }

            endwhile;
            $output .= '</div>';
        endif;


        return $output;
    }

}

add_shortcode('speakers_gallery', 'speakers_gallery');
