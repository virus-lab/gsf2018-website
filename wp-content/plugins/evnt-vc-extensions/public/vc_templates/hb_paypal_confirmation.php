<?php

//hb_booking_form

if (!function_exists('traveller_hb_paypal_confirmation')) {

    function traveller_hb_paypal_confirmation($atts, $content = null) {
        extract(shortcode_atts(array(
            'content_text' => ' ',
                        ), $atts));


        return do_shortcode("[hb_paypal_confirmation] " . $content_text . " [/hb_paypal_confirmation]");
    }

}
add_shortcode('traveller_hb_paypal_confirmation', 'traveller_hb_paypal_confirmation');
