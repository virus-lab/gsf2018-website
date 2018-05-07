<?php

/* line
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('line')) {

    function line($atts, $content = null) {

        return '<hr class="thick"></hr>';
    }

}

add_shortcode('line', 'line');



