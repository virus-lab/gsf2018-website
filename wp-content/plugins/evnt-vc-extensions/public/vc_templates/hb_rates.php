<?php

//[hb_availability]
//hb_booking_form

if (!function_exists('traveller_hb_rates')) {

    function traveller_hb_rates($atts, $content = null) {
        extract(shortcode_atts(array(
            'accom_id' => '',
            'type' => '',
            'season' => '',
            'rule' => '',
            'days' => '',
            'show_global_price' => '',
            'custom_text_after_amount' => ''
                        ), $atts));


        $attributes = '';

        if (!empty($accom_id)) {
            if ($accom_id === 'self') {
                $attributes .= 'accom_id=' . get_the_ID() . ' ';
            } else {
                $attributes .= 'accom_id=' . $accom_id . ' ';
            }
        }
        if (!empty($type)) {
            $attributes .= 'type=' . $type . ' ';
        }
        if (!empty($season)) {
            $attributes .= 'season=' . $season . ' ';
        }
        if (!empty($rule)) {
            $attributes .= 'rule=' . $rule . ' ';
        }
        if (!empty($days)) {
            $attributes .= 'days=' . $days . ' ';
        }
        if (!empty($show_global_price)) {
            $attributes .= 'show_global_price=' . $show_global_price . ' ';
        }
        if (!empty($custom_text_after_amount)) {
            $attributes .= 'custom_text_after_amount=' . $custom_text_after_amount . ' ';
        }
        return do_shortcode("[hb_rates " . $attributes . "]");
    }

}
add_shortcode('traveller_hb_rates', 'traveller_hb_rates');
