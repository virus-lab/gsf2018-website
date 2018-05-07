<?php

/* Countdown
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('countdown')) {

    function countdown($atts, $content = null) {

        extract(shortcode_atts(array(
            "datetime_year" => "",
            "datetime_month" => "",
            "datetime_day" => "",
            "datetime_hour" => "",
            "datetime_minutes" => "",
            "datetime_title" => "",
            "datetime_description" => "",
            "el_class" => ""
                        ), $atts));


        //if( empty( $el_class ) ) {
        $output = '<div id="slider-content">
					<div class="containers">
						<div class="col-sm-12">';

        if (!empty($datetime_title)) {
            $output .= '<h1>' . $datetime_title . '</h1>';
        }

        if (!empty($datetime_description)) {
            $output .= '<h4>' . $datetime_description . '</h4>';
        }
//        $output .=  get_option('gmt_offset');
        $output .= '<ul id="countdown" data-utc="' . get_option('gmt_offset') . '">';
        if (!empty($datetime_year)) {
            $output .= '<input type="hidden" id="datetime_year" value=' . $datetime_year . '>';
        }
        if (!empty($datetime_month)) {
            $output .= '<input type="hidden" id="datetime_month" value=' . $datetime_month . '>';
        }
        if (!empty($datetime_day)) {
            $output .= '<input type="hidden" id="datetime_day" value=' . $datetime_day . '>';
        }
        if (!empty($datetime_hour)) {
            $output .= '<input type="hidden" id="datetime_hour" value=' . $datetime_hour . '>';
        }
        if (!empty($datetime_minutes)) {
            $output .= '<input type="hidden" id="datetime_minutes" value=' . $datetime_minutes . '>';
        }

        $output .= '<input type="hidden" id="transday" value=' . __("Day", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transdays" value=' . __("Days", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transhour" value=' . __("Hour", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transhours" value=' . __("Hours", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transminute" value=' . __("Minute", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transminutes" value=' . __("Minutes", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transsecond" value=' . __("Second", "evnt-vc-extensions") . '>';

        $output .= '<input type="hidden" id="transseconds" value=' . __("Seconds", "evnt-vc-extensions") . '>';

        $output .= '<li><span class="days">00</span><p class="days_text">' . __("Days", "evnt-vc-extensions") . '</p></li>
                                <li><span class="hours">00</span><p class="hours_text">' . __("Hours", "evnt-vc-extensions") . '</p></li>
                                <li><span class="minutes">00</span><p class="minutes_text">' . __("Minutes", "evnt-vc-extensions") . '</p></li>
                                <li><span class="seconds">00</span><p class="seconds_text">' . __("Seconds", "evnt-vc-extensions") . '</p></li>
                            </ul>
                        </div>
                </div>
        </div>';

        return $output;

        //}
    }

}

add_shortcode('countdown', 'countdown');
