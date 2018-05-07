<?php

# -*- coding: utf-8 -*-
/* Plugin Name: Sponsors Carousel Widget */

add_action('widgets_init', array('Sponsors_Carousel_Widget', 'register'));

class Sponsors_Carousel_Widget extends WP_Widget {

    public function evnt_scripts() {
        wp_enqueue_script('owl-carousel');
        wp_enqueue_media();
    }

    /**
     * Constructor.
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'evnt_scripts'));
        parent::__construct(strtolower(__CLASS__), 'Sponsors Widget Carousel');
    }

    /**
     * Echo the settings update form
     *
     * @param array $instance Current settings
     */
    public function form($instance) {
        $columns = isset($instance['columns']) ? $instance['columns'] : '6';
        $columns = esc_attr($columns);
        $autoplay = $instance['autoplay'] ? $instance['autoplay'] : 'false';

//        printf(
//                '<p><input class="checkbox" type="checkbox"  %1$s id="%2$s"  name="%3$s" /> 
//            <label for="%2$s">' . esc_attr_e('Autoplay', 'evnt') . '</label></p>', checked($instance['autoplay'], 'on', $echo = false), $this->get_field_id('autoplay'), $this->get_field_name('autoplay')
//        );


        printf(
                '<p><label for="%1$s">%2$s</label><br />
            <input type="number" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('autoplay'), esc_attr_e('Columns number', 'evnt'), $this->get_field_name('autoplay'), $autoplay
        );
        
        
        
        
        printf(
                '<p><label for="%1$s">%2$s</label><br />
            <input type="number" name="%3$s" id="%1$s" value="%4$s" class="widefat"></p>', $this->get_field_id('columns'), esc_attr_e('Columns number', 'evnt'), $this->get_field_name('columns'), $columns
        );
        $image = !empty($instance['image']) ? $instance['image'] : '';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : '';

        $fields = isset($instance['fields']) ? $instance['fields'] : array();
        $fields_url = isset($instance['fields_url']) ? $instance['fields_url'] : array();
        $field_num = count($fields);
        $fields[$field_num + 1] = '';
        $fields_html = array();
        $fields_counter = 0;

        foreach ($fields as $name => $value) {

            $fields_html[] = sprintf(
                    '<hr>'
                    . '<p>'
                    . '<input type="hidden" id="%1$s[%2$s]" name="%1$s[%2$s]" value="%3$s" class="widefat">'
                    . '<img src="%3$s" style="width: 100&#37 ;">'
                    . '<button class="upload_image_button button button-primary">%4$s</button>'
                    . '</p>', $this->get_field_name('fields'), $fields_counter, esc_attr($value), esc_attr_e('Upload Image', 'evnt')
            );

            $fields_counter += 1;
        }

        print esc_html__('Fields', 'evnt') . '<br />' . join('<br />', $fields_html);
    }

    /**
     * Renders the output.
     *
     * @see WP_Widget::widget()
     */
    public function widget($args, $instance) {
        wp_enqueue_script('owl-carousel');
        print $args['before_widget'];
        $el_class = ' ';
        $autoplay = $instance['autoplay'];
        if ($autoplay != '') {
            $autoplay = ' data-autoplay="' . $autoplay . '"';
        } else {
            $autoplay = '';
        }
        $columns = $instance['columns'] ? $instance['columns'] : '6';
        $navs = 'false';


        print '<div class="sponsors"> '
                . '<div class="container">'
                . '<div class="sponsors  sponsor-carousel owl-carousel' . $el_class . '" data-columns="' . $columns . '" data-navs="' . $navs . '" ' . $autoplay . '>';

        foreach ($instance['fields'] as $value) {
            echo '<div>'
            . '<img src="' . esc_url($value) . '" class="img-responsive" alt="img">'
            . '</div>';
        }


        print '</div>'
                . '</div>'
                . '</div>';


        print $args['after_widget'];
    }

    /**
     * Prepares the content. Not.
     *
     * @param  array $new_instance New content
     * @param  array $old_instance Old content
     * @return array New content
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['columns'] = $new_instance['columns'];
        $instance['autoplay'] = $new_instance['autoplay'];
        $instance['fields'] = array();

        if (isset($new_instance['fields'])) {
            foreach ($new_instance['fields'] as $value) {
                if ('' !== trim($value))
                    $instance['fields'][] = $value;
            }
        }

        return $instance;
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
