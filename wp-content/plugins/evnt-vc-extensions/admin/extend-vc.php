<?php

/* HGroup
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("HGroup", "evnt-vc-extensions"),
    "base" => "hgroup",
    "description" => __("Header group (title and subtitle)", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Main Title", "evnt-vc-extensions"),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "evnt-vc-extensions"),
            "param_name" => "subtitle",
            "value" => "",
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Center text", "evnt-vc-extensions"),
            "param_name" => "center_text",
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "evnt-vc-extensions")
        ),
    ),
));

/* Subtitle
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Subtitle", "evnt-vc-extensions"),
    "base" => "subtitle",
    "description" => __("Add a subtitle", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "evnt-vc-extensions")
        ),
    ),
));



vc_map(array(
    "name" => __("Pricing Table", "evnt-vc-extensions"),
    "base" => "pricing_table",
    "description" => __("Title, options list and button", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Visible Items", "evnt-vc-extensions"),
            "param_name" => "layout",
            "value" => array(
                "prices1" => "prices1",
                "prices2" => "prices2",
                "prices3" => "prices3",
                "prices4" => "prices4",
                "prices5" => "prices5",
            ),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("WooCommerce integration", "evnt-vc-extensions"),
            "param_name" => "wc_integration",
            "value" => array(
                'No' => 'no_wc',
                'Yes' => 'yes_wc'
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Short description", "evnt-vc-extensions"),
            "param_name" => "title_description",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Product ID", "evnt-vc-extensions"),
            "param_name" => "product_id",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('yes_wc')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Unit", "evnt-vc-extensions"),
            "param_name" => "unit",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Currency sign", "evnt-vc-extensions"),
            "param_name" => "currency",
//            "description" => __("Works only if You dont set the Product ID", "evnt-vc-extensions"),
            "value" => "",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('no_wc')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Price", "evnt-vc-extensions"),
            "param_name" => "price_vc",
//            "description" => __("Works only if You dont set the Product ID", "evnt-vc-extensions"),
            "value" => "",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('no_wc')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Discout", "evnt-vc-extensions"),
            "param_name" => "discount",
//            "description" => __("Works only if You dont set the Product ID", "evnt-vc-extensions"),
            "value" => "",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('no_wc')
            ),
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("List", "evnt-vc-extensions"),
            "param_name" => "content",
            "value" => "<ul><li>List Item</li><li>List Item</li><li>List Item</li></ul>",
        ),
//        array(
//            "type" => "dropdown",
//            "class" => "",
//            "heading" => __("Button", "evnt-vc-extensions"),
//            "param_name" => "button",
//            "value" => array(
//                'Link' => 'link',
//                'Add to Cart' => 'buy',
//                'No Button' => 'no-button'
//            ),
//        ),
        array(
            "type" => "vc_link",
            "heading" => __("Link", "evnt-vc-extensions"),
            "param_name" => "link",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('no_wc')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "evnt-vc-extensions"),
            "param_name" => "button_text",
            'dependency' => array(
                'element' => 'wc_integration',
                'value' => array('yes_wc')
            ),
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Highlight", "evnt-vc-extensions"),
            "param_name" => "highlight",
            "value" => "",
        ),
    ),
));


/*
 * Sponsor Grid
 */

vc_map(array(
    "name" => __("Sponsor Grid", "evnt-vc-extensions"),
    "base" => "sponsor_grid",
    "description" => __("Show brand sponsors in a nice grid", "evnt-vc-extensions"),
    "as_parent" => array('only' => 'sponsor_grid_item'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "holder" => "div",
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Grid Layout", "evnt-vc-extensions"),
            "param_name" => "layout",
            "value" => array(
                "1" => "1",
                "2" => "2",
                "3" => "3"
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns", "evnt-vc-extensions"),
            "param_name" => "columns",
            "value" => array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "6" => "6",
                "12" => "12",
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "evnt-vc-extensions")
        ),
    ),
    "js_view" => 'VcColumnView'
));



