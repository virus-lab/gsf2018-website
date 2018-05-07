<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'evnt_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function evnt_show_if_front_page($cmb) {
    // Don't show this metabox if it's the front page template
    if ($cmb->object_id !== get_option('page_on_front')) {
        return false;
    }
    return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function evnt_hide_if_no_cats($field) {
    // Don't show this field if not in the cats category
    if (!has_tag('cats', $field->object_id)) {
        return false;
    }
    return true;
}

add_action('cmb2_init', 'evnt_register_page_title_metabox');

/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function evnt_register_page_title_metabox() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_evnt_page_title_';

    /**
     * Metabox to be displayed on a single page ID
     */
    $cmb_page_title = new_cmb2_box(array(
        'id' => $prefix . 'metabox',
        'title' => esc_html__('Page Title Settings', 'evnt'),
        'object_types' => array('page',), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
//		'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
    ));

    $cmb_page_title->add_field(array(
        'name' => esc_html__('Page Title', 'evnt'),
        'desc' => esc_html__('show / hide page title on this page', 'evnt'),
        'id' => $prefix . 'show',
        'type' => 'select',
        'show_option_none' => false,
        'options' => array(
            'show' => esc_html__('Show', 'evnt'),
            'hide' => esc_html__('Hide', 'evnt'),
        ),
    ));

    $cmb_page_title->add_field(array(
        'name' => esc_html__('Subtitle', 'evnt'),
        'desc' => esc_html__('subtitle will be displayed below the page title (optional)', 'evnt'),
        'id' => $prefix . 'subtitle',
        'type' => 'text',
    ));
}
