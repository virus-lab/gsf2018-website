<?php
/*
  Plugin Name: Social Profiles
  Version: 1.0
 */

class widget_social_profils extends WP_Widget {

    // Widget Settings
    function __construct() {
        parent::__construct(
                // Base ID of your widget
                'contact',
                // Widget name will appear in UI
                esc_html__('Social Profiles', 'evnt'),
                // Widget description
                array('description' => esc_html__('Display your social profiles', 'evnt'),)
        );
    }

    // Widget Output
    public function widget($args, $instance) {

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        if ($title):
            echo($before_widget . $before_title . $title . $after_title);
        endif;
        if ($instance['social_facebook'] || $instance['social_twitter'] || $instance['social_linkedin'] || $instance['social_youtube'] || $instance['social_flickr']):
            ?>
            <ul>
                <?php if ($instance['social_facebook']): ?>
                    <li><a href="<?php echo esc_url($instance['social_facebook']); ?>" class="facebook" title="<?php echo esc_attr__('Facebook','evnt') ?>" target="_blank"><i class="fa fa-lg fa-facebook"></i></a></li><?php
                endif;

                if ($instance['social_twitter']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_twitter']); ?>" class="twitter" title="<?php echo esc_attr__('Twitter','evnt') ?>" target="_blank"><i class="fa fa-lg fa-twitter"></i></a></li><?php
                endif;

                if ($instance['social_google']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_google']); ?>" class="google" title="<?php echo esc_attr__('Google+','evnt') ?>" target="_blank"><i class="fa fa-lg fa-google-plus"></i></a></li><?php
                endif;

                if ($instance['social_linkedin']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_linkedin']); ?>" class="linkedin" title="<?php echo esc_attr__('LinkedIn','evnt') ?>" target="_blank"><i class="fa fa-lg fa-linkedin"></i></a></li><?php
                endif;

                if ($instance['social_youtube']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_youtube']); ?>" class="youtube" title="<?php echo esc_attr__('YouTube','evnt') ?>" target="_blank"><i class="fa fa-lg fa-youtube"></i></a></li><?php
                endif;

                if ($instance['social_vimeo']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_vimeo']); ?>" class="vimeo" title="<?php echo esc_attr__('Vimeo','evnt') ?>" target="_blank"><i class="fa fa-lg fa-vimeo"></i></a></li><?php
                endif;

                if ($instance['social_instagram']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_instagram']); ?>" class="instagram" title="<?php echo esc_attr__('Instagram','evnt') ?>" target="_blank"><i class="fa fa-lg fa-instagram"></i></a></li><?php
                endif;

                if ($instance['social_pinterest']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_pinterest']); ?>" class="pinterest" title="<?php echo esc_attr__('Pinterest','evnt') ?>" target="_blank"><i class="fa fa-lg fa-pinterest"></i></a></li><?php
                endif;

                if ($instance['social_flickr']):
                    ?>
                    <li><a href="<?php echo esc_url($instance['social_flickr']); ?>" class="flickr" title="<?php echo esc_attr__('Flickr','evnt') ?>" target="_blank"><i class="fa fa-lg fa-flickr"></i></a></li><?php
                endif;
                ?>
            </ul>
            <?php
        endif;
        if ($title):
            echo($after_widget);
        endif;
    }

    // Backend Form
    public function form($instance) {

        $defaults = array('title' => esc_attr__('Get In Touch','evnt'), 'social_facebook' => '', 'social_twitter' => '', 'social_google' => '', 'social_linkedin' => '', 'social_youtube' => '', 'social_vimeo' => '', 'social_instagram' => '', 'social_pinterest' => '', 'social_flickr' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php echo esc_html_e('Title:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" value="<?php echo esc_html($instance['title']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_facebook')); ?>"><?php echo esc_html_e('Facebook URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_facebook')); ?>" name="<?php echo esc_html($this->get_field_name('social_facebook')); ?>" value="<?php echo esc_html($instance['social_facebook']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_twitter')); ?>"><?php echo esc_html_e('Twitter URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_twitter')); ?>" name="<?php echo esc_html($this->get_field_name('social_twitter')); ?>" value="<?php echo esc_html($instance['social_twitter']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_google')); ?>"><?php echo esc_html_e('Google+ URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_google')); ?>" name="<?php echo esc_html($this->get_field_name('social_google')); ?>" value="<?php echo esc_html($instance['social_google']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_linkedin')); ?>"><?php echo esc_html_e('LinkedIn URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_linkedin')); ?>" name="<?php echo esc_html($this->get_field_name('social_linkedin')); ?>" value="<?php echo esc_html($instance['social_linkedin']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_youtube')); ?>"><?php echo esc_html_e('YouTube URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_youtube')); ?>" name="<?php echo esc_html($this->get_field_name('social_youtube')); ?>" value="<?php echo esc_html($instance['social_youtube']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_vimeo')); ?>"><?php echo esc_html_e('Vimeo URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_vimeo')); ?>" name="<?php echo esc_html($this->get_field_name('social_vimeo')); ?>" value="<?php echo esc_html($instance['social_vimeo']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_instagram')); ?>"><?php echo esc_html_e('Instagram URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_instagram')); ?>" name="<?php echo esc_html($this->get_field_name('social_instagram')); ?>" value="<?php echo esc_html($instance['social_instagram']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_pinterest')); ?>"><?php echo esc_html_e('Pinterest URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_pinterest')); ?>" name="<?php echo esc_html($this->get_field_name('social_pinterest')); ?>" value="<?php echo esc_html($instance['social_pinterest']); ?>">
        </p>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('social_flickr')); ?>"><?php echo esc_html_e('Flickr URL:', 'evnt'); ?></label><br>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('social_flickr')); ?>" name="<?php echo esc_html($this->get_field_name('social_flickr')); ?>" value="<?php echo esc_html($instance['social_flickr']); ?>">
        </p>

        <?php
    }

    // Update
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['social_facebook'] = $new_instance['social_facebook'];
        $instance['social_twitter'] = $new_instance['social_twitter'];
        $instance['social_google'] = $new_instance['social_google'];
        $instance['social_linkedin'] = $new_instance['social_linkedin'];
        $instance['social_youtube'] = $new_instance['social_youtube'];
        $instance['social_vimeo'] = $new_instance['social_vimeo'];
        $instance['social_instagram'] = $new_instance['social_instagram'];
        $instance['social_pinterest'] = $new_instance['social_pinterest'];
        $instance['social_flickr'] = $new_instance['social_flickr'];

        return $instance;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("widget_social_profils");')
);