/* Sponsor Carousel
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Sponsor Carousel", "evnt-vc-extensions"),
    "base" => "sponsor_carousel",
    "description" => __("Show brand sponsors in a nice carousel", "evnt-vc-extensions"),
    "as_parent" => array('only' => 'sponsor_carousel_item'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "holder" => "div",
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Visible Items", "evnt-vc-extensions"),
            "param_name" => "columns",
            "value" => array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "6" => "6",
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Navigation arrows", "evnt-vc-extensions"),
            "param_name" => "navs",
            "value" => array(
                "False" => "0",
                "True" => "1",
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Autoplay", "evnt-vc-extensions"),
            "param_name" => "autoplay",
            "default" => "5000",
            "description" => __("Accepted values: true, false, or time in milliseconds like 5000, which will be 5 seconds.", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "evnt-vc-extensions")
        ),
    ),
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Sponsor Item", "evnt-vc-extensions"),
    "base" => "sponsor_grid_item",
    "content_element" => true,
    "as_child" => array('only' => 'sponsor_grid'),
    "show_settings_on_create" => true,
    "holder" => "div",
    "params" => array(
        array(
            "type" => "attach_image",
            "heading" => __('Sponsor', 'evnt-vc-extensions'),
            "param_name" => "sponsor"
        ),
        array(
            "type" => "vc_link",
            "heading" => __("URL", "evnt-vc-extensions"),
            "param_name" => "sponsor_url",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
    ),
));

vc_map(array(
    "name" => __("Sponsor Item", "evnt-vc-extensions"),
    "base" => "sponsor_carousel_item",
    "content_element" => true,
    "as_child" => array('only' => 'sponsor_grid'),
    "show_settings_on_create" => true,
    "holder" => "div",
    "params" => array(
        array(
            "type" => "attach_image",
            "heading" => __('Sponsor', 'evnt-vc-extensions'),
            "param_name" => "sponsor"
        ),
        array(
            "type" => "vc_link",
            "heading" => __("URL", "evnt-vc-extensions"),
            "param_name" => "sponsor_url",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
    ),
));



/* Progress Bar
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Progress Bar", "evnt-vc-extensions"),
    "base" => "progress_bar",
    "description" => __("Show progress bar container", "evnt-vc-extensions"),
    "as_parent" => array('only' => 'progress_bar_item'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "holder" => "div",
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Progress bar item", "evnt-vc-extensions"),
    "base" => "progress_bar_item",
    "content_element" => true,
    "as_child" => array('only' => 'progress_bar'),
    "show_settings_on_create" => true,
    "holder" => "div",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('Progress bar percent', 'evnt-vc-extensions'),
            "param_name" => "percent"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Progress bar label text", "evnt-vc-extensions"),
            "param_name" => "text",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
    ),
));

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Sponsor_Carousel extends WPBakeryShortCodesContainer {
        
    }

    class WPBakeryShortCode_Sponsor_Grid extends WPBakeryShortCodesContainer {
        
    }

    class WPBakeryShortCode_Progress_Bar extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Sponsor_Carousel_Item extends WPBakeryShortCode {
        
    }

    class WPBakeryShortCode_Sponsor_Grid_Item extends WPBakeryShortCode {
        
    }

    class WPBakeryShortCode_Progress_Bar_Item extends WPBakeryShortCode {
        
    }

}

/* Mapa
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Map", "evnt-vc-extensions"),
    "base" => "map",
    "description" => __("Show map container", "evnt-vc-extensions"),
    "as_parent" => array('only' => 'map_item'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "holder" => "div",
    "params" => array(
//        array(
//            "type" => "textfield",
//            "heading" => __("Google maps api key", "evnt-vc-extensions"),
//            "param_name" => "api_key",
//            "description" => __("To get api key fallow this instructions <a href='https://developers.google.com/maps/documentation/javascript/get-api-key' target='_blank'>at this site</a> ", "evnt-vc-extensions")
//        ),
        array(
            "type" => "textfield",
            "heading" => __("Center map Lat", "evnt-vc-extensions"),
            "param_name" => "lat",
            "description" => __("Example: 52.520343301190614", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __('Center map Lng', 'evnt-vc-extensions'),
            "param_name" => "lng",
            "description" => __("Example: 373.4041194381714", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Zoom", "evnt-vc-extensions"),
            "param_name" => "zoom",
            "description" => __("Zoom (Default = 14)", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Language", "evnt-vc-extensions"),
            "param_name" => "language",
            "description" => __("Map language (Default = en)", "evnt-vc-extensions")
        )
    ),
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Map item", "evnt-vc-extensions"),
    "base" => "map_item",
    "content_element" => true,
    "as_child" => array('only' => 'map'),
    "show_settings_on_create" => true,
    "holder" => "div",
    "params" => array(
//        array(
//            "type" => "textfield",
//            "heading" => "test",
//            "param_name" => "counti"
//            
//            
//        ),
        array(
            "type" => "textfield",
            "heading" => __('Title', 'evnt-vc-extensions'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Lat", "evnt-vc-extensions"),
            "param_name" => "lat"
        ),
        array(
            "type" => "textfield",
            "heading" => __('Lng', 'evnt-vc-extensions'),
            "param_name" => "lng"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "evnt-vc-extensions"),
            "param_name" => "subtitle",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __('Phone', 'evnt-vc-extensions'),
            "param_name" => "phone",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address", "evnt-vc-extensions"),
            "param_name" => "address",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __('Email', 'evnt-vc-extensions'),
            "param_name" => "email",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Web", "evnt-vc-extensions"),
            "param_name" => "web",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Icon", "evnt-vc-extensions"),
            "param_name" => "icon_url",
            "description" => __("Optional.", "evnt-vc-extensions")
        ),
    ),
));


if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Map extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Map_Item extends WPBakeryShortCode {
        
    }

}

/* Counter Up
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Counter Up", "evnt-vc-extensions"),
    "base" => "counterup",
    "description" => __("Stat counter with animation", "evnt-vc-extensions"),
    "as_parent" => array('only' => 'counterup_item'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "holder" => "div",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "evnt-vc-extensions")
        ),
    ),
    "js_view" => 'VcColumnView'
));

vc_map(array(
    "name" => __("Counter Up Item", "evnt-vc-extensions"),
    "base" => "counterup_item",
    "content_element" => true,
    "as_child" => array('only' => 'logo_carousel'),
    "show_settings_on_create" => true,
    "holder" => "div",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __('Value', 'evnt-vc-extensions'),
            "param_name" => "number"
        ),
    ),
));


if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Counterup extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Counterup_Item extends WPBakeryShortCode {
        
    }

}

/* Countdown
  ------------------------------------------------------------------------------------------------------------------- */

