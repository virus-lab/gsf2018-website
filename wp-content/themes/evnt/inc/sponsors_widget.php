<?php
# -*- coding: utf-8 -*-
/* Plugin Name: Sponsors Widget */

add_action('widgets_init', array('Sponsors_Widget', 'register'));

class Sponsors_Widget extends WP_Widget {

    public function evnt_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_style('sponsors_widget', get_template_directory_uri() . '/inc/sponsors_widget.css');
        wp_enqueue_script('evnt_custom', get_template_directory_uri() . '/inc/sponsors_widget.js', array('jquery'));
    }

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'evnt_scripts'));
        parent::__construct(strtolower(__CLASS__), 'Sponsors Widget');
    }

    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
//        wp_enqueue_script( 'sponsors_widget', get_template_directory_uri() . '/js/sponsors_widget.js', 'jquery', '1.0', true);

        $columns = isset($instance['columns']) ? $instance['columns'] : '6';
        $columns = esc_attr($columns);
        $autoplay = isset($instance['autoplay']) ? $instance['autoplay'] : 'false';
        $title = "";
        $defaults = array(
            'background_color' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }

        $widget_type = "";
        if (isset($instance['widget_type'])) {
            $widget_type = $instance['widget_type'];
        }
        ?>
        <div>

            <?php
            $allowed_html_array = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            );


            printf(wp_kses(__('<p>Max Sponsor Widget Items %1$s. You can change this in function.php via "EVNT_WIDGET_FIELDS_SPONSOR_NUMBER" definition</p><br /><br /><br />', 'evnt'), $allowed_html_array), EVNT_WIDGET_FIELDS_SPONSOR_NUMBER
            );

            printf(
                    '<label for="%1$s">%2$s</label>
            <input type="text" name="%3$s" id="%1$s" value="%4$s" class="widefat">
            <p class="help-block"> Accepted values: true, false, or time in milliseconds like 5000, which will be 5 seconds.</p>', $this->get_field_id('autoplay'), esc_attr_e('Autoplay time', 'evnt'), $this->get_field_name('autoplay'), $autoplay
            );
            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('background_color')); ?>"><?php esc_html_e('Background Color', 'evnt'); ?></label>
            </p>
            <p>
                <input class="sponsor-widget-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id('background_color')); ?>" name="<?php echo esc_attr($this->get_field_name('background_color')); ?>" value="<?php echo esc_attr($instance['background_color']); ?>" />                            
            </p>
        <?php
        printf('<p><label for="%1$s">%2$s</label><br />
            <input type="number" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('columns'), esc_html__('Columns number', 'evnt'), $this->get_field_name('columns'), $columns
        );
        $upload_next_btn = "";
        $addmore = "";

        $widid = $this->id;
        $inc = 1;


        for ($items = 0; $items < EVNT_WIDGET_FIELDS_SPONSOR_NUMBER; $items++) {
            $widname = "ev" . $items;
            $image_url = "";
            $link = "";
            $target = "";

            if (isset($instance["image_" . $widname])) {
                $image_url = $instance["image_" . $widname];
            }
            if (isset($instance["link_" . $widname])) {
                $link = $instance["link_" . $widname];
            }
            if (isset($instance["target_" . $widname])) {
                $target = $instance["target_" . $widname];
            }
            if (empty($image_url) AND empty($addmore)) {
                $addmore = $widname;
            }
            $fis = $items + 1;
            $upload_next_btn = "ev" . $fis;
            ?>
                <div class="upload_file_<?php echo esc_attr($widid . '' . $widname) ?> <?php echo ($inc == 1 || !empty($image_url) ) ? 'show_it' : 'hide_it' ?>">
                <?php
                printf('<hr>
                <div class="upload-file-container upload_btn-%3$s%4$s" >
                        <input data-show_next_btn="%2$s" data-widid="%3$s" data-widname="%4$s" type="button" class="evnt_upload_image button-primary button" value="' . esc_attr__('Upload image', 'evnt') . '">
                    </div>  
                    <div class="evnt-button-attribute %3$s%4$s %2$s">
                    <div id="sponsor-image_%3$s%4$s" class="hide_it sponsor-image_%3$s%4$s" >
                        <figure class="upload-thumb" style="position: relative; left: 0; top: 0;">
                            <img src="%6$s" class="uploaded_img %3$s%4$s" alt="image" />
                            <img class="delete" data-val="%3$s%4$s" src="' . esc_url(get_template_directory_uri()) . '/images/uploader-icons-x.png" alt="delete"  />
                            <input class="%3$s%4$s" type="hidden" name="%7$s" id="%8$s"  value="%6$s">
                        </figure> 
                    </div> 

                    <div class="evnt-link upload-link">
                        <label>' . esc_html__('Link to sponsor site', 'evnt') . '</label><br />
                        <input type="url" name="%10$s" id="%9$s"  value="%11$s">
                    </div></div>'
                        , ($inc == 1 || !empty($image_url) ) ? 'show_it' : 'hide_it', $upload_next_btn, $widid, $widname, (!empty($image_url)) ? "show_it" : "hide_it", esc_url($image_url), $this->get_field_name("image_" . $widname), $this->get_field_id("image_" . $widname), $this->get_field_id("link_" . $widname), $this->get_field_name("link_" . $widname), $link
                );
                ?>
                </div>

            <?php
            ++$inc;
        }

        if ($addmore) {
            ?>
                <a href="<?php echo esc_js('javascript:void(0);'); ?>" class="button evnt_addmore" data-widid="<?php echo esc_attr($widid); ?>" data-nextbtn="<?php echo esc_attr($addmore); ?>" ><?php echo esc_html__('Add More', 'evnt') ?></a>  
            <?php } ?>
            <style>.show_it{display:block; } .hide_it{display:none;}</style>
        </div>   
        <?php
    }

    public function update($new_instance, $old_instance) {
        wp_enqueue_script('evnt_custom', get_template_directory_uri() . '/inc/sponsors_widget.js', array('jquery'));
        $instance = array();
        $instance['columns'] = (!empty($new_instance['columns']) ) ? $new_instance['columns'] : '';
        $instance['autoplay'] = (!empty($new_instance['autoplay']) ) ? $new_instance['autoplay'] : '';
        $instance['background_color'] = (!empty($new_instance['background_color']) ) ? $new_instance['background_color'] : '';
        for ($items = 0; $items < EVNT_WIDGET_FIELDS_SPONSOR_NUMBER; $items++) {
            $widname = "ev" . $items;
            $instance["image_" . $widname] = (!empty($new_instance["image_" . $widname]) ) ? $new_instance["image_" . $widname] : '';
            $instance["link_" . $widname] = (!empty($new_instance["link_" . $widname]) ) ? $new_instance["link_" . $widname] : '';
            $instance["target_" . $widname] = (!empty($new_instance["target_" . $widname]) ) ? $new_instance["target_" . $widname] : '';
        }

        return $instance;
    }

    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance, $tag = "div") {
        wp_enqueue_script('owl-carousel');
        print $args['before_widget'];
        $el_class = ' ';
        $autoplay = $instance['autoplay'] ? $instance['autoplay']  : 'false';
        if ($autoplay != 'false') {
            $autoplay = ' data-autoplay="' . $autoplay . '"';
        } else {
            $autoplay = '';
        }
        $columns = $instance['columns'] ? $instance['columns'] : '6';
        $navs = 'false';
        $background_color = $instance['background_color'] ? $instance['background_color'] : '#f1f0ec';

        print '<div class="sponsors"> '
                . '<div class="container">'
                . '<div class="sponsors  sponsor-carousel owl-carousel' . $el_class . '" data-columns="' . $columns . '" data-navs="' . $navs . '" ' . $autoplay . '>';

        for ($items = 0; $items < EVNT_WIDGET_FIELDS_SPONSOR_NUMBER; $items++) {
            $widname = "ev" . $items;
            $image_url = $instance["image_" . $widname];
            $linkImage = esc_url($instance["link_" . $widname]);

            if (!empty($image_url)) {

                print '<div>';
                if (!empty($linkImage)) {
                    print'<a target="_blank" href="' . esc_url($linkImage) . '">';
                }
                print '<img class="img-responsive" src="' . esc_url($image_url) . '" alt="sponsor image" />';
                if (!empty($linkImage)) {
                    print '</a>';
                }
                print '</div>';
            }
        }

        print '</div>'
                . '</div>'
                . '</div>';


        print '<style>'
                . 'footer .sponsors {'
                . ' background: ' . $background_color . ';'
                . '}'
                . '</style>';


        print $args['after_widget'];
    }

    /**
     * Tell WP we want to use this widget.
     *
     * @wp-hook widgets_init
     * @return void
     */
    public static function register() {
        register_widget(__CLASS__);
    }

}
