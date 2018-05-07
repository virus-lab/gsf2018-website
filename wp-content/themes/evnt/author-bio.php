<div id="author-bio" class="row">
    <div class="col-sm-2"><?php echo get_avatar($post->post_author, 95); ?></div>
    <div class="col-sm-10">
        <h5><?php esc_html_e('About the Author', 'evnt'); ?></h5>
        <p><?php the_author_meta('description'); ?></p><?php
        $social_profiles = array();

        $facebook_url = get_the_author_meta('_evnt_user_facebook_url');
        $twitter_url = get_the_author_meta('_evnt_user_twitter_url');
        $linkedin_url = get_the_author_meta('_evnt_user_linkedin_url');
        $instagram_url = get_the_author_meta('_evnt_user_instagram_url');

        if (!empty($facebook_url) || !empty($twitter_url) || !empty($linkedin_url) || !empty($instagram_url)) {
            ?>
            <ul class="social"><?php if (!empty($facebook_url)) { ?><li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-2x fa-facebook-square"></i></a></li>
                    <?php
                }
                if (!empty($twitter_url)) {
                    ?>
                    <li><a href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-2x fa-twitter-square"></i></a></li>
                    <?php
                }
                if (!empty($instagram_url)) {
                    ?>
                    <li><a href="<?php echo esc_url($instagram_url); ?>"><i class="fa fa-2x fa-instagram"></i></a></li>
                    <?php
                }
                if (!empty($linkedin_url)) {
                    ?>
                    <li><a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-2x fa-linkedin-square"></i></a></li>
                        <?php }
                        ?>
            </ul>
        <?php }
        ?>
    </div>
</div>
