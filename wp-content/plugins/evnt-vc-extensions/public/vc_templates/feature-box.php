<?php

/* feature_box
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('feature_box')) {

    function feature_box($atts, $content = null) {

        extract(shortcode_atts(array(
            "service_icons" => "",
            "service_title" => "",
            "service_description" => ""
                        ), $atts));


        if (!empty($service_icons)) {
            $output = '<div class="feature-box">
                            <i class="fa ' . $service_icons . ' fa-2x"></i>
                            <h5>' . $service_title . '</h5>
                            <p>' . $service_description . '</p>
                    </div>';

            return $output;
        }
    }

}

add_shortcode('feature_box', 'feature_box');
