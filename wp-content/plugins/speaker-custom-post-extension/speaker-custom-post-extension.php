<?php
/*
  Plugin Name: Speaker Custom Post Extension
  Description: Add speaker custom posts extension
  Author: apropo8
  Version: 1.0
 */

function init_custom_post_types() {
    /**
     * speaker post type, speaker categories and speaker tags taxonomy registrations.
     */
    /* 1. speaker post type */

    $post_type = 'speaker';
    $post_category = 'speaker_category';
    $post_tag = 'speaker_tag';

    if (!post_type_exists($post_type)) {
        $options = get_option('speaker_settings');
        if (!$options['speaker_permalink']) {
            $options['speaker_permalink'] = "speaker";
        }
        $slug = sanitize_title($options['speaker_permalink']);
        $labels = array(
            'name' => __('Speaker', 'scpe'),
            'singular_name' => __('Speaker Item', 'scpe'),
            'add_new' => __('Add New Item', 'scpe'),
            'add_new_item' => __('Add New speaker Item', 'scpe'),
            'edit_item' => __('Edit speaker Item', 'scpe'),
            'new_item' => __('Add New speaker Item', 'scpe'),
            'view_item' => __('View Item', 'scpe'),
            'search_items' => __('Search speaker', 'scpe'),
            'not_found' => __('No speaker items found', 'scpe'),
            'not_found_in_trash' => __('No speaker items found in trash', 'scpe'),
        );

        $supports = array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
//        'comments',
            'author',
            'custom-fields',
            'revisions'
        );

        $args = array(
            'labels' => $labels,
            'supports' => $supports,
            'public' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => $slug),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-groups',
            'has_archive' => true,
        );

        register_post_type($post_type, $args);


        /* 2. speaker categories */

        $labels = array(
            'name' => __('Speaker Categories', 'scpe'),
            'singular_name' => __('Speaker Category', 'scpe'),
            'menu_name' => __('Speaker Categories', 'scpe'),
            'edit_item' => __('Edit speaker Category', 'scpe'),
            'update_item' => __('Update speaker Category', 'scpe'),
            'add_new_item' => __('Add New speaker Category', 'scpe'),
            'new_item_name' => __('New speaker Category Name', 'scpe'),
            'parent_item' => __('Parent speaker Category', 'scpe'),
            'parent_item_colon' => __('Parent speaker Category:', 'scpe'),
            'all_items' => __('All speaker Categories', 'scpe'),
            'search_items' => __('Search speaker Categories', 'scpe'),
            'popular_items' => __('Popular speaker Categories', 'scpe'),
            'separate_items_with_commas' => __('Separate speaker categories with commas', 'scpe'),
            'add_or_remove_items' => __('Add or remove speaker categories', 'scpe'),
            'choose_from_most_used' => __('Choose from the most used speaker categories', 'scpe'),
            'not_found' => __('No speaker categories found.', 'scpe'),
        );

        $args = array(
            'labels' => $labels,
            'supports' => false,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => $post_category),
            'show_admin_column' => true,
            'query_var' => true,
        );

        register_taxonomy($post_category, $post_type, $args);

        /* 2. speaker tags */

        $labels = array(
            'name' => __('Speaker Tags', 'scpe'),
            'singular_name' => __('Speaker Tag', 'scpe'),
            'menu_name' => __('Speaker Tags', 'scpe'),
            'edit_item' => __('Edit speaker Tag', 'scpe'),
            'update_item' => __('Update speaker Tag', 'scpe'),
            'add_new_item' => __('Add New speaker Tag', 'scpe'),
            'new_item_name' => __('New speaker Tag Name', 'scpe'),
            'parent_item' => __('Parent speaker Tag', 'scpe'),
            'parent_item_colon' => __('Parent speaker Tag:', 'scpe'),
            'all_items' => __('All speaker Tags', 'scpe'),
            'search_items' => __('Search speaker Tags', 'scpe'),
            'popular_items' => __('Popular speaker Tags', 'scpe'),
            'separate_items_with_commas' => __('Separate speaker tags with commas', 'scpe'),
            'add_or_remove_items' => __('Add or remove speaker tags', 'scpe'),
            'choose_from_most_used' => __('Choose from the most used speaker tags', 'scpe'),
            'not_found' => __('No speaker tags found.', 'scpe'),
        );

        $args = array(
            'labels' => $labels,
            'supports' => false,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'hierarchical' => false,
            'rewrite' => array('slug' => $post_tag),
            'show_admin_column' => true,
            'query_var' => true,
        );

        register_taxonomy($post_tag, $post_type, $args);
    }


    add_action('admin_menu', 'speaker_add_admin_menu');
    add_action('admin_init', 'speaker_settings_init');

    function speaker_add_admin_menu() {

        add_submenu_page('edit.php?post_type=speaker', 'Speaker Custom Post Extension', 'Settings', 'manage_options', 'speaker_custom_post_extension', 'speaker_options_page');
    }

    function speaker_settings_init() {

        register_setting('speaker_settings_page', 'speaker_settings');

        add_settings_section(
                'speaker_speaker_settings_page_section', __('Set permalink', 'scpe'), 'speaker_settings_section_callback', 'speaker_settings_page'
        );

        add_settings_field(
                'speaker_permalink', __('Permalink', 'scpe'), 'speaker_permalink_render', 'speaker_settings_page', 'speaker_speaker_settings_page_section'
        );
    }

    function speaker_permalink_render() {

        $options = get_option('speaker_settings');
        if (!$options['speaker_permalink']) {
            $options['speaker_permalink'] = "speaker";
        }
        ?>
        <input type='text' name='speaker_settings[speaker_permalink]' value='<?php echo $options['speaker_permalink']; ?>'>
        <?php
    }

    function speaker_settings_section_callback() {

        echo __('After change this please got to Settings >> Permalinks and seve it again ', 'scpe');
    }

    function speaker_options_page() {
        ?>
        <form action='options.php' method='post'>

            <h2>Speaker Custom Post Extension Settings</h2>

            <?php
            settings_fields('speaker_settings_page');
            do_settings_sections('speaker_settings_page');
            submit_button();
            ?>

        </form>
        <?php
    }

}

add_action('init', 'init_custom_post_types');
?>
