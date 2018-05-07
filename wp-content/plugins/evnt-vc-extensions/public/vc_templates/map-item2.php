<?php

/* map_item Item
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('map_item2')) {

    function map_item2($atts, $content = null) {

        extract(shortcode_atts(array(
            'percent' => '',
            'text' => '',
                        ), $atts));

        if (!empty($percent)) {

            $output = '<div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="' . $percent . '"  aria-valuemin="0" aria-valuemax="100">' . $text . '</div>
            </div>';
        };

        return array ("size" => "XL", "color" => "gold");
    }

}

add_shortcode('map_item2', 'map_item2');