function evnt_admin_special_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    //wp_enqueue_script('admin_scripts', get_stylesheet_directory_uri() . '/js/admin.js', 'jquery', '1.0', true);
}

add_action('admin_enqueue_scripts', 'evnt_admin_special_scripts');

vc_map(array(
    "name" => __("Countdown", "evnt-vc-extensions"),
    "base" => "countdown",
    "description" => __("Countdown clock with days, hours, minutes and seconds", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Year", "evnt-vc-extensions"),
            "param_name" => "datetime_year",
            "value" => "",
            'description' => __('Format example 2017', 'evnt-vc-extensions'),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Month", "evnt-vc-extensions"),
            "param_name" => "datetime_month",
            "value" => "",
            'description' => __('Format example 08', 'evnt-vc-extensions'),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Day", "evnt-vc-extensions"),
            "param_name" => "datetime_day",
            "value" => "",
            'description' => __('Format example 09', 'evnt-vc-extensions'),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Hour", "evnt-vc-extensions"),
            "param_name" => "datetime_hour",
            "value" => "",
            'description' => __('Format example 01', 'evnt-vc-extensions'),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Minutes", "evnt-vc-extensions"),
            "param_name" => "datetime_minutes",
            "value" => "",
            'description' => __('Format example 05', 'evnt-vc-extensions'),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "datetime_title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("description", "evnt-vc-extensions"),
            "param_name" => "datetime_description",
            "value" => "",
        ),
    )
));

