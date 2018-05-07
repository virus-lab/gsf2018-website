<?php

/* Logo Carousel 
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('sponsor_grid')) {

    function sponsor_grid($atts, $content = null) {

        extract(shortcode_atts(array(
            'layout' => '',
            'columns' => '',
            'el_class' => '',
                        ), $atts));
        switch ($columns) {
            case 1:
                $columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
                break;
            case 2:
                $columns = 'col-xs-6 col-sm-6 col-md-6 col-lg-6';
                break;
            case 3:
                $columns = 'col-xs-4 col-sm-4 col-md-4 col-lg-4';
                break;
            case 4:
                $columns = 'col-xs-3 col-sm-3 col-md-3 col-lg-3';
                break;
            case 6:
                $columns = 'col-xs-2 col-sm-2 col-md-2 col-lg-2';
                break;
            case 12:
                $columns = 'col-xs-1 col-sm-1 col-md-1 col-lg-1';
                break;
            default:
                $columns = 'col-xs-6 col-sm-4 col-md-3 col-lg-2';
        }


        if (!empty($el_class))
            $el_class = ' ' . $el_class;

        if ($layout === '2') {
            $sponsors = 'sponsors2';
        } elseif ($layout === '3') {
            $sponsors = 'sponsors3';
        } else {
            $sponsors = 'sponsors1';
        }

        $output = '<div class="row ' . $sponsors . '">
                    <ul id="spond">
                            ' . wpb_js_remove_wpautop($content) . '
                    </ul>
            <script>
jQuery("#spond").find("div").addClass("' . $columns . '");'
                . '</script>';

        return $output;
    }

}

add_shortcode('sponsor_grid', 'sponsor_grid');
