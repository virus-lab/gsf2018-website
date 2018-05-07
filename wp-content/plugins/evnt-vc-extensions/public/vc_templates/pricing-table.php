<?php

/* Pricing Table
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('pricing_table')) {

    function pricing_table($atts, $content = null) {
        $args = array(
            "layout" => "",
            "title" => "",
            "title_description" => "",
            "product_id" => "",
            "price_vc" => "",
            "unit" => "",
            "currency" => "",
            "discount" => "",
            "highlight" => false,
            "button" => "link",
            "link" => "",
            "button_text" => "",
            "wc_integration" => "no_wc"
        );

        extract(shortcode_atts($args, $atts));

        $_product = wc_get_product($product_id);
        if ($_product) {
            $price = $_product->get_price();
            $price2 = $_product->get_regular_price();
            $string = get_woocommerce_price_format();

            $pricewithsymbol = sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $price);
            if ($price !== "" and $price2 !== "") {
                if ($price < $price2) {
                    $perc = ($price / $price2) * 100;
                    $perc = 100 - $perc;
                }
            }
        }
        if (!$layout) {
            $output = '<div class="text-center prices1">';
        } else {
            $output = '<div class="text-center ' . $layout . '">';
        }
        if ($highlight) {
            $output .= '<div class="pricetable popular">';
        } else {
            $output .= '<div class="pricetable">';
        }

        $output .= '<h5>' . $title . '</h5>';
        $output .= '<h6>' . $title_description . ' </h6>';
        if ($_product) {
            $output .= '<div class="price"><sup>' . get_woocommerce_currency_symbol() . '</sup>' . $price . '<sub>/' . $unit . '</sub></div>';
        } else {
            if ($currency != '' or $price_vc != '' or $unit != '') {
                $output .= '<div class="price">';
                if ($currency != '') {

                    $output .= '<sup>' . $currency . '</sup>';
                }
                if ($price_vc != '') {
                    $output .= $price_vc;
                }
                if ($unit != '') {
                    $output .= '<sub>/' . $unit . '</sub>';
                }
                $output .= '</div>';
            }
        }
        $output .= '<ul>';
        $output .= strip_tags($content, '<li>');
        $output .= '</ul>';

        switch ($wc_integration) {
            case 'no_wc':
                if ($link) {
                    $link = ( $link == '||' ) ? '' : $link;
                    $link = vc_build_link($link);
                    $use_link = false;
                    if (strlen($link['url']) > 0) {
                        $use_link = true;
                        $a_href = $link['url'];
                        $a_title = $link['title'];
                        $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';
                    }
                    $output .= '<a href="' . $a_href . '" class="btn btn-primary" target="' . $a_target . '">' . $a_title . '</a>';
                }
                break;
            case 'yes_wc':
                if($button_text) {
                    if ($_product) {
                        global $woocommerce;
                        if (!empty($woocommerce)) {
                            $cart_url = $woocommerce->cart->get_cart_url();
                            $output .= '<a href="' . $cart_url . '?add-to-cart=' . $product_id . '" class="btn btn-primary">' . $button_text . '</a>';
                        }
                    }
                }
                break;
            default:
                break;
        }
        if ($_product) {
            if ($price < $price2) {
                $output .= '<div class="discount">-' . $perc . '%</div>';
            }
        } else {
            if ($discount != '') {
                $output .= '<div class="discount">-' . $discount . '%</div>';
            }
        }
        $output .= '</div>
	    </div>';
        return $output;
    }

}
add_shortcode('pricing_table', 'pricing_table');
