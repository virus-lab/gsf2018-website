<?php
if (has_post_thumbnail()) {

    if (!is_single()) {

        $id = get_the_ID();

        $post_tags = wp_get_post_categories($id, array('fields' => 'names'));
        ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="image">

            <?php the_post_thumbnail('full', array('class' => "img-responsive")); ?>
            <span><?php echo implode(", ", $post_tags); ?></span>

        </a>

        <?php
    } else {
        ?><div class="image-box"><?php the_post_thumbnail('full', array('class' => "img-responsive image image-hover")); ?></div><?php
    }
}
if (is_singular('class')) {
    $img = get_post_meta(get_the_ID(), '_wcs_image', true);
    if (!empty($img)) {
        ?>
        <div class="image-box">
            <img src="<?php echo esc_url($img); ?>" class="img-responsive image image-hover">
        </div>

        <?php
    }
}
?>