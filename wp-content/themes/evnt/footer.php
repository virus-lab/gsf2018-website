<footer id="footer"><?php
    $footer_sidebars = array();

    $footer_sidebar_1 = get_theme_mod('evnt_footer_sidebar_1', 'col-sm-3');
    $footer_sidebar_2 = get_theme_mod('evnt_footer_sidebar_2', 'col-sm-3');
    $footer_sidebar_3 = get_theme_mod('evnt_footer_sidebar_3', 'col-sm-3');
    $footer_sidebar_4 = get_theme_mod('evnt_footer_sidebar_4', 'col-sm-3');
    $footer_bottom = get_theme_mod('evnt_footer_bottom', '');


    if ($footer_bottom != 'disabled' || $footer_sidebar_1 != 'disabled' || $footer_sidebar_2 != 'disabled' || $footer_sidebar_3 != 'disabled' || $footer_sidebar_4 != 'disabled') {
        ?>
        <?php
        $header_newsletter_widget_setting_value = get_post_meta(evnt_get_the_post_id(), 'evnt_header_newsletter_widget_setting', true);
        if ($header_newsletter_widget_setting_value != "yes") {

            if ($footer_bottom != 'disabled') {
                echo('<div class="' . $footer_bottom . '">');
                if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer-bottom'))
                    ;
                echo('</div>');
            }
        }
        ?>
        <div id="prefooter">
            <div class="container">
                <div class="row">

                    <?php
                    if ($footer_sidebar_1 != 'disabled') {
                        echo('<div class="' . $footer_sidebar_1 . '">');
                        if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer-sidebar-1'))
                            ;
                        echo('</div>');
                    }
                    ?>

                    <?php
                    if ($footer_sidebar_2 != 'disabled') {
                        echo('<div class="' . $footer_sidebar_2 . '">');
                        if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer-sidebar-2'))
                            ;
                        echo('</div>');
                    }
                    ?>

                    <?php
                    if ($footer_sidebar_3 != 'disabled') {
                        echo('<div class="' . $footer_sidebar_3 . '">');
                        if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer-sidebar-3'))
                            ;
                        echo('</div>');
                    }
                    ?>

                    <?php
                    if ($footer_sidebar_1 != 'disabled') {
                        echo('<div class="' . $footer_sidebar_4 . '">');
                        if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer-sidebar-4'))
                            ;
                        echo('</div>');
                    }
                    ?>

                </div>
            </div>
        </div><?php
    }

    $footer_sidebars = array();

    $footer_social = get_theme_mod('evnt_footer_social', 'col-sm-12');

    $allowed_html_array = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    );
//if( $footer_social != 'disabled' ) { 
    $footer_text = get_theme_mod('evnt_footer_text', wp_kses( __( '&copy; 2016 Evnt - Responsive Event WordPress Theme<br>Designed &amp; Developed by <a href="http://themeforest.net/user/Coffeecream" target="_blank">Coffeecream Themes</a>', 'evnt'), $allowed_html_array));

    if (!empty($footer_text)) {
        ?>
        <div class="credits">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12"><?php echo wp_kses(ent2ncr($footer_text), 'evnt'); ?>
                        <?php
                        if ($footer_social != 'disabled') {
                            if (function_exists('dynamic_sidebar') && dynamic_sidebar('evnt_footer_social'))
                                ;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</footer>
</div>

<?php wp_footer(); ?>
</div>
</body>
</html>
