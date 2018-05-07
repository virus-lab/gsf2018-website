<?php

//hb_booking_form

if (!function_exists('traveller_hb_accommodation_list')) {

    function traveller_hb_accommodation_list($atts, $content = null) {
        extract(shortcode_atts(array(
            'thumbnail_link' => '',
            'title_tag' => '',
            'thumb_width' => '',
            'thumb_height' => '',
                        ), $atts));


        $attributes = '';
//  paypal_return_url='" . $paypal_return_url . "'
        if (!empty($thumbnail_link)) {
            $attributes .= 'thumbnail_link=' . $thumbnail_link . ' ';
        }

        if (!empty($title_tag)) {
            $attributes .= 'title_tag=' . $title_tag . ' ';
        }
        if (!empty($thumb_width)) {
            $attributes .= 'thumb_width=' . $thumb_width . ' ';
        }
        if (!empty($thumb_height)) {
            $attributes .= 'thumb_height=' . $thumb_height . ' ';
        }
        return do_shortcode("[hb_accommodation_list " . $attributes . "]");
    }

}
add_shortcode('traveller_hb_accommodation_list', 'traveller_hb_accommodation_list');
