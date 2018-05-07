<?php

//[hb_availability]
//hb_booking_form

if (!function_exists('traveller_hb_availability')) {

    function traveller_hb_availability($atts, $content = null) {
        extract(shortcode_atts(array(
            'calendar_sizes' => '',
            'accom_id' => '',
                        ), $atts));


        $attributes = '';
//  paypal_return_url='" . $paypal_return_url . "'
        if (!empty($calendar_sizes)) {
            $attributes .= 'calendar_sizes=' . $calendar_sizes . ' ';
        }
        if (!empty($accom_id)) {
            if ($accom_id === 'self') {
                $attributes .= 'accom_id=' . get_the_ID() . ' ';
            } else {
                $attributes .= 'accom_id=' . $accom_id . ' ';
            }
        }

        return do_shortcode("[hb_availability " . $attributes . "]");
    }

}
add_shortcode('traveller_hb_availability', 'traveller_hb_availability');
