<?php

/* HGroup
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('hgroup')) {

    function hgroup($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
            "subtitle" => "",
            "el_class" => "",
            "center_text" => ""
                        ), $atts));

        if (!empty($center_text) and $center_text === "yes") {
            $center_class = " text-center";
        } else {
            $center_class = " ";
        }

        if (!empty($el_class)) {
            $output = '<div class="section-title headings ' . $el_class . ' ' . $center_class . '">';
        } else {
            $output = '<div class="section-title headings ' . $center_class . '">';
        }

        if (!empty($title)) {
            $output .= '<h1>' . $title . '</h1>';
        }

        if (!empty($subtitle)) {
            $output .= '<h6>' . $subtitle . '</h6>';
        }

        $output .= '</div>';

        return $output;
    }

}

add_shortcode('hgroup', 'hgroup');
