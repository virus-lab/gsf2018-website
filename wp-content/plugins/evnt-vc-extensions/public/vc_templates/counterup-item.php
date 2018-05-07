<?php

/* Counter Up
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('counterup_item')) {

    function counterup_item($atts, $content = null) {

        extract(shortcode_atts(array(
            "number" => "",
            "title" => "",
            "el_class" => ""
                        ), $atts));

        if (!empty($el_class)) {
            $output = '<div class="counter ' . $el_class . '">';
        } else {
            $output = '<div class="counter">';
        }

        if (!empty($number)) {
            $output .= '<div class="number">' . $number . '</div>';
        }

        if (!empty($title)) {
            $output .= '<div class="description">' . $title . '</div>';
        }

        $output .= '</div>';

        return $output;
    }

}

add_shortcode('counterup_item', 'counterup_item');
