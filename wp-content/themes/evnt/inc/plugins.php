<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'evnt_register_plugins');

/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function evnt_register_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name' => esc_html('WPBakery Visual Composer'), // The plugin name
            'slug' => 'js_composer',
            'source' => get_template_directory() . '/plugins/js_composer.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '5.1',
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => esc_html('Evnt Visual Composer Extensions'), // The plugin name
            'slug' => 'evnt-vc-extensions',
            'source' => get_template_directory() . '/plugins/evnt-vc-extensions.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.2.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => esc_html('Timetable Weekly Class Schedule'), // The plugin name
            'slug' => 'weekly-class',
            'source' => get_template_directory() . '/plugins/weekly-class.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '2.0.5.6',
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => esc_html('Speaker Custom Post Extension'), // The plugin name
            'slug' => 'speaker-custom-post-extension',
            'source' => get_template_directory() . '/plugins/speaker-custom-post-extension.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '0.9.9',
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => esc_html('WooCommerce'), // The plugin name
            'slug' => 'woocommerce',
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => 'One Click Demo Import',
            'slug' => 'one-click-demo-import',
            'required' => true,
        ),
        array(
            'name' => esc_html('Newsletter'), // The plugin name
            'slug' => 'newsletter',
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name' => esc_html('CMB2'),
            'slug' => 'cmb2',
            'required' => false,
        ),
        array(
            'name' => esc_html('Contact Form 7'),
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => esc_html('Easy Google Fonts'),
            'slug' => 'easy-google-fonts',
            'required' => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => 'evnt', // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_slug' => 'themes.php', // Default parent menu slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'dismissable' => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'strings' => array(
            'page_title' => esc_html__('Install Required Plugins', 'evnt'),
            'menu_title' => esc_html__('Install Plugins', 'evnt'),
            'installing' => esc_html__('Installing Plugin: %s', 'evnt'), // %1$s = plugin name
            'oops' => esc_html__('Something went wrong with the plugin API.', 'evnt'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'evnt'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'evnt'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'evnt'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'evnt'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'evnt'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'evnt'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'evnt'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'evnt'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'evnt'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'evnt'),
            'return' => esc_html__('Return to Required Plugins Installer', 'evnt'),
            'plugin_activated' => esc_html__('Plugin activated successfully.', 'evnt'),
            'complete' => esc_html__('All plugins installed and activated successfully. %s', 'evnt'), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa($plugins, $config);
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if (function_exists('vc_set_as_theme'))
    vc_set_as_theme();
