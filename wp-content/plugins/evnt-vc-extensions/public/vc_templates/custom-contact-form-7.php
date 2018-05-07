<?php

// speakers Gallery

if (!function_exists('evnt_contact_form')) {

    function evnt_contact_form($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' => '',
            'id' => '',
            'skin' => 'standard'
                        ), $atts));
        if ($skin and $skin == "standard") {
            return do_shortcode("[contact-form-7 id='" . $id . "']");
        } else {
            $output = '<div id="slider-content">
					<div class="container">';
            if ($title) {
                $output .= '<h2>' . $title . '</h2>';
            }
            $output .= do_shortcode("[contact-form-7 id='" . $id . "']");
            $output .= '</div>
				</div>';
            return $output;
        }
    }

}
add_shortcode('evnt_contact_form', 'evnt_contact_form');
