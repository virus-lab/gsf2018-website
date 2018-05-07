<?php

/* gallery
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('gallery')) {

    function gallery($atts, $content = null) {

        extract(shortcode_atts(array(
            "images" => ""
                        ), $atts));

        $images = explode(',', $images);
        $output = '<!-- Map Start -->
				<div class="gallery">';
        foreach ($images as $image) {
            $imagethumb = wp_get_attachment_image_src($image, 'full');
            $imagefull = wp_get_attachment_image_src($image, 'full');

            $output .= '<a href="' . $imagefull[0] . ' " class="col-xs-6 col-sm-5 col-md-3 col-lg-2">
                        <img src="' . $imagethumb[0] . '" alt="" class="img-responsive" />
                    </a>';
        }
        $output .= '</div>
                        <!-- Map End -->';

        return $output;
    }

}

add_shortcode('gallery', 'gallery');



