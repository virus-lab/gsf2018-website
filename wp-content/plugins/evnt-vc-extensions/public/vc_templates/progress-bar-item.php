<?php

/* progress_bar Item
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('progress_bar_item')) {

    function progress_bar_item($atts, $content = null) {

        extract(shortcode_atts(array(
            'percent' => '',
            'text' => '',
                        ), $atts));

        if (!empty($percent)) {

            $output = '<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="' . $percent . '"  aria-valuemin="0" aria-valuemax="100">' . $text . '</div>
            </div>';
            return $output;
        };

        
    }

}

add_shortcode('progress_bar_item', 'progress_bar_item');
