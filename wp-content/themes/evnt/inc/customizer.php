<?php

function evnt_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

add_action('customize_register', 'evnt_customize_register');

function evnt_customize_register($wp_customize) {

    /* Logo */

    $wp_customize->add_setting('evnt_theme_logo', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'evnt_theme_logo', array(
        'label' => esc_html__('Logo', 'evnt'),
        'section' => 'title_tagline',
        'settings' => 'evnt_theme_logo',
    )));

    $wp_customize->add_setting('evnt_logo_height', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '40',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_logo_height', array(
        'type' => 'input',
        'priority' => 10,
        'section' => 'title_tagline',
        'label' => esc_html__('Logo Height in Pixels', 'evnt'),
    ));



    /* Footer Section */

    $wp_customize->add_section('evnt_footer', array(
        'title' => esc_html__('Footer Settings', 'evnt'),
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ));

    /* Footer Text */

    $wp_customize->add_setting('evnt_footer_text', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => esc_html__('© 2016 Evnt - Responsive Event WordPress Theme', 'evnt'),
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_footer_text', array(
        'type' => 'textarea',
        'priority' => 10,
        'section' => 'evnt_footer',
        'label' => esc_html__('Footer Text', 'evnt'),
    ));

    /* Footer Columns #1 */

    $wp_customize->add_setting('evnt_footer_sidebar_1', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => 'col-sm-3',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_footer_sidebar_1', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'evnt_footer',
        'label' => esc_html__('Footer Sidebar Column 1', 'evnt'),
        'choices' => array(
            'col-sm-12' => 'full width',
            'col-sm-6' => '1/2',
            'col-sm-4' => '1/3',
            'col-sm-3' => '1/4',
            'disabled' => 'disabled',
        )
    ));

    /* Footer Columns #2 */

    $wp_customize->add_setting('evnt_footer_sidebar_2', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => 'col-sm-3',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_footer_sidebar_2', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'evnt_footer',
        'label' => esc_html__('Footer Sidebar Column 2', 'evnt'),
        'choices' => array(
            'col-sm-12' => 'full width',
            'col-sm-6' => '1/2',
            'col-sm-4' => '1/3',
            'col-sm-3' => '1/4',
            'disabled' => 'disabled',
        )
    ));

    /* Footer Columns #3 */

    $wp_customize->add_setting('evnt_footer_sidebar_3', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => 'col-sm-3',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_footer_sidebar_3', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'evnt_footer',
        'label' => esc_html__('Footer Sidebar Column 3', 'evnt'),
        'choices' => array(
            'col-sm-12' => 'full width',
            'col-sm-6' => '1/2',
            'col-sm-4' => '1/3',
            'col-sm-3' => '1/4',
            'disabled' => 'disabled',
        )
    ));

    /* Footer Columns #4 */

    $wp_customize->add_setting('evnt_footer_sidebar_4', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => 'col-sm-3',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control('evnt_footer_sidebar_4', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'evnt_footer',
        'label' => esc_html__('Footer Sidebar Column 4', 'evnt'),
        'choices' => array(
            'col-sm-12' => 'full width',
            'col-sm-6' => '1/2',
            'col-sm-4' => '1/3',
            'col-sm-3' => '1/4',
            'disabled' => 'disabled',
        )
    ));



    /* Colors */

    $wp_customize->add_setting('evnt_main_color', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '#be1a39',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control(
            new WP_Customize_Color_Control(
            $wp_customize, 'evnt_main_color', array(
        'label' => __('Main evnt color', 'jobseek'),
        'section' => 'colors',
        'settings' => 'evnt_main_color'
            )
    ));
    
//    hover colors
    
        $wp_customize->add_setting('evnt_main_color_hover', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '#e5405f',
        'transport' => 'refresh',
        'sanitize_callback' => 'evnt_sanitize_text',
    ));

    $wp_customize->add_control(
            new WP_Customize_Color_Control(
            $wp_customize, 'evnt_main_color_hover', array(
        'label' => __('Main hover evnt color', 'jobseek'),
        'section' => 'colors',
        'settings' => 'evnt_main_color_hover'
            )
    ));
    
