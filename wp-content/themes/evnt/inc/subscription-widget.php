<?php

/**
 * Adds subscription widget.
 */
class Custom_Subscription_Widget extends WP_Widget {

    public function scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_script('our_admin', get_template_directory_uri() . '/js/our_admin.js', array('jquery'));
    }

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
        parent::__construct(
                'subscription_widget', // Base ID
                esc_html__('Custom Newsletter widget', 'evnt'), // Name
                array('description' => esc_html__('A Newsletter element', 'evnt'),) // Args
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
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Default title', 'evnt') : $instance['title']);
        $image = !empty($instance['image']) ? $instance['image'] : '';

        ob_start();


        echo $args['before_widget'];

        $siteaddress = get_site_url();
        echo '<script type="text/javascript">';
        esc_js('//<![CDATA[
                    if (typeof newsletter_check !== "function") {
                    window.newsletter_check = function (f) {
                        var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
                        if (!re.test(f.elements["ne"].value)) {
                            alert("The email is not correct");
                            return false;
                        }
                        for (var i=1; i<20; i++) {
                        if (f.elements["np" + i] && f.elements["np" + i].required && f.elements["np" + i].value == "") {
                            alert("");
                            return false;
                        }
                        }
                        if (f.elements["ny"] && !f.elements["ny"].checked) {
                            alert("You must accept the privacy statement");
                            return false;
                        }
                        return true;
                    }
                    }
                    //]]>
                    ');
        echo '</script>

        <section class="newsletter widget" ';
        if ($instance['image'] !== '' or ! empty($instance['image'])) {
            echo 'style="background: url(' . esc_url($instance['image']) . ') no-repeat center center; background-size: cover;"';
        }


        echo '>
        <div class="container">
                <div class="row">
                        <div class="col-sm-12">';


        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }


        echo '<form method="post" class="form-inline" action="' . esc_url($siteaddress) . '/?na=s" onsubmit="return newsletter_check(this)">';
        if (!empty($instance['fullName'])) {
            if ($instance['fullName'] === 'on') {

                echo '<div class="row">
            <div class="col-sm-12">
            <div class="form-group col-sm-6">
                <label class="sr-only" for="newsletter-input-name">Name</label>
                <input type="text" name="nn" class="form-control" id="newsletter-input-name" placeholder="';
                if (!empty($instance['placeholderName'])) {
                    echo $instance['placeholderName'];
                } else {
                    echo 'Name';
                }
                echo '"></div>';



                echo
                '<div class="form-group col-sm-6">
                                        <label class="sr-only" for="newsletter-input-surname">Surname</label>
                                        <input type="text" name="ns" class="form-control" id="newsletter-input-surname" placeholder="';
                if (!empty($instance['placeholderSurname'])) {
                    echo $instance['placeholderSurname'];
                } else {
                    echo 'Surname';
                }
                echo '"></div>'
                . '</div>'
                . '</div>';
            }
        }



        echo '<div class="row">
            <div class="col-sm-12">
            <div class="input-group">
                <input type="email" name="ne" class="form-control" id="newsletter-input" placeholder="';
        if (!empty($instance['placeholder'])) {
            echo $instance['placeholder'];
        } else {
            echo esc_html__('jane.doe@example.com', 'evnt');
        }
        echo '">';
        echo '<span class="input-group-btn"><button type="submit" class="btn btn-secondary">';
        if (!empty($instance['buttonText'])) {
            echo $instance['buttonText'];
        } else {
            echo esc_attr__('Subscribe', 'evnt');
        }
        echo '</button></span>';
        echo '</div>'
        . '</div>'
        . '</div>'
        . '<div class="row">';

        echo '</div>'
        . '</form>'
        . '</div>'
        . '</div>'
        . '</div>'
        . '</section>';

        echo $args['after_widget'];
        ob_end_flush();
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'evnt');
        $image = !empty($instance['image']) ? $instance['image'] : '';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : '';
        $placeholderName = !empty($instance['placeholderName']) ? $instance['placeholderName'] : '';
        $placeholderSurname = !empty($instance['placeholderSurname']) ? $instance['placeholderSurname'] : '';
        $buttonText = !empty($instance['buttonText']) ? $instance['buttonText'] : '';
        $fullName = !empty($instance['fullName']) ? 'true' : 'false';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
        printf('<p><input class="checkbox" type="checkbox"  %1$s id="%2$s"  name="%3$s" /> 
            <label for="%2$s">' . esc_html__('Display name and surname filds?', 'evnt') . '</label></p>', checked($instance['fullName'], 'on', $echo = false), $this->get_field_id('fullName'), $this->get_field_name('fullName')
        );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('placeholderName')); ?>"><?php esc_attr_e('Input placeholder for Name:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('placeholderName')); ?>" name="<?php echo esc_attr($this->get_field_name('placeholderName')); ?>" type="text" value="<?php echo esc_attr($placeholderName); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('placeholderSurname')); ?>"><?php esc_attr_e('Input placeholder for Surname:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('placeholderSurname')); ?>" name="<?php echo esc_attr($this->get_field_name('placeholderSurname')); ?>" type="text" value="<?php echo esc_attr($placeholderSurname); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('placeholder')); ?>"><?php esc_attr_e('Input placeholder:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('placeholder')); ?>" name="<?php echo esc_attr($this->get_field_name('placeholder')); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('buttonText')); ?>"><?php esc_attr_e('Button text:', 'evnt'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('buttonText')); ?>" name="<?php echo esc_attr($this->get_field_name('buttonText')); ?>" type="text" value="<?php echo esc_attr($buttonText); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Background image:', 'evnt'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_url($image); ?>" class="widefat">
            <button class="upload_image_button button button-primary"><?php echo esc_html_e('Upload Image', 'evnt'); ?></button>
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
        $instance['image'] = (!empty($new_instance['image']) ) ? strip_tags($new_instance['image']) : '';
        $instance['placeholder'] = (!empty($new_instance['placeholder']) ) ? strip_tags($new_instance['placeholder']) : '';
        $instance['placeholderName'] = (!empty($new_instance['placeholderName']) ) ? strip_tags($new_instance['placeholderName']) : '';
        $instance['placeholderSurname'] = (!empty($new_instance['placeholderSurname']) ) ? strip_tags($new_instance['placeholderSurname']) : '';
        $instance['buttonText'] = (!empty($new_instance['buttonText']) ) ? strip_tags($new_instance['buttonText']) : '';
//        $instance['fullName'] = (!empty($new_instance['fullName']) ) ? strip_tags($new_instance['fullName']) : 'false';
        $instance['fullName'] = (!empty($new_instance['fullName']) ) ? $new_instance['fullName'] : '';
//        $fullName = isset($instance['fullName']) ? 'true' : 'false';
//        $image = !empty($instance['image']) ? $instance['image'] : '';
        return $instance;
    }

}

// class address_Widget
// register address_Widget widget
function register_custom_subscription_widget() {
    register_widget('Custom_Subscription_Widget');
}

add_action('widgets_init', 'register_custom_subscription_widget');


