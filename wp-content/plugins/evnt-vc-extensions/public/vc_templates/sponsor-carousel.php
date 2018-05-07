<?php

/* Logo Carousel 
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('sponsor_carousel')) {

    function sponsor_carousel($atts, $content = null) {

        extract(shortcode_atts(array(
            'columns' => '',
            'autoplay' => '',
            'navs' => '',
            'el_class' => '',
                        ), $atts));
        wp_enqueue_script('owl-carousel');

        if (!empty($el_class))
            $el_class = ' ' . $el_class;

        if (!empty($autoplay))
            $autoplay = ' data-autoplay="' . $autoplay . '"';

        $output = '<div class="sponsor-carousel owl-carousel' . $el_class . '" data-columns="' . $columns . '" data-navs="' . $navs . '" ' . $autoplay . '>' . wpb_js_remove_wpautop($content) . '</div>';

        return $output;
    }

}

add_shortcode('sponsor_carousel', 'sponsor_carousel');