//    $wp_customize->add_control('evnt_main_color', array(
//        'type' => 'select',
//        'priority' => 10,
//        'section' => 'colors',
//        'label' => esc_html__('Footer Sidebar Column 4', 'evnt'),
//        'choices' => array(
//            'col-sm-12' => 'full width',
//            'col-sm-6' => '1/2',
//            'col-sm-4' => '1/3',
//            'col-sm-3' => '1/4',
//            'disabled' => 'disabled',
//        )
//    ));
}

/* CSS
  ------------------------------------------------------------------------------------------------------------------- */

function evnt_customizer_css() {
    ?>
    <style type="text/css">

        body {
            color: <?php echo get_theme_mod('body_color', '#888'); ?>;
        }

        h1,
        .post-title a,
        .post-title a:hover {
            color: <?php echo get_theme_mod('h1_color', '#000'); ?>;
        }
        h2 {
            color: <?php echo get_theme_mod('h2_color', '#000'); ?>;
        }
        h3 {
            color: <?php echo get_theme_mod('h3_color', '#000'); ?>;
        }
        h4 {
            color: <?php echo get_theme_mod('h4_color', '#000'); ?>;
        }
        h5 {
            color: <?php echo get_theme_mod('h5_color', '#000'); ?>;
        }
        h6 {
            color: <?php echo get_theme_mod('h6_color', '#000'); ?>;
        }

        <?php
        $logo_height = get_theme_mod('evnt_logo_height', 40);

        if (!empty($logo_height)) {
            $header_height = $logo_height + 20;
            ?>
            #header #main-nav > li > a {
                height: <?php echo esc_html($header_height); ?>px;
                line-height: <?php echo esc_html($header_height); ?>px;
            }
            #logo a,
            #logo img { line-height: <?php echo esc_html($logo_height); ?>px; }
        <?php } ?>

        #header,
        #header-background {
            background-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }

        #header #main-nav li:hover ul {
            background-color: <?php echo get_theme_mod('dropdown_bg', '#12a0a9'); ?>;    		
        }

        #header #main-nav ul li.current-menu-item a,
        #header #main-nav ul li a:hover {
            background-color: <?php echo get_theme_mod('dropdown_state_bg', '#109098'); ?>;
        }

        h2::after,
        #reply-title::after,
        .btn-danger,
        .apply-with-facebook:hover,
        .apply-with-linkedin:hover,
        .apply-with-xing:hover,
        .work-experience .img-circle,
        .post .meta::after,
        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus,
        #cjfm-modalbox-login-form h3, #cjfm-modalbox-register-form h3
        {
            background-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        #content .sharedaddy ul li a,
        .cjfm-form .cjfm-btn,
        .popular .title {
            background-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?> !important;
        }
        .counter,
        .apply-with-facebook,
        .apply-with-linkedin,
        .apply-with-xing{
            border-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .flexmenu.fm-sm .navicon:after {    		
            border-top-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        a,
        .counter .description,
        .recent-blog-posts h5,
        .section-title h4,
        #title h4,
        .item-meta,
        .apply-with-facebook,
        .apply-with-linkedin,
        .apply-with-xing,
        h4.date,
        .meta i,
        .fa-stack,
        .pagination > li > a, .pagination > li > span,
        #loader i{
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }

        a:hover, a:active, a:focus {
            color: <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;
        }
        .btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger:active:hover, .btn-danger:active:focus {
            background-color: <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;    		
        }
        .vc_btn3.vc_btn3-color-danger, .vc_btn3.vc_btn3-color-danger.vc_btn3-style-flat {
            background-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .vc_btn3.vc_btn3-color-danger.vc_btn3-style-flat:focus,
        .vc_btn3.vc_btn3-color-danger.vc_btn3-style-flat:hover,
        .vc_btn3.vc_btn3-color-danger:focus,
        .vc_btn3.vc_btn3-color-danger:hover {
            background-color: <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?> !important;

        }

        #header #main-nav > li > a.cjfm-show-login-form,
        #header #main-nav > li > a.cjfm-show-register-form,
        #header #main-nav > li.user-nav > a {
            color: <?php echo get_theme_mod('user_nav_link_color', '#08474b'); ?>;
        }

        .color-alternative,
        .color-alternative a,
        .testimonials-carousel blockquote footer {
            color: <?php echo get_theme_mod('alt_body_color', '#fff'); ?>;
        }
        .color-alternative h1 {
            color: <?php echo get_theme_mod('alt_h1_color', '#fff'); ?>;
        }
        .color-alternative h2 {
            color: <?php echo get_theme_mod('alt_h2_color', '#000'); ?>;
        }
        .color-alternative h3 {
            color: <?php echo get_theme_mod('alt_h3_color', '#fff'); ?>;
        }
        .color-alternative h4 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .color-alternative h5,
        .color-alternative i.fa {
            color: <?php echo get_theme_mod('alt_h5_color', '#000'); ?>;
        }
        .color-alternative h6 {
            color: <?php echo get_theme_mod('alt_h6_color', '#fff'); ?>;
        }
        .color-alternative h2::after {
            background-color: <?php echo get_theme_mod('alt_body_color', '#fff'); ?>;
        }
    </style>
    <!--Evnt Main Color-->

    <style>
        .square {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .headings h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>; 
        }
        a {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .btn-primary {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        address:before,
        .phone:before,
        .email:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        ul.circles li span {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .wsmenu > ul > li:hover {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        #slider-content form {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        ul#countdown li {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }

        .service:hover .square:after {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speaker-credits i.fa {
            border: 1px solid <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers1 .speaker .flipper .front h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers2 .speaker .back .content .title {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers3 .row a:hover img {
            border: 5px solid <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers3 .row .info-box .content h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers3 .row .info-box footer ul li i {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers4 .speaker .hover:before {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .speakers4 .speaker .content h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule1 .row a:hover img {
            border: 5px solid <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule1 .row .info-box footer ul li i {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule2 .time:before,
        .schedule2 .venue:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule2 .content-box .trigger {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule2 .content-box h4 a:hover {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule2 .content-box .speaker:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule3 .table-bordered thead tr th:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule3 .table-bordered tbody tr th:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule3 .table-bordered tbody tr td.talk {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .schedule4 .day .date:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .schedule4 .day .row .date:before,
        .schedule4 .day .row .time:before,
        .schedule4 .day .row .subject:before,
        .schedule4 .day .row .speaker:before,
        .schedule4 .day .row .venue:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .schedule4 .day .row .subject a:hover {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .schedule4 .day .row .speaker a:hover {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .feature .text h6, .feature-mobile .text h6{
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .prices1 .pricetable h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices1 .pricetable .price sup,
        .prices1 .pricetable .price sub {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices1 .pricetable .discount {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices2 .pricetable h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices2 .pricetable .price sup,
        .prices2 .pricetable .price sub {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices2 .pricetable .discount {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices3 .pricetable h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices3 .pricetable .price {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices3 .pricetable .discount {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices4 .pricetable h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices4 .pricetable .price {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices4 .pricetable .discount {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices5 .pricetable h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices5 .pricetable .price {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .prices5 .pricetable .discount {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .nav-tabs li.active a,
        .nav-tabs li.active a:hover,
        .nav-tabs li.active a:focus {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
            border-bottom: 1px solid <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .sponsors1 ul li a:before {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .feature-box .fa {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .gallery a:before {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }
        .counter .number {
            border: 5px solid <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .progress-bar {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .woocommerce span.onsale {
            line-height: 2.8em;
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .woocommerce-message,
        .woocommerce-info {
            border-top-color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .woocommerce .woocommerce-info:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .woocommerce-MyAccount-navigation ul li a:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .post .image span {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .post .image:before {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .post .meta {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .post.featured:after {
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        #single-post .author h6 {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        #prefooter ul li a:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        #prefooter .widget.widget_address_widget a {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .footer ul li a:before {
            color: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;
        }
        .widget_search input.search-submit{
            background: <?php echo get_theme_mod('evnt_main_color', '#be1a39'); ?>;

        }

        /*hover*/
        a:hover {
            color:  <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;
        }

        .btn-primary:hover {
            background:  <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;
            color: #fff; 
        }
        .woocommerce #respond input#submit:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce input.button:hover {
            background:  <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;
        }
        .widget_search input.search-submit:hover {
            background:  <?php echo get_theme_mod('evnt_main_color_hover', '#e5405f'); ?>;
        }


    </style>


    <?php
}

add_action('wp_head', 'evnt_customizer_css');
