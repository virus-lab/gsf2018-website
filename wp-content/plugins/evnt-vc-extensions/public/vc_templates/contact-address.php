<?php

/* contact_address
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('contact_address')) {

    function contact_address($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
            "address_l1" => "",
            "address_l2" => "",
            "address_l3" => "",
            "phone" => "",
            "email" => ""
                        ), $atts));


        if (!empty($address_l1)) {
            $output = '<h5>' . $title . '</h5>
                        <address>';

            if (!empty($address_l1)) {
                $output .= $address_l1 . '<br>';
            }
            if (!empty($address_l2)) {
                $output .= $address_l2 . '<br>';
            }
            if (!empty($address_l3)) {
                $output .= $address_l3;
            }
            $output .='</address>';
            if (!empty($phone)) {
                $output .= '<p class="phone"><a href="tel:' . $phone . '">' . $phone . '</a></p>';
            }
            if (!empty($email)) {
                $output .= '<p class="email"><a href="mailto:' . $email . '">' . $email . '</a></p>';
            }
            return $output;
        }
    }

}

add_shortcode('contact_address', 'contact_address');