/* service_square
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Service Widget ", "evnt-vc-extensions"),
    "base" => "service_square",
    "description" => __("Company service with icon, heading and small description", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "service_title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("description", "evnt-vc-extensions"),
            "param_name" => "service_description",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Url", "evnt-vc-extensions"),
            "param_name" => "service_url",
            "value" => "",
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Backgroud color", "evnt-vc-extensions"),
            "param_name" => "color",
            "value" => array(
                "grey" => "grey",
                "white" => "white"
            ),
        ),
        array(
            "type" => "iconpicker",
            "heading" => __("Icon FA", "evnt-vc-extensions"),
            "param_name" => "service_icons",
            'description' => __('Select icon from library.', 'evnt-vc-extensions'),
        ),
    )
));

/* feature_box
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Feature box", "evnt-vc-extensions"),
    "base" => "feature_box",
    "description" => __("Add a box with title, description and nice icons on the left hand side", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => __('Evnt Custom', 'evnt-vc-extensions'),
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "service_title",
            "value" => "",
        ),
        array(
            "type" => "textfield",
            "heading" => __("description", "evnt-vc-extensions"),
            "param_name" => "service_description",
            "value" => "",
        ),
        array(
            "type" => "iconpicker",
            "heading" => __("Icon FA", "evnt-vc-extensions"),
            "param_name" => "service_icons",
            'description' => __('Select icon from library.', 'evnt-vc-extensions'),
        ),
    )
));

/* speakers Gallery
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Speakers Gallery", "evnt-vc-extensions"),
    "base" => "speakers_gallery",
    "description" => __("Speakers list with links to profile pages", "evnt-vc-extensions"),
    "category" => __('Evnt Custom', 'evnt-vc-extensions'),
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "show_settings_on_create" => true,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Visible Items", "evnt-vc-extensions"),
            "param_name" => "layout",
            "value" => array(
                "speakers1" => "speakers1",
                "speakers2" => "speakers2",
                "speakers3" => "speakers3",
                "speakers4" => "speakers4",
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Items to display", "evnt-vc-extensions"),
            "param_name" => "per_page",
            "description" => "How many items to display? By default will show all posts."
        ),
        array(
            "type" => "exploded_textarea",
            "heading" => __("Tags", "evnt-vc-extensions"),
            "param_name" => "include_tags",
//            'dependency' => array(
//                'element' => 'filtering',
//                'value' => array('1')
//            ),
            "description" => __("If you want to display only specific filtering options (tags) here, please enter their names, one per line.", "evnt-vc-extensions")
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Columns", "evnt-vc-extensions"),
            "param_name" => "columns",
            "value" => array(
                "4 columns" => "4",
                "3 columns" => "3",
                "2 columns" => "2"
            ),
            "description" => "Option for layout 1"
        ),
        array(
            "type" => "exploded_textarea",
            "heading" => __("Categories", "evnt-vc-extensions"),
            "param_name" => "include_categories",
            "description" => __("If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter).", "evnt-vc-extensions")
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Order By", "evnt-vc-extensions"),
            "param_name" => "sort_order",
            "value" => array(
                "ascending" => "ASC",
                "descending" => "DESC",
            ),
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Order", "evnt-vc-extensions"),
            "param_name" => "order",
            "value" => array(
                "title" => "title",
                "date" => "date",
                "ID" => "ID",
                "Manually" => "post__in"
            ),
            "description" => ""
        ),
        array(
            "type" => "exploded_textarea",
            "heading" => __("Included speakers", "evnt-vc-extensions"),
            "param_name" => "post__in",
            'dependency' => array(
                'element' => 'order',
                'value' => array('post__in')
            ),
            "description" => __("If you want to narrow output or order speaker manually, enter speakers id here. Note: Only listed speakers will be included. Divide categories with linebreaks (Enter).", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Selected Posts", "evnt-vc-extensions"),
            "param_name" => "selected_posts",
            "description" => __("Show only selected posts. Input post ID's separated with comma. Example: 16,58,24.", "evnt-vc-extensions")
        ),
    )
));


/* Button
  ------------------------------------------------------------------------------------------------------------------- */

vc_map(array(
    "name" => __("Button", "evnt-vc-extensions"),
    "base" => "js_button",
    "description" => __(" Button with editable text, link, background and color", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
//    'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_templates/admin-style.css'),
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "vc_link",
            "heading" => __("Link & Title", "evnt-vc-extensions"),
            "param_name" => "link",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Color", "evnt-vc-extensions"),
            "param_name" => "color",
            "value" => array(
                'Default' => 'btn-default',
                'Primary' => 'btn-primary',
                'Secondary' => 'btn-secondary',
                'Success' => 'btn-success',
                'Info' => 'btn-info',
                'Warning' => 'btn-warning',
                'Danger' => 'btn-danger'
            ),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Size", "evnt-vc-extensions"),
            "param_name" => "size",
            "value" => array(
                'Default' => '',
                'Large' => 'btn-lg',
                'Small' => 'btn-sm',
            ),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Full Width", "evnt-vc-extensions"),
            "param_name" => "full-width",
            "value" => array(
                'No' => '',
                'Yes' => 'btn-block',
            ),
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Align", "evnt-vc-extensions"),
            "param_name" => "align",
            "value" => array(
                'Left' => 'left',
                'Center' => 'center',
                'Right' => 'right',
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "evnt-vc-extensions"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "evnt-vc-extensions"),
        ),
    ),
));

/* Feature */

