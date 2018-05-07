<?php
/* Theme setup
  ------------------------------------------------------------------------------------------------------------------- */
define("EVNT_WIDGET_FIELDS_SPONSOR_NUMBER", 15);

function evnt_related_post_get_the_excerpt($post_id) {
    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    $output = get_the_excerpt();
    $post = $save_post;
    return $output;
}

/**
 * @uses WP_Query
 * @uses get_queried_object()
 * @see get_the_ID()
 * @return int
 */
function evnt_get_the_post_id() {
    if (in_the_loop()) {
        $post_id = get_the_ID();
    } else {
        global $wp_query;
        $post_id = $wp_query->get_queried_object_id();
    }
    return $post_id;
}

if (!function_exists('evnt_setup')) :

    function evnt_setup() {

        if (!isset($content_width)) {
            $content_width = 1140;
        }

        add_theme_support('automatic-feed-links');

        $args = array(
            'default-color' => 'ffffff'
        );
        add_theme_support('custom-background', $args);

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support('woocommerce');

        update_option('evnt_thumbnail_size_w', 360);
        update_option('evnt_thumbnail_size_h', 600);
        update_option('evnt_thumbnail_crop', 0);

        add_image_size('evnt_blog', 750, 9999, false);
        add_image_size('evnt_gallery', 475, 356, true);
        add_image_size('evnt_testimonial', 140, 140, true);

        register_nav_menus(array(
            'primary' => esc_html__('Main Menu', 'evnt'),
        ));

// Enable support for HTML5 markup.
        add_theme_support('html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        ));
    }

endif; // evnt_setup

add_action('after_setup_theme', 'evnt_setup');


/* Main menu fallback
  ------------------------------------------------------------------------------------------------------------------- */

function evnt_menu_fallback() {
    echo( '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add a menu', 'evnt') . '</a></li>' );
}

/* Check user role
  ------------------------------------------------------------------------------------------------------------------- */

function evnt_check_user_role($role, $user_id = null) {

    if (is_numeric($user_id)) {
        $user = get_userdata($user_id);
    } else {
        $user = wp_get_current_user();
    }

    if (empty($user))
        return false;

    return in_array($role, (array) $user->roles);
}

