<?php

/* service_square
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('service_square')) {

    function service_square($atts, $content = null) {

        extract(shortcode_atts(array(
            "service_icons" => "",
            "service_title" => "",
            "service_description" => "",
            "service_url" => "",
            "color" => ""
                        ), $atts));


        if (!empty($service_icons)) {
            
            $service_icons = str_replace("fa fa-","",$service_icons);
            
            $output = '<div class="service text-center"><p><i class="fa fa-' . $service_icons . ' square ' . $color . ' "></i></p>';
            if (!empty($service_url)) {
                $output .= '<a href="' . $service_url . '"><h6>' . $service_title . '</h6></a>';
            } else {
                $output .= '<h6>' . $service_title . '</h6>';
            }
            $output .= '<p>' . $service_description . '</p></div>';

            return $output;
        }
    }

}

add_shortcode('service_square', 'service_square');
