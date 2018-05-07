<?php

/* Floor plan
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('floor_plan')) {

    function floor_plan($atts, $content = null) {

        extract(shortcode_atts(array(
            "title" => "",
//            "image" => "",
            "points" => "",
            "point_sign" => "",
            "tabs" => ""
                        ), $atts));

        
        $tabs_list = vc_param_group_parse_atts($tabs);
        $output = '
							
    <!-- Tab List Start -->
    <ul class="floor-plan nav nav-tabs nav-justified" role="tablist">';

        foreach ($tabs_list as $tab) {
            if (!empty($tab['tab_name'])) {
                $output .= '<li role="presentation" class="">'
                        . '<a href="#'
                        . hash('ripemd160', $tab['tab_name'])
                        . '" aria-controls="'
                        . hash('ripemd160', $tab['tab_name']) . '" role="tab" data-toggle="tab">'
                        . $tab['tab_name'] . ''
                        . '</a>'
                        . '</li>';
            }
        }

        $output .= '
    </ul>
    <!-- Tab List End -->

    <!-- Tab panes Start -->
    <div class="tab-content">';

        foreach ($tabs_list as $tab) {
            $image = wp_get_attachment_image_src($tab['image'], 'full');
            if (!empty($image)) {

                $output .= ' <!-- Floor Plan 1 Start -->
            <div role="tabpanel" class="tab-pane fade in " id="' . hash('ripemd160', $tab['tab_name']) . '">
                    <img src="' . $image[0] . '" alt="" class="img-responsive" />
                    <ul class="row circles">';
            }
            $points = vc_param_group_parse_atts($tab['points']);
            foreach ($points as $point) {
                if (!empty($point)) {
                    $output .= '<li class="col-sm-4">';
                    if (!empty($point['point_sign'])) {
                        $output .= '<span>' . $point['point_sign'] . '</span> ';
                    }
                    $output .= $point['point'] . '</li>';
                }
            }

            $output .= '</ul>
            </div>
            <!-- Floor Plan 1 End -->';
        }


        $output .= '</div>
    <!-- Tab panes End -->';

        return $output;
    }

}

add_shortcode('floor_plan', 'floor_plan');



