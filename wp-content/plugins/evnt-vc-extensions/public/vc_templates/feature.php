<?php

/* feature
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('feature')) {

    function feature($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
            "title_description" => "",
            "image" => "",
            "text" => "",
            "side" => "",
            "link" => "",
            "button_text" => "",
            "hover_zoom" => "false",
            "bgcolor" => "",
            "tcolor" => "",
            "pcolor" => "",
            "scolor" => "",
                        ), $atts));

        $link = ( $link == '||' ) ? '' : $link;
        $link = vc_build_link($link);
        $use_link = false;
        if ($hover_zoom == 'true') {
            $hover_zoom = " image-hover";
        } else {
            $hover_zoom = "";
        }


        if (!empty($bgcolor)) {
            $bgcolor = ' style="background:' . $bgcolor . ';"';
        } else {
            $bgcolor = "";
        }
        if (!empty($tcolor)) {
            $tcolor = ' style="color:' . $tcolor . '; "';
        } else {
            $tcolor = "";
        }
        if (!empty($scolor)) {
            $scolor = ' style="color:' . $scolor . '; "';
        } else {
            $scolor = "";
        }
        if (!empty($pcolor)) {
            $pcolor = ' style="color:' . $pcolor . ';"';
        } else {
            $pcolor = "";
        }
        $image = wp_get_attachment_image_src($image, 'full');

        if ($hover_zoom == '') {

//feature1!!!!!!!!!!!!!!!!!!!!!!!

            $output = '<div class="row feature2">';

            if ($side == 'right' or empty($side)) {
                $output .= '<div class="col-md-6 hidden-md hidden-lg image2 feature2-content" style="background-image: url(' . $image[0] . ')"></div>';
            }
            if ($side == 'left') {
                $output .= '<div class="col-md-6 image2 feature2-content" style="background-image: url(' . $image[0] . ')"></div>';
            }

            $output .= '<div class="col-md-6 text light feature2-content" ' . $bgcolor . ' >
						<h5 ' . $tcolor . ' >' . $title . '</h5>
						<h6 ' . $scolor . ' >' . $title_description . '</h6>
						<p  ' . $pcolor . ' >' . $text . '</p>';

            if (strlen($link['url']) > 0) {
                $use_link = true;
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';

                $output .= '<p><a class="btn btn-danger" href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '</a></p>';
            }

            $output .= '</div>';

            if ($side == 'right' or empty($side)) {
                $output .= '<div class="col-md-6 hidden-sm hidden-xs image2 feature2-content" style="background-image: url(' . $image[0] . ')"></div>';
            }
            $output .= '</div>';
        } else {
//feature2!!!!!!!!!!!!!!!!!!!!!!!

            if (!wp_is_mobile()) {

                $output = '<div class="row feature">';
                if ($side == 'right' or empty($side)) {
                    $output .= '<div class="col-xs-12 col-sm-12 hidden-md hidden-lg image-box"><div class="image ' . $hover_zoom . '" style="background-image: url(' . $image[0] . ')"></div></div>';
                }
                if ($side == 'left') {
                    $output .= '<div class="col-md-6 image-box"><div class="image ' . $hover_zoom . '" style="background-image: url(' . $image[0] . ')"></div></div>';
                }
                $output .= '<div class="col-md-6 col-xs-12 col-sm-12 text light" ' . $bgcolor . ' >
						<h5 ' . $tcolor . ' >' . $title . '</h5>
						<h6 ' . $scolor . ' >' . $title_description . '</h6>
						<p  ' . $pcolor . ' >' . $text . '</p>';


                if (strlen($link['url']) > 0) {
                    $use_link = true;
                    $a_href = $link['url'];
                    $a_title = $link['title'];
                    $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';

                    $output .= '<p><a class="btn btn-danger" href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '</a></p>';
                }

                $output .= '</div>';

                if ($side == 'right' or empty($side)) {
                    $output .= '<div class="col-md-6 hidden-sm hidden-xs image-box"><div class="image ' . $hover_zoom . '" style="background-image: url(' . $image[0] . ')"></div></div>';
                }

                $output .= '</div>';
            } else {
                $output = '<div class="row feature-mobile">';

                $output .= '<div class="col-xs-12 image-box"><div class="image-mobile" style="background-image: url(' . $image[0] . ')"></div></div>';

                $output .= '<div class="col-xs-12 text light" ' . $bgcolor . ' >
						<h5 ' . $tcolor . ' >' . $title . '</h5>
						<h6 ' . $scolor . ' >' . $title_description . '</h6>
						<p  ' . $pcolor . ' >' . $text . '</p>';


                if (strlen($link['url']) > 0) {
                    $use_link = true;
                    $a_href = $link['url'];
                    $a_title = $link['title'];
                    $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';

                    $output .= '<p><a class="btn btn-danger" href="' . $a_href . '" target="' . $a_target . '">' . $a_title . '</a></p>';
                }

                $output .= '</div>';


                $output .= '</div>';
            }
        }
        return $output;
    }

}

add_shortcode('feature', 'feature');