function evnt_fonts_url() {
    $font_url = '';
    /*
      Translators: If there are characters in your language that are not supported
      by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== esc_html_x('on', 'Google font: on or off', 'evnt')) {
        $font_url = add_query_arg('family', urlencode('Lato:400,400italic,700,700italic|Economica:700'), "//fonts.googleapis.com/css");
    }
    return $font_url;
}

/* Enqueue CSS and JS
  ------------------------------------------------------------------------------------------------------------------- */

function coffeecream_enqueue($hook) {
    wp_enqueue_style('admin-styles', get_theme_file_uri('/admin/css/admin.css'));

    wp_enqueue_script('admin-js', get_theme_file_uri('/admin/js/admin.js'));
}

add_action('admin_enqueue_scripts', 'coffeecream_enqueue');

function evnt_scripts() {
    /* Fonts */

    wp_enqueue_style('evnt-fonts', evnt_fonts_url(), array(), '1.0.0');
    /* === CSS ==== */

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

    wp_enqueue_style('superslides', get_template_directory_uri() . '/css/superslides.css');

    wp_enqueue_style('uber-google-maps', get_template_directory_uri() . '/css/uber-google-maps.css');

    wp_enqueue_style('webslidemenu', get_template_directory_uri() . '/css/webslidemenu.css');

    wp_enqueue_style('lightgallery', get_template_directory_uri() . '/css/lightgallery.css');

    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css');

    wp_enqueue_style('evnt-style', get_stylesheet_uri());


    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// check for plugin using plugin name
    if (!class_exists('Easy_Google_Fonts')) {
        $query_args = array(
            'family' => 'Lato:400,700|Montserrat:700'
        );
        wp_enqueue_style('google_fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);
    }

    /* === JS ==== */

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('superslides', get_template_directory_uri() . '/js/superslides.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('webslidemenu', get_template_directory_uri() . '/js/webslidemenu.js', 'jquery', '1.0', true);

    wp_enqueue_script('countdown', get_template_directory_uri() . '/js/countdown.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('mason', get_template_directory_uri() . '/js/mason.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('lightgallery', get_template_directory_uri() . '/js/lightgallery.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('counterup', get_template_directory_uri() . '/js/counterup.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('bootstrap-progressbar', get_template_directory_uri() . '/js/bootstrap-progressbar.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('uber-google-maps', get_template_directory_uri() . '/js/uber-google-maps.min.js', 'jquery', '1.0', true);

    wp_enqueue_script('matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', 'jquery', '1.0', true);

    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', 'jquery', '1.0', true);

    wp_dequeue_style('jquery-ui-style');
}

add_action('wp_enqueue_scripts', 'evnt_scripts');




/* Register Widgetized Locations
  ------------------------------------------------------------------------------------------------------------------- */

add_action('widgets_init', 'evnt_widgets_init');

function evnt_widgets_init() {

// Register widgetized locations
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => esc_html__('Footer Sidebar 1', 'evnt'),
            'id' => 'evnt_footer-sidebar-1',
            'description' => esc_html__('This is first widget area 1/4 of the footer. Default width is 1/4. Width can be change  at the Customizer >>
Footer Settings', 'evnt'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Footer Sidebar 2', 'evnt'),
            'id' => 'evnt_footer-sidebar-2',
            'description' => esc_html__('This is second widget area 1/4 of the footer. Default width is 1/4. Width can be change  at the Customizer >>
Footer Settings', 'evnt'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Footer Sidebar 3', 'evnt'),
            'id' => 'evnt_footer-sidebar-3',
            'description' => esc_html__('This is third widget area 1/4 of the footer. Default width is 1/4. Width can be change  at the Customizer >>
Footer Settings', 'evnt'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Footer Sidebar 4', 'evnt'),
            'id' => 'evnt_footer-sidebar-4',
            'description' => esc_html__('This is fourth widget area 1/4 of the footer. Default width is 1/4. Width can be change  at the Customizer >>
Footer Settings', 'evnt'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Footer bottom widgets', 'evnt'),
            'id' => 'evnt_footer-bottom',
            'description' => esc_html__('This a widget area for newsletter and sponsors carousel widget.', 'evnt'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
        register_sidebar(array(
            'name' => esc_html__('Footer social links', 'evnt'),
            'id' => 'evnt_footer_social',
            'description' => esc_html__('This is default widget area for social links.', 'evnt'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ));
    }
}

/* Plugins installation
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/plugins.php';

/* Meta Fields
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/meta-fields.php';

/* Customizer
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/customizer.php';


/* Bootstrap Pagination
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/wp_bootstrap_pagination.php';

/* Social Profiles Widget
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/social-profiles-widget.php';

/* Address Information Widget
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/address-information-widget.php';

/* Subscription Widget
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/subscription-widget.php';

/* Sponsors Widget
  ------------------------------------------------------------------------------------------------------------------- */

require get_template_directory() . '/inc/sponsors_widget.php';


/* Metaboxes 
 * ------------------------------------------------------------------------------------------------------------
 */
require get_template_directory() . '/inc/metaboxes.php';


/* evnt_walker_nav_menu 
 * ------------------------------------------------------------------------------------------------------------
 */
require get_template_directory() . '/inc/evnt_walker_nav_menu.php';


/* Excerpt Length
  ------------------------------------------------------------------------------------------------------------------- */

function evnt_custom_excerpt_length($length) {
    return 34;
}

add_filter('excerpt_length', 'evnt_custom_excerpt_length', 999);

/* Comments Layout
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('evnt_comment')) {

    function evnt_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) {
            case 'pingback' :
            case 'trackback' :
// Display trackbacks differently than normal comments 
                ?>
                <div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="pingback">
                        <p><?php esc_html_e('Pingback:', 'evnt'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'evnt'), '<span class="edit-link">', '</span>'); ?></p>
                    </article>
                    <?php
                    break;
                default :
                    // Proceed with normal comments.
                    global $post;
                    ?>
                    <div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                        <article id="comment-<?php comment_ID(); ?>" class="comment">
                            <div class="media">
                                <div class="media-left">
                                    <a href="<?php echo esc_url(comment_author_url()); ?>"><?php
                                        echo get_avatar($comment, 60);
                                        ?>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <?php echo comment_author(); ?>  <?php
                                        comment_reply_link(
                                                array_merge($args, array('reply_text' =>
                                            '<i class="fa fa-reply"></i>',
                                            'depth' => $depth,
                                            'max_depth' => $args['max_depth'])));
                                        edit_comment_link(esc_html__('Edit', 'evnt'));
                                        ?>
                                    </h5>
                                    <p><?php comment_text(); ?></p>
                                </div>
                            </div>
                        </article>
                        <?php
                        break;
                }
            }

        }

        /* Comment Field
          ------------------------------------------------------------------------------------------------------------------- */

        function evnt_comment_form_field_comment($field) {

            $field = '<div class="form-group comment-form-comment"><textarea class="form-control" placeholder="' . esc_html_e('Comment *', 'evnt') . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';

            return $field;
        }

        add_action('comment_form_field_comment', 'evnt_comment_form_field_comment');

        /* Excerpt More Symbol
          ------------------------------------------------------------------------------------------------------------------- */

        function evnt_excerpt_more($more) {
            return '&hellip;';
        }

        add_filter('excerpt_more', 'evnt_excerpt_more');


        /* Move Jetpack Share
          ------------------------------------------------------------------------------------------------------------------- */

        function evnt_jptweak_remove_share() {
            remove_filter('the_content', 'sharing_display', 19);
            remove_filter('the_excerpt', 'sharing_display', 19);
            if (class_exists('Jetpack_Likes')) {
                remove_filter('the_content', array(Jetpack_Likes::init(), 'post_likes'), 30, 1);
            }
        }

        add_action('loop_start', 'evnt_jptweak_remove_share');

        /* Set homepage, blog page and menus after import
          ------------------------------------------------------------------------------------------------------------------- */

        function evnt_ocdi_import_files() {
            return array(
                array(
                    'import_file_name' => 'Evnt Demo',
                    'local_import_file' => trailingslashit(get_template_directory()) . 'demo-data/content.xml',
                    'local_import_widget_file' => trailingslashit(get_template_directory()) . 'demo-data/widgets.wie',
                    'local_import_customizer_file_url' => trailingslashit(get_template_directory()) . 'demo-data/evnt.dat',
                )
            );
        }

        add_filter('pt-ocdi/import_files', 'evnt_ocdi_import_files');

        function evnt_ocdi_after_import_setup() {
            // Assign menus to their locations.
            $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

            set_theme_mod('nav_menu_locations', array(
                'main-menu' => $main_menu->term_id,
                    )
            );

            // Assign front page and posts page (blog page).
            $front_page_id = get_page_by_title('Home');
            $blog_page_id = get_page_by_title('Blog');

            update_option('show_on_front', 'page');
            update_option('page_on_front', $front_page_id->ID);
            update_option('page_for_posts', $blog_page_id->ID);
        }

        add_action('pt-ocdi/after_import', 'evnt_ocdi_after_import_setup');

//        function evnt_after_import() {
//            // Use a static front page
//            $about = get_page_by_title('Home');
//            update_option('page_on_front', $about->ID);
//            update_option('show_on_front', 'page');
//
//            // Set the blog page
//            $blog = get_page_by_title('Blog');
//            update_option('page_for_posts', $blog->ID);
//        }
//
//        add_action('import_end', 'evnt_after_import');

        /* Custom Hheader */
        $args = array(
            'width' => 980,
            'height' => 280,
            'default-image' => get_template_directory_uri() . '/images/slider1.jpg',
        );
        add_theme_support('custom-header', $args);
        define('NO_HEADER_TEXT', true);

        function evnt_custom_post_type_args($args, $post_type) {
            if ($post_type == "class") {

                $args['query_var'] = true;
                $args['publicly_queryable'] = true;
            }

            return $args;
        }

        add_filter('register_post_type_args', 'evnt_custom_post_type_args', 20, 2);

        add_filter('body_class', 'evnt_browser_body_class');

        function evnt_browser_body_class($classes = '') {
            $header_image_setting_value = get_post_meta(evnt_get_the_post_id(), 'evnt_header_image_setting', true);
            if ($header_image_setting_value == "yes") {
                $classes[] = 'noHeadImage';
            } else {
                $classes[] = '';
            }
            return $classes;
        }

        add_action('admin_menu', 'evnt_admin_menu_instructors');

        function evnt_admin_menu_instructors() {
            remove_submenu_page('edit.php?post_type=class', 'edit-tags.php?taxonomy=wcs-instructor&amp;post_type=class');
        }

        remove_filter('wcs_views', 'wcs_register_views');
        add_filter('wcs_views', 'wcs_register_views_custom');

        function wcs_register_views_custom($views) {
            $views[] = array(
                'value' => 0,
                'title' => __('Plain List', 'WeeklyClass'),
                'icon' => 'ti-layout-list-post',
                'slug' => 'list-plain'
            );
            $views[] = array(
                'value' => 1,
                'title' => __('Compact List', 'WeeklyClass'),
                'icon' => 'ti-view-list',
                'slug' => 'list-compact'
            );
            $views[] = array(
                'value' => 2,
                'title' => __('Large List', 'WeeklyClass'),
                'icon' => 'ti-view-list-alt',
                'slug' => 'list-large'
            );
            $views[] = array(
                'value' => 3,
                'title' => __('Weekly Schedule', 'WeeklyClass'),
                'icon' => 'ti-calendar',
                'slug' => 'weekly-schedule',
                'mixins' => 'wcs_timetable_weekly_mixins'
            );
            $views[] = array(
                'value' => 4,
                'title' => __('Weekly Tabs', 'WeeklyClass'),
                'icon' => 'ti-layout-tab',
                'slug' => 'weekly-tabs',
                'mixins' => 'wcs_timetable_weekly_tabs_mixins'
            );
            $views[] = array(
                'value' => 5,
                'title' => __('Daily Agenda', 'WeeklyClass'),
                'icon' => 'ti-layout-list-thumb-alt',
                'slug' => 'daily-agenda'
            );
            $views[] = array(
                'value' => 6,
                'title' => __('Events Carousel', 'WeeklyClass'),
                'slug' => 'carousel',
                'icon' => 'ti-layout-column3',
                'filters' => false,
                'mixins' => 'wcs_carousel_mixin'
            );
            $views[] = array(
                'value' => 7,
                'title' => __('Masonry Grid', 'WeeklyClass'),
                'icon' => 'ti-layout-grid4-alt',
                'slug' => 'grid',
                'filters_template' => 'grid',
                'mixins' => 'wcs_timetable_isotope_mixins'
            );
            $views[] = array(
                'value' => 8,
                'title' => __('Timeline', 'WeeklyClass'),
                'icon' => 'ti-split-h',
                'slug' => 'timeline',
                'filters' => false,
                'mixins' => 'wcs_timetable_timeline_mixins'
            );
            $views[] = array(
                'value' => 9,
                'title' => __('Monthly Schedule (beta)', 'WeeklyClass'),
                'icon' => 'ti-calendar',
                'slug' => 'monthly-schedule',
                'mixins' => 'wcs_timetable_monthly_mixins'
            );
            $views[] = array(
                'value' => 10,
                'title' => __('Countdown', 'WeeklyClass'),
                'icon' => 'ti-timer',
                'slug' => 'countdown',
                'single' => true,
                'filters' => false,
                'mixins' => 'wcs_timetable_countdown'
            );
            $views[] = array(
                'value' => 11,
                'title' => __('Cover', 'WeeklyClass'),
                'icon' => 'ti-bookmark-alt',
                'slug' => 'cover',
                'single' => true,
                'filters' => false,
                'mixins' => 'wcs_timetable_cover'
            );
            $views[] = array(
                'value' => 12,
                'title' => __('Monthly Calendar', 'WeeklyClass'),
                'icon' => 'ti-layout-slider',
                'slug' => 'monthly-calendar',
                'mixins' => 'wcs_mixins_monthly_calendar',
                'filters' => true,
            );
            $views[] = array(
                'value' => 13,
                'title' => __('Schedule1', 'WeeklyClass'),
                'icon' => 'ti-view-list-alt',
                'slug' => 'schedule1'
            );
            $views[] = array(
                'value' => 14,
                'title' => __('Schedule2', 'WeeklyClass'),
                'icon' => 'ti-view-list-alt',
                'slug' => 'schedule2'
            );
            $views[] = array(
                'value' => 15,
                'title' => __('Schedule3', 'WeeklyClass'),
                'icon' => 'ti-view-list-alt',
                'slug' => 'schedule4'
            );

            return $views;
        }
        