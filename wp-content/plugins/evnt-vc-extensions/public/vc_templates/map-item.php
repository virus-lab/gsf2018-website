<?php

/* map_item Item
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('map_item')) {

    function map_item($atts, $content = null) {

        extract(shortcode_atts(array(
            'icon_url' => '',
            'title' => '',
            'lat' => '',
            'lng' => '',
            'subtitle' => '',
            'phone' => '',
            'address' => '',
            'email' => '',
            'web' => '',
            'contents' => '',
            'open' => '',
//            'counti' => ''
                        ), $atts));

        if (!empty($lat) and ! empty($lng)) {
            $image = wp_get_attachment_image_src($icon_url, 'full');

            $output = '
        mapMarkers.push(
                        {
                            "id": "' . $lat . '_' . $lng . '",
                            "lat": ' . $lat . ',
                            "lng": ' . $lng . ',
                            "icon": "custom",
                            "icon_url": "' . $image[0] . '",
                            "title": "' . $title . '"
                        }
                    );
        mapInfoWindows.push(
                        {
                            "marker_id": "' . $lat . '_' . $lng . '",
                            "title": "' . $title . '",
                            "subtitle": "' . $subtitle . '",
                            "phone": "' . $phone . '",
                            "address": "' . $address . '",
                            "email": "' . $email . '",
                            "web": "' . $web . '",
                            "content": "' . $contents . '",
                            "open": "0"
                        }
                    );
                    


';
//{"id":41597,
//"marker_id":"54.19073554090619_16.180007457733154",
//"title":"Title",
//"subtitle":"Subtitle",
//"phone":"++2 1234 5678",
//"address":"John Smith Str. 1, Melbourne",
//"email":"john@smith.com",
//"web":"johnsmith.com",
//"content":"<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>",
//"open":0
//},
            return $output;
        };
    }

}

add_shortcode('map_item', 'map_item');
