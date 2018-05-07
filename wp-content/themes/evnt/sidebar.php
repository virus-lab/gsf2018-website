<div class="col-sm-4" id="sidebar"><?php
    if (is_home() || is_single()) {

        if (is_active_sidebar('default-blog')) {
            dynamic_sidebar('default-blog');
        }
    } else if (is_page()) {

        if (is_active_sidebar('page-sidebar')) {
            dynamic_sidebar('page-sidebar');
        }
    }
    ?>

</div>