vc_map(array(
    "name" => __("Featured item", "evnt-vc-extensions"),
    "base" => "feature",
    "description" => __("Add a feature item with big photo, title, subtitle and description. Edit background color, text color and choose image side. ", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "evnt-vc-extensions"),
            "param_name" => "title_description"
        ),
        array(
            "type" => "vc_link",
            "heading" => __("Link & Title", "evnt-vc-extensions"),
            "param_name" => "link",
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Image Side", "evnt-vc-extensions"),
            "param_name" => "side",
            "value" => array(
                'Right' => 'right',
                'Left' => 'left'
            ),
        ),
        array(
            "type" => "colorpicker",
            "class" => "colors",
            "heading" => __("Background color", "evnt-vc-extensions"),
            "param_name" => "bgcolor",
            "value" => '#f1f0ec',
            "description" => __("Choose background color", "evnt-vc-extensions")
        ),
        array(
            "type" => "colorpicker",
            "class" => "colors",
            "heading" => __("Title text color", "evnt-vc-extensions"),
            "param_name" => "tcolor",
            "value" => '#000', //Default Red color
            "description" => __("Choose title text color", "evnt-vc-extensions")
        ),
        array(
            "type" => "colorpicker",
            "class" => "colors",
            "heading" => __("Primary text color", "evnt-vc-extensions"),
            "param_name" => "pcolor",
            "value" => '#888', //Default Red color
            "description" => __("Choose text color", "evnt-vc-extensions")
        ),
        array(
            "type" => "colorpicker",
            "class" => "colors",
            "heading" => __("Secondary text color", "evnt-vc-extensions"),
            "param_name" => "scolor",
            "value" => '#be1a39', //Default Red color
            "description" => __("Choose secondary text color", "evnt-vc-extensions")
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Image', 'evnt-vc-extensions'),
            "param_name" => "image"
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Add image zoom on hover", "evnt-vc-extensions"),
            "param_name" => "hover_zoom",
            "value" => array(
                'No' => 'false',
                'Yes' => 'true'
            ),
            "description" => __("Deprecated", "evnt-vc-extensions")
        ),
        array(
            "type" => "textfield",
            "heading" => __("text", "evnt-vc-extensions"),
            "param_name" => "text"
        ),
    )
));

/* Contact address */

vc_map(array(
    "name" => __("Address ", "evnt-vc-extensions"),
    "base" => "contact_address",
    "description" => __("Add address widget with title, address, phone and email", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address", "evnt-vc-extensions"),
            "param_name" => "address_l1"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address line 2", "evnt-vc-extensions"),
            "param_name" => "address_l2"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address line 3", "evnt-vc-extensions"),
            "param_name" => "address_l3"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Phone", "evnt-vc-extensions"),
            "param_name" => "phone"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email", "evnt-vc-extensions"),
            "param_name" => "email"
        ),
    )
));

/* Sitemap */

vc_map(array(
    "name" => __("Sitemap ", "evnt-vc-extensions"),
    "base" => "sitemap",
    "description" => __("Add list of your website pages", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "evnt-vc-extensions"),
            "param_name" => "title"
        ),
        // params group
        array(
            'type' => 'param_group',
            'value' => '',
            'param_name' => 'm_links',
            // Note params is mapped inside param-group:
            'params' => array(
                array(
                    "type" => "vc_link",
                    "heading" => __("Link & Title", "evnt-vc-extensions"),
                    "param_name" => "link",
                ),
            )
        )
    )
));




/* Gallery */

vc_map(array(
    "name" => __("Gallery ", "evnt-vc-extensions"),
    "base" => "gallery",
    "description" => __("Add a gallery grid with links to bigger images", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __('Images', 'evnt-vc-extensions'),
            "param_name" => "images"
        ),
    )
));




/* Floor plan */

vc_map(array(
    "name" => __("Floor plan ", "evnt-vc-extensions"),
    "base" => "floor_plan",
    "description" => __("Add tabs with floor plan images", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        // params group
        array(
            'type' => 'param_group',
            "heading" => __("Floor Plan tabs item ", "evnt-vc-extensions"),
            'value' => '',
            'param_name' => 'tabs',
            "description" => __("Add another tab item", "evnt-vc-extensions"),
            // Note params is mapped inside param-group:
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Tabs name", "evnt-vc-extensions"),
                    "param_name" => "tab_name"
                ),
                array(
                    "type" => "attach_image",
                    "heading" => __("Floor plan image", "evnt-vc-extensions"),
                    "param_name" => "image",
                    "description" => __("Optional.", "evnt-vc-extensions")
                ),
                // params group
                array(
                    'type' => 'param_group',
                    "heading" => __("Floor Plan item ", "evnt-vc-extensions"),
                    'value' => '',
                    'param_name' => 'points',
                    // Note params is mapped inside param-group:
                    'params' => array(
                        array(
                            "type" => "textfield",
                            "heading" => __("Title", "evnt-vc-extensions"),
                            "param_name" => "point"
                        ),
                        array(
                            "type" => "textfield",
                            "heading" => __("Point sign", "evnt-vc-extensions"),
                            "param_name" => "point_sign"
                        ),
                    )
                )
            )
        )
    )
));


