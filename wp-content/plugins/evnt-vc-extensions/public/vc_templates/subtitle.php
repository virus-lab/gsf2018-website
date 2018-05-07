<?php

/* Subtitle
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('subtitle')) {

    function subtitle($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
            "el_class" => ""
                        ), $atts));

        if (!empty($el_class)) {
            $output = '<h2 class="subtitle ' . $el_class . '">' . $title . '</h2>';
        } else {
            $output = '<h2 class="subtitle">' . $title . '</h2>';
        }

        return $output;
    }

}

add_shortcode('subtitle', 'subtitle');
