<?php

/**
 * Adds Address widget.
 */
class Address_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'address_widget', // Base ID
                esc_html__('Address Information Title', 'evnt'), // Name
                array('description' => esc_html__('A Address Information element', 'evnt'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }


        echo '<p>' . $instance['content'] . '</p>'
        . '<p><strong data-new-link="true">' . $instance['address_l1'] . '</strong><br>'
        . $instance['address_l2'] . '<br>'
        . $instance['address_l3'] . '<br>'
        . $instance['phone'] . '<br>
        <a href = "mailto:' . $instance['email'] . '">' . $instance['email'] . '</a></p>';
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : "";
        $content = !empty($instance['content']) ? $instance['content'] : "";
        $address_l1 = !empty($instance['address_l1']) ? $instance['address_l1'] : "";
        $address_l2 = !empty($instance['address_l2']) ? $instance['address_l2'] : "";
        $address_l3 = !empty($instance['address_l3']) ? $instance['address_l3'] : "";
        $phone = !empty($instance['phone']) ? $instance['phone'] : "";
        $email = !empty($instance['email']) ? $instance['email'] : "";
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_attr_e('Content:', 'evnt'); ?></label> 
            <textarea rows="4" class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" type="text" value="<?php echo esc_attr($content); ?>"><?php echo esc_attr($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address_l1')); ?>"><?php esc_attr_e('Address:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_l1')); ?>" name="<?php echo esc_attr($this->get_field_name('address_l1')); ?>" type="text" value="<?php echo esc_attr($address_l1); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address_l2')); ?>"><?php esc_attr_e('Address line 2:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_l2')); ?>" name="<?php echo esc_attr($this->get_field_name('address_l2')); ?>" type="text" value="<?php echo esc_attr($address_l2); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address_l3')); ?>"><?php esc_attr_e('Address line 3:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_l3')); ?>" name="<?php echo esc_attr($this->get_field_name('address_l3')); ?>" type="text" value="<?php echo esc_attr($address_l3); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_attr_e('Phone:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_attr_e('Email:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['content'] = (!empty($new_instance['content']) ) ? strip_tags($new_instance['content']) : '';
        $instance['address_l1'] = (!empty($new_instance['address_l1']) ) ? strip_tags($new_instance['address_l1']) : '';
        $instance['address_l2'] = (!empty($new_instance['address_l2']) ) ? strip_tags($new_instance['address_l2']) : '';
        $instance['address_l3'] = (!empty($new_instance['address_l3']) ) ? strip_tags($new_instance['address_l3']) : '';
        $instance['phone'] = (!empty($new_instance['phone']) ) ? strip_tags($new_instance['phone']) : '';
        $instance['email'] = (!empty($new_instance['email']) ) ? strip_tags($new_instance['email']) : '';

        return $instance;
    }

}

// class address_Widget
// register address_Widget widget
function register_address_widget() {
    register_widget('Address_Widget');
}

add_action('widgets_init', 'register_address_widget');



