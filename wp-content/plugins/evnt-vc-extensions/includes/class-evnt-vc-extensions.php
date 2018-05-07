<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.coffeecreamthemes.com/
 * @since      1.0.0
 *
 * @package    Evnt_Vc_Extensions
 * @subpackage Evnt_Vc_Extensions/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Evnt_Vc_Extensions
 * @subpackage Evnt_Vc_Extensions/includes
 * @author     Coffeecream Themes <stanislawskiwaldemar@gmail.com>
 */
class Evnt_Vc_Extensions {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Evnt_Vc_Extensions_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->plugin_name = 'evnt-vc-extensions';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Evnt_Vc_Extensions_Loader. Orchestrates the hooks of the plugin.
     * - Evnt_Vc_Extensions_i18n. Defines internationalization functionality.
     * - Evnt_Vc_Extensions_Admin. Defines all hooks for the admin area.
     * - Evnt_Vc_Extensions_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-evnt-vc-extensions-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-evnt-vc-extensions-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-evnt-vc-extensions-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-evnt-vc-extensions-public.php';

        function my_plugin_init() {
            if (class_exists('WPBakeryVisualComposerAbstract')) {


                require_once plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/icons.php';

                function requireVcExtend() {
                    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/extend-vc.php';
                }

                add_action('init', 'requireVcExtend', 2);

                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/recent-blog-posts.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/hgroup.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/subtitle.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/sponsor-carousel.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/sponsor-grid.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/sponsor-carousel-item.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/sponsor-grid-item.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/progress-bar.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/progress-bar-item.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/map.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/map-item.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/countdown.php' ); //ws
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/counterup.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/counterup-item.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/testimonials-carousel.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/pricing-table.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/js-button.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/service_square.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/speaker_gallery.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/custom-contact-form-7.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/evnt_newsletter_form.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/feature.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/sitemap.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/contact-address.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/floor-plan.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/line.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/feature-box.php' );
                require_once( plugin_dir_path(dirname(__FILE__)) . 'public/vc_templates/gallery.php' );


                vc_remove_element("vc_button");
                vc_remove_element("vc_button2");
                vc_remove_element("vc_widget_sidebar");
                vc_remove_element("vc_wp_search");
                vc_remove_element("vc_wp_meta");
                vc_remove_element("vc_wp_recentcomments");
                vc_remove_element("vc_wp_calendar");
                vc_remove_element("vc_wp_pages");
                vc_remove_element("vc_wp_tagcloud");
                vc_remove_element("vc_wp_text");
                vc_remove_element("vc_wp_posts");
                vc_remove_element("vc_wp_links");
                vc_remove_element("vc_wp_categories");
                vc_remove_element("vc_wp_archives");
                vc_remove_element("vc_wp_rss");
                vc_remove_element("contact-form-7");
            }
        }

        add_action('plugins_loaded', 'my_plugin_init');



        $this->loader = new Evnt_Vc_Extensions_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Evnt_Vc_Extensions_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Evnt_Vc_Extensions_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Evnt_Vc_Extensions_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Evnt_Vc_Extensions_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Evnt_Vc_Extensions_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
