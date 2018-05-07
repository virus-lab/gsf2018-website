<?php

/* sponsor Item
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('sponsor_grid_item')) {

    function sponsor_grid_item($atts, $content = null) {

        extract(shortcode_atts(array(
            'sponsor' => '',
            'sponsor_url' => '',
                        ), $atts));

        if (!empty($sponsor_url)) {

            $sponsor_url = ( $sponsor_url == '||' ) ? '' : $sponsor_url;
            $sponsor_url = vc_build_link($sponsor_url);
            if (strlen($sponsor_url['url']) > 0) {
                $use_link = true;
                $a_href = $sponsor_url['url'];
                $a_title = $sponsor_url['title'];
                $a_target = strlen($sponsor_url['target']) > 0 ? $sponsor_url['target'] : '_self';
            }


            $link_open = '<a href="' . $a_href . '" title="' . $a_title . '" target="' . $a_target . '">';
            $link_close = '</a>';
        } else {
            $a_title = '';
            $link_open = $link_close = '';
        }

        $output = '<div>';

        if (!empty($sponsor)) {
            $photo = wp_get_attachment_image_src($sponsor, 'full');
            $output .= '<li>' . $link_open . '<img src="' . $photo[0] . '" class="img-responsive" alt="' . $a_title . '">' . $link_close . '</li>';
        }

        $output .= '</div>';

        return $output;
    }

}

add_shortcode('sponsor_grid_item', 'sponsor_grid_item');
