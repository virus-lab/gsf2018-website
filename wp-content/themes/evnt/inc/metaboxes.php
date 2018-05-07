<?php
add_action('add_meta_boxes', 'evnt_add_speaker_description_metaboxes');

function evnt_add_speaker_description_metaboxes() {
    add_meta_box('evnt_speaker_description', esc_html__('Speaker Short Description', 'evnt'), 'evnt_render_description_meta_boxes', 'speaker', 'normal', 'high');
}

function evnt_render_description_meta_boxes($post) {

    $meta = get_post_custom($post->ID);
    $short_description = !isset($meta['evnt_speaker_short_description'][0]) ? '' : $meta['evnt_speaker_short_description'][0];

    wp_nonce_field(basename(__FILE__), 'evnt_speaker_fields');
    ?>

    <table class="form-table">
        <tr>
        <textarea rows="2" cols="100" id="short-description" name="evnt_speaker_short_description" class="regular-text" ><?php echo esc_attr($short_description); ?></textarea>
    </tr>
    </table>

    <?php
}

// Save the Metabox Data

function evnt_save_description_meta_boxes($post_id) {

    global $post;

    // Verify nonce
    if (!isset($_POST['evnt_speaker_fields']) || !wp_verify_nonce($_POST['evnt_speaker_fields'], basename(__FILE__))) {
        return $post_id;
    }

    // Check Autosave
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
        return $post_id;
    }

    // Don't save if only a revision
    if (isset($post->post_type) && $post->post_type == 'revision') {
        return $post_id;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    $meta['evnt_speaker_short_description'] = ( isset($_POST['evnt_speaker_short_description']) ? esc_textarea($_POST['evnt_speaker_short_description']) : '' );


    foreach ($meta as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}

add_action('save_post', 'evnt_save_description_meta_boxes', 10, 2); // save the custom fields


add_action('add_meta_boxes', 'evnt_add_speaker_metaboxes');

function evnt_add_speaker_metaboxes() {
    add_meta_box('evnt_speaker_details', esc_html__('Speaker Details', 'evnt'), 'evnt_render_meta_boxes', 'speaker', 'normal', 'high');
}

function evnt_render_meta_boxes($post) {

    $meta = get_post_custom($post->ID);
    $title = !isset($meta['evnt_speaker_title'][0]) ? '' : $meta['evnt_speaker_title'][0];
    $twitter = !isset($meta['evnt_speaker_twitter'][0]) ? '' : $meta['evnt_speaker_twitter'][0];
    $linkedin = !isset($meta['evnt_speaker_linkedin'][0]) ? '' : $meta['evnt_speaker_linkedin'][0];
    $facebook = !isset($meta['evnt_speaker_facebook'][0]) ? '' : $meta['evnt_speaker_facebook'][0];

    wp_nonce_field(basename(__FILE__), 'evnt_speaker_fields');
    ?>

    <table class="form-table">

        <tr>
            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_speaker_title"><?php esc_html_e('Title', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <input type="text" name="evnt_speaker_title" class="regular-text" value="<?php echo esc_attr($title); ?>">
                <p class="description"><?php esc_html_e('E.g. CEO, Sales Lead, Designer', 'evnt'); ?></p>
            </td>
        </tr>

        <tr>
            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_speaker_linkedin"><?php esc_html_e('LinkedIn URL', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <input type="text" name="evnt_speaker_linkedin" class="regular-text" value="<?php echo esc_attr($linkedin); ?>">
            </td>
        </tr>

        <tr>
            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_speaker_twitter"><?php esc_html_e('Twitter URL', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <input type="text" name="evnt_speaker_twitter" class="regular-text" value="<?php echo esc_attr($twitter); ?>">
            </td>
        </tr>

        <tr>
            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_speaker_facebook"><?php esc_html_e('Facebook URL', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <input type="text" name="evnt_speaker_facebook" class="regular-text" value="<?php echo esc_attr($facebook); ?>">
            </td>
        </tr>

    </table>

    <?php
}

// Save the Metabox Data

function evnt_save_meta_boxes($post_id) {

    global $post;

    // Verify nonce
    if (!isset($_POST['evnt_speaker_fields']) || !wp_verify_nonce($_POST['evnt_speaker_fields'], basename(__FILE__))) {
        return $post_id;
    }

    // Check Autosave
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
        return $post_id;
    }

    // Don't save if only a revision
    if (isset($post->post_type) && $post->post_type == 'revision') {
        return $post_id;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    $meta['evnt_speaker_title'] = ( isset($_POST['evnt_speaker_title']) ? esc_textarea($_POST['evnt_speaker_title']) : '' );

    $meta['evnt_speaker_linkedin'] = ( isset($_POST['evnt_speaker_linkedin']) ? esc_url($_POST['evnt_speaker_linkedin']) : '' );

    $meta['evnt_speaker_twitter'] = ( isset($_POST['evnt_speaker_twitter']) ? esc_url($_POST['evnt_speaker_twitter']) : '' );

    $meta['evnt_speaker_facebook'] = ( isset($_POST['evnt_speaker_facebook']) ? esc_url($_POST['evnt_speaker_facebook']) : '' );

    foreach ($meta as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}

add_action('save_post', 'evnt_save_meta_boxes', 10, 2);
?>
<?php
add_action('add_meta_boxes', 'evnt_add_header_image_metaboxes');

function evnt_add_header_image_metaboxes() {
    $post_types = array('post', 'page', 'speaker', 'class');

    foreach ($post_types as $post_type) {

        add_meta_box('header_image_metaboxes', esc_html__('Aditional page settings', 'evnt'), 'evnt_render_header_image_meta_boxes', $post_type, 'side', 'default');
    }
}

function evnt_render_header_image_meta_boxes($post) {

    $meta = get_post_custom($post->ID);
    $header_image_setting = !isset($meta['evnt_header_image_setting'][0]) ? '' : $meta['evnt_header_image_setting'][0];
    $header_widget_setting_setting = !isset($meta['evnt_header_widget_setting_setting'][0]) ? '' : $meta['evnt_header_widget_setting_setting'][0];
    wp_nonce_field(basename(__FILE__), 'evnt_header_image_settings');
    ?>

    <table class="form-table">

        <tr>
            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_header_image_setting"><?php esc_html_e('Disable Header Image', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <?php
                $header_image_setting_value = get_post_meta($post->ID, 'evnt_header_image_setting', true);
                if ($header_image_setting_value == "yes") {
                    $header_image_setting_checked = 'checked="checked"';
                } else {
                    $header_image_setting_checked = '';
                }
                ?>
                <input type="checkbox" name="evnt_header_image_setting" value="yes" <?php echo esc_attr($header_image_setting_checked); ?> />
                <p class="description"><?php esc_html_e('Disable/Enable Header Image', 'evnt'); ?></p>
            </td>
        </tr>
        <tr>

            <td class="evnt_meta_box_td" colspan="2">
                <label for="evnt_header_newsletter_widget_setting"><?php esc_html_e('Disable Footer bottom widgets', 'evnt'); ?>
                </label>
            </td>
            <td colspan="4">
                <?php
                $header_newsletter_widget_setting_value = get_post_meta($post->ID, 'evnt_header_newsletter_widget_setting', true);
                if ($header_newsletter_widget_setting_value == "yes") {
                    $header_newsletter_widget_setting_checked = 'checked="checked"';
                } else {
                    $header_newsletter_widget_setting_checked = '';
                }
                ?>
                <input type="checkbox" name="evnt_header_newsletter_widget_setting" value="yes" <?php echo esc_attr($header_newsletter_widget_setting_checked); ?> />
                <p class="description"><?php esc_html_e('Disable/Enable Footer bottom widgets', 'evnt'); ?></p>
            </td>
        </tr>

    </table>

    <?php
}

// Save the Metabox Data

function evnt_save_header_image_meta_boxes($post_id) {

    global $post;

    // Verify nonce
    if (!isset($_POST['evnt_header_image_settings']) || !wp_verify_nonce($_POST['evnt_header_image_settings'], basename(__FILE__))) {
        return $post_id;
    }
    // Check Autosave
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
        return $post_id;
    }

    // Don't save if only a revision
    if (isset($post->post_type) && $post->post_type == 'revision') {
        return $post_id;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    $meta['evnt_header_image_setting'] = ( isset($_POST['evnt_header_image_setting']) ? esc_textarea($_POST['evnt_header_image_setting']) : '' );
    $meta['evnt_header_newsletter_widget_setting'] = ( isset($_POST['evnt_header_newsletter_widget_setting']) ? esc_textarea($_POST['evnt_header_newsletter_widget_setting']) : '' );

    foreach ($meta as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}

add_action('save_post', 'evnt_save_header_image_meta_boxes', 10, 2); // save the custom fields



add_action('add_meta_boxes', 'evnt_speaker_parent_init');

function evnt_speaker_parent_init() {
    // Post types to insert the meta box. Adjust array <-------
    foreach (array('post', 'post', 'class') as $pt)
        add_meta_box(
                'evnt_speaker_parent_init', esc_html__('Select Speaker', 'evnt'), 'evnt_speaker_parent', $pt, 'side', 'high'
        );
}

add_action('admin_enqueue_scripts', 'evnt_speaker_parent_admin_style');

function evnt_speaker_parent_admin_style() {
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/wcs_templates/admin-style.css', false, '1.0.0');
}

function evnt_speaker_parent() {
    global $post, $typenow;

    // Get all posts of a type, excluding the current post
    $args = array(
        'post_type' => 'speaker',
        'orderby' => 'date',
        'order' => 'DESC',
        'numberposts' => -1,
        'offset' => 0,
    );
    $get_posts = get_posts($args);

    $saved = get_post_meta($post->ID, 'evnt_speaker_parent', true);
    // Security
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_wpse_94701');
    // Dropdown
    echo '<h4>Team leader</h4>';
    echo '<select name="evnt_speaker_parent" id="evnt_speaker_parent">
        <option value=" ">' . esc_html__('- Select -', 'evnt') . '</option>';
    foreach ($get_posts as $parent_post) {
        printf(
                '<option value="%d" %s> %s</option>', $parent_post->ID, selected($saved, $parent_post->ID, false), $parent_post->post_title
        );
    }
    echo '</select>';
    $saved_multiple[] = get_post_meta($post->ID, 'evnt_speaker_parent_multiple', true);

    function in_multiarray($elem, $array) {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while ($bottom <= $top) {
            if ($array[$bottom] == $elem)
                return true;
            else
            if (is_array($array[$bottom]))
                if (in_multiarray($elem, ($array[$bottom])))
                    return true;

            $bottom++;
        }
        return false;
    }

    echo '<h4>Rest of the team</h4>';
    foreach ($get_posts as $parent_post) {
        if (in_multiarray($parent_post->ID, $saved_multiple)) {
            $checkedmulti = 'checked="checked"';
            $value = $parent_post->post_title;
        } else {
            $checkedmulti = '';
            $value = '';
        }
        echo '<input type="checkbox" name="evnt_speaker_parent_multiple[]" value="' . $parent_post->ID . '"' . $checkedmulti . ' />' . $parent_post->post_title . '<br>';
        echo '<input type="hidden" name="evnt_speaker_parent_multiple_names[]" value="' . $value . '" />';
    }
}

add_action('save_post', 'evnt_save_meta_boxes2', 10, 2);

function evnt_save_meta_boxes2($post_id) {

    global $post;

    // Verify nonce
    if (!isset($_POST['noncename_wpse_94701']) || !wp_verify_nonce($_POST['noncename_wpse_94701'], plugin_basename(__FILE__))) {
        return $post_id;
    }

    // Check Autosave
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit'])) {
        return $post_id;
    }

    // Don't save if only a revision
    if (isset($post->post_type) && $post->post_type == 'revision') {
        return $post_id;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post->ID)) {
        return $post_id;
    }

    $meta['evnt_speaker_parent'] = ( isset($_POST['evnt_speaker_parent']) ? esc_textarea($_POST['evnt_speaker_parent']) : '' );
    $meta['evnt_speaker_parent_multiple'] = ( isset($_POST['evnt_speaker_parent_multiple']) ? $_POST['evnt_speaker_parent_multiple'] : array() );
    $meta['evnt_speaker_parent_multiple_names'] = ( isset($_POST['evnt_speaker_parent_multiple_names']) ? $_POST['evnt_speaker_parent_multiple_names'] : [] );

    $instructorsNames = array();
    $instructors = $meta['evnt_speaker_parent_multiple'];
    if (!empty($instructors)) {
        foreach ($instructors as $instructor) {
            $instructorsNames[] = get_the_title($instructor);
        }
    } else {
        $instructorsNames[] = get_the_title($meta['evnt_speaker_parent']);
    }
    wp_set_post_terms($post_id, $instructorsNames, "wcs-instructor", false);
    foreach ($meta as $key => $value) {
        update_post_meta($post->ID, $key, $value);
    }
}

//if (is_admin()) :
//
//    function evnt_pageparentdiv_remove_meta_boxes() {
//        remove_meta_box('pageparentdiv', 'page', 'side');
//    }
//
//    add_action('admin_menu', 'evnt_pageparentdiv_remove_meta_boxes');
//    endif;
    