/* Line */

vc_map(array(
    "name" => __("Horizontal line ", "evnt-vc-extensions"),
    "base" => "line",
    "description" => __("Add horizontal line", "evnt-vc-extensions"),
    "show_settings_on_create" => false,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
));


/* newsletter
  ------------------------------------------------------------------------------------------------------------------- */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active('newsletter/plugin.php')) {

    vc_map(array(
        "name" => __("Newsletter form", "evnt-vc-extensions"),
        "base" => "evnt_newsletter_form",
        "description" => __("Add subscription input and button", "evnt-vc-extensions"),
        "show_settings_on_create" => true,
        "weight" => 1,
        "category" => 'Evnt Custom',
        "group" => 'Evnt Custom',
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/images/favicon.png",
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Newsletter Template", "evnt-vc-extensions"),
                "param_name" => "form",
                "value" => array(
                    'Event Theme Skin' => '',
                    'Plugin standard skin' => 'standard',
                    'Plugin custom skin 1' => '1',
                    'Plugin custom skin 2' => '2',
                    'Plugin custom skin 3' => '3',
                    'Plugin custom skin 4' => '4',
                    'Plugin custom skin 5' => '5',
                    'Plugin custom skin 6' => '6',
                    'Plugin custom skin 7' => '7',
                    'Plugin custom skin 8' => '8',
                    'Plugin custom skin 9' => '9',
                    'Plugin custom skin 10' => '10',
                ),
            ),
        )
    ));
}



/* Row Color Scheme
  ------------------------------------------------------------------------------------------------------------------- */

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" => __("Color Scheme", "evnt-vc-extensions"),
    "param_name" => "color_scheme",
    "description" => __("This parameter allow you to switch beetwen of 3 various color sets (for title, subtitle, text and link colors). You can manage these colors sets in theme options panel.", "evnt-vc-extensions"),
    "value" => array(
        __("Default", "evnt-vc-extensions") => 'color-default',
        __("Alternative", "evnt-vc-extensions") => 'color-alternative',
    )
));



/* CF7 Custom */
$cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

$contact_forms = array();
if ($cf7) {
    foreach ($cf7 as $cform) {
        $contact_forms[$cform->post_title] = $cform->ID;
    }
} else {
    $contact_forms[__('No contact forms found', 'evnt-vc-extensions')] = 0;
}

vc_map(
        array(
            'base' => 'evnt_contact_form',
            'name' => __('Contact Form 7', 'evnt-vc-extensions'),
            'icon' => 'icon-wpb-contactform7',
            'category' => __('Content', 'evnt-vc-extensions'),
            'description' => __('Place Contact Form7', 'evnt-vc-extensions'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Form title', 'evnt-vc-extensions'),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => __('What text use as form title. Leave blank if no title is needed.', 'evnt-vc-extensions'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select contact form', 'evnt-vc-extensions'),
                    'param_name' => 'id',
                    'value' => $contact_forms,
                    'save_always' => true,
                    'description' => __('Choose previously created contact form from the drop down list.', 'evnt-vc-extensions'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Contact Form 7 Template", "evnt-vc-extensions"),
                    "param_name" => "skin",
                    "value" => array(
                        'Contact Form 7 style' => 'standard',
                        'Predefined invitation style' => 'invitation',
                    ),
                ),
            )
        )
);


//Recent post 
vc_map(array(
    "name" => __("recent_blog_posts ", "evnt-vc-extensions"),
    "base" => "recent_blog_posts",
    "description" => __("Add a gallery grid with links to bigger images", "evnt-vc-extensions"),
    "show_settings_on_create" => true,
    "weight" => 1,
    "category" => 'Evnt Custom',
    "group" => 'Evnt Custom',
    "content_element" => true,
    "icon" => get_template_directory_uri() . "/images/favicon.png",
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __('Images', 'evnt-vc-extensions'),
            "param_name" => "images"
        ),
    )
));
//            "layout" => "carousel",
//            "autoplay" => "",
//            "posts" => 4,
//            "columns" => 2,
//            "categories" => "",
//            "el_class" => ""
?>
