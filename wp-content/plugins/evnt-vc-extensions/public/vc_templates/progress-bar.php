<?php

/* progress_bar 
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('progress_bar')) {

    function progress_bar($atts, $content = null) {

        extract(shortcode_atts(array(
            'el_class' => '',
                        ), $atts));

        if (!empty($el_class))
            $el_class = ' ' . $el_class;

        $output = '<div id="progress" class="' . $el_class . '">
                        ' . wpb_js_remove_wpautop($content) . '
					</div>';
        return $output;
    }

}

add_shortcode('progress_bar', 'progress_bar');
