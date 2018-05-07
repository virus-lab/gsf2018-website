<?php

/* sitemap
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('sitemap')) {

    function sitemap($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
            "m_links" => "",
                        ), $atts));

        $m_links = vc_param_group_parse_atts($m_links);



        $output = '<div class="sitemap">
                        <h5>' . $title . '</h5>
                        <ul>
                                ';
        if (!empty($m_links)) {
            foreach ($m_links as $link) {
                if (!empty($link)) {
                    $link = ( $link['link'] == '||' ) ? '' : $link['link'];
                    $link = vc_build_link($link);
                    $use_link = false;
                    if (strlen($link['url']) > 0) {
                        $use_link = true;
                        $a_href = $link['url'];
                        $a_title = $link['title'];
                        $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';
                    }

                    $output .= '<li><a href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '</a></li>';
                }
            }
        }
        $output .= '</ul></div>';

        return $output;
    }

}

add_shortcode('sitemap', 'sitemap');



