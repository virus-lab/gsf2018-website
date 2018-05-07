<?php


/**
 * Add an admin submenu link under Settings
 */
function evnt_add_options_submenu_page() {
    add_theme_page(
            'options-general.php', // admin page slug
            esc_html__('EVNT Options', 'evnt'), // page title
            esc_html__('EVNT Options', 'evnt'), // menu title
            'manage_options', // capability required to see the page
            'evnt_options', // admin page slug, e.g. options-general.php?page=evnt_options
            'evnt_options_page'            // callback function to display the options page
    );
}

//add_action('admin_menu', 'evnt_add_options_submenu_page');

/**
 * Register the settings
 */
function evnt_register_settings() {
    register_setting(
            'evnt_options', // settings section
            'evnt_number_widget_sponsor' // setting name
    );
}

//add_action('admin_init', 'evnt_register_settings');

/**
 * Build the options page
 */
function evnt_options_page() {
    if (!isset($_REQUEST['settings-updated']))
        $_REQUEST['settings-updated'] = false;
    ?>

    <div class="wrap">

        <?php if (false !== $_REQUEST['settings-updated']) : ?>
            <div class="updated fade"><p><strong><?php esc_html_e('EVNT Options saved!', 'evnt'); ?></strong></p></div>
        <?php endif; ?>

        <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

        <div id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <form method="post" action="options.php">
                        <?php settings_fields('evnt_options'); ?>
                        <?php $options = get_option('evnt_number_widget_sponsor'); ?>
                        <table class="form-table">
                            <tr valign="top"><th scope="row"><?php esc_html_e('Hide the post meta information on posts?', 'evnt'); ?></th>
                                <td>
                                    <br />
                                    <input name="evnt_number_widget_sponsor" id="evnt_number_widget_sponsor" value="<?php echo esc_attr($options); ?>">
                                    <label class="description" for="evnt_number_widget_sponsor"><?php esc_html_e('Toggles whether or not to display post meta under posts.', 'evnt'); ?></label>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="<?php echo esc_attr__('Submit', 'evnt') ?>">
                    </form>
                </div> <!-- end post-body-content -->
            </div> <!-- end post-body -->
        </div> <!-- end poststuff -->
    </div>
    <?php
}
