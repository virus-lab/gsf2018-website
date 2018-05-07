<?php
if (!wp_script_is('wcs-tabber'))
    wp_enqueue_script('wcs-tabber');

if (!wp_script_is('wcs-main'))
    wp_enqueue_script('wcs-main');

if (!isset($GLOBALS['wcs-tabs']))
    $GLOBALS['wcs-tabs'] = 0;



if (filter_var($show_past_events, FILTER_VALIDATE_BOOLEAN)) {

    $start_timestamp = null;
    $stop_timestamp = null;
    $days = null;
} else {

    $start_timestamp = current_time('timestamp');
    $stop_timestamp = empty($days) ? null : apply_filters('wcs_timetable_timestamp_stop', $start_timestamp + intval($days) * DAY_IN_SECONDS);
}

if ($has_filters) {

    echo $filters_position === 'filters-center' ? "<div class='wcs-filter-toggler-container'><span class='wcs-filter-toggler'>$label_toggle <em class='icon ti-plus'></em></span></div>" : '';
    echo WeeklyClass::get_filters_new($atts);
}

$timetable_data['method'] = 0;
$timetable_data['start'] = $start_timestamp;
$timetable_data['stop'] = $stop_timestamp;
$timetable_data['days'] = $days_increment;



$GLOBALS['wcs-tabs'] ++;

$now = new DateTime();

$classes = WeeklyClass::get_classes($filters, $days, 1, $start_timestamp, $stop_timestamp, 0, false, $label_dateformat);
extract(shortcode_atts(array(
    'skin' => 'plug',
                ), $atts));
if ($has_filters) {

    echo $filters_position === 'filters-center' ? "<div class='wcs-filter-toggler-container'><span class='wcs-filter-toggler'>$label_toggle <em class='icon ti-plus'></em></span></div>" : '';
    echo WeeklyClass::get_filters_new($atts);
}

$wcs_single = filter_var(esc_attr(get_option('wcs_single', true)), FILTER_VALIDATE_BOOLEAN);
?>
<div class="schedule2">
    <?php echo filter_var($show_title, FILTER_VALIDATE_BOOLEAN) ? "<h2>$title</h2>" : ''; ?>
    <?php
    if (count($days) > 0) : $count = 0;
        $tabcount = 0;
        $tabidcount = 0;
        ?>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <?php foreach ($classes as $key => $day) :
                ?>

                <li role="presentation"  <?php echo $day['day_num']; ?>   class=""><a href="#tab-<?php echo $key; ?>" aria-controls="tab-<?php echo $key; ?>" role="tab" data-toggle="tab"><?php echo (!empty($day['formatted'])) ? $day['formatted'] : $day['day_name'] . ', ' . $day['day_month']; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <!-- Tab panes start -->
        <div class="tab-content">
            <?php foreach ($classes as $key => $day) : ?>
                <!-- Day 1 start -->

                <div role="tabpanel" class="tab-pane fade in wcs-timetable__parent wcs-day wcs-day--<?php echo $day['day_num'] ?>" id="tab-<?php echo $key; ?>">

                    <?php
                    foreach ($day['classes'] as $class) :
                        $speaker_parent = get_post_meta($class['id'], 'evnt_speaker_parent', true);
                        $speaker_parent_multi = get_post_meta($class['id'], 'evnt_speaker_parent_multiple', true);

                        $evnt_speaker_parent_multiple_names = get_post_meta($class['id'], 'evnt_speaker_parent_multiple_names', true);

                        $speaker_title = get_the_title($speaker_parent);
                        $speaker_content = evnt_related_post_get_the_excerpt($speaker_parent);

                        $evnt_speaker_short_description = get_post_meta($speaker_parent, 'evnt_speaker_short_description', true);
                        $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
                        $speaker_facebook = get_post_meta($speaker_parent, 'evnt_speaker_facebook', true);
                        $speaker_linkedin = get_post_meta($speaker_parent, 'evnt_speaker_linkedin', true);
                        $speaker_twitter = get_post_meta($speaker_parent, 'evnt_speaker_twitter', true);
                        ?>
                        <div class="row talk wcs-class wcs-class--filterable <?php echo $class['css_classes'] ?>" <?php echo $class['data']; ?>>
                            <div class="col-xs-12 col-sm-2">
                                <div class="time">
                                    <?php
                                    echo $show_time_format === 24 ?
                                            "{$class['date']['hour']}<span class='wcs-addons--blink'>:</span>{$class['date']['min']}" :
                                            "{$class['date']['hour_12']}<span class='wcs-addons--blink'>:</span>{$class['date']['min']} {$class['date']['meridiem']}";

                                    if (filter_var($show_ending, FILTER_VALIDATE_BOOLEAN)) {

                                        echo $show_time_format === 24 ?
                                                " - {$class['ending']['hour']}<span class='wcs-addons--blink'>:</span>{$class['ending']['min']}" :
                                                " - {$class['ending']['hour_12']}<span class='wcs-addons--blink'>:</span>{$class['ending']['min']} {$class['ending']['meridiem']}";
                                    }
                                    ?>
                                    <?php if (filter_var($show_duration, FILTER_VALIDATE_BOOLEAN)) : ?><span class="wcs-class__duration"> <?php echo $class['duration']; ?></span><?php endif; ?>
                                </div>

                                <?php if (filter_var($show_location, FILTER_VALIDATE_BOOLEAN)) : ?>
                                    <?php if ($class['rooms']) : ?>
                                        <div class="venue">
                                            <?php echo $class['rooms'] ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>




                            <div class="col-xs-12 col-sm-10">
                                <div class="content-box">

                                    <div class="trigger">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <h4 class="<?php if (WeeklyClass::has_modal($show_description, $class['content'], $class['status'])) //echo 'wcs-modal-call';                                       ?>" <?php
                                    WeeklyClass::get_style($class['color']);
                                    $speaker_title = get_the_title($speaker_parent);
                                    WeeklyClass::modal_data($modal, $class['id'], $class['timestamp'], $class['date']['date'], $show_time_format, $schedule_id);
                                    ?> title="<?php echo $class['title']; ?>">
                                            <?php if ($wcs_single == true) { ?>
                                            <a href="<?php echo get_permalink($class['id']) ?>">
                                                <?php echo $class['title']; ?>
                                            </a>
                                        <?php } else { ?>

                                            <?php echo $class['title']; ?>

                                        <?php } ?>
                                    </h4>

                                    <?php
                                    echo $class['excerpt'];
                                    if ($speaker_parent_multi) {
                                        ?>  
                                        <h3 class="hidden-content"><?php echo esc_html_e("Speaker team leader", 'evnt') ?></h3>
                                        <p class="speaker">
                                            <a href="<?php echo get_permalink($speaker_parent) ?>">
                                                <?php echo $speaker_title ?>  <?php
                                                if ($speaker_work_title) {
                                                    echo $speaker_work_title;
                                                }
                                                ?>
                                            </a>

                                        </p>

                                        <div class="row hidden-content">
                                            <div class="col-sm-3">
                                                <a href="<?php echo get_permalink($speaker_parent) ?>">
                                                    <?php
                                                    echo get_the_post_thumbnail($speaker_parent, 'thumbnail', array('class' => "img-responsive  img-circle"));
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-sm-9">
                                                <p><?php echo $evnt_speaker_short_description ?></p>
                                            </div>
                                        </div>
                                        <h3 class="hidden-content"><?php echo esc_html_e("The rest of the team", 'evnt') ?></h3>
                                        <?php
                                        foreach ($speaker_parent_multi as $multiplespeaker) {
                                            ?>  
                                            <p class="speaker show-content">
                                                <a href="<?php echo get_permalink($multiplespeaker) ?>">
                                                    <?php echo get_the_title($multiplespeaker); ?>  <?php echo get_post_meta($multiplespeaker, 'evnt_speaker_title', true) ?>
                                                </a>

                                            </p>
                                            <?php
                                        }
                                        foreach ($speaker_parent_multi as $multiplespeaker) {
                                            ?>


                                            <p class="speaker hidden-content">
                                                <a href="<?php echo get_permalink($multiplespeaker) ?>">
                                                    <?php echo get_the_title($multiplespeaker); ?>  <?php echo get_post_meta($multiplespeaker, 'evnt_speaker_title', true) ?>
                                                </a>

                                            </p>
                                            <div class="row hidden-content">
                                                <div class="col-sm-3">
                                                    <a href="<?php echo get_permalink($multiplespeaker) ?>">
                                                        <?php echo get_the_post_thumbnail($multiplespeaker, 'thumbnail', array('class' => "img-responsive  img-circle")); ?>
                                                    </a>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p><?php echo get_post_meta($multiplespeaker, 'evnt_speaker_short_description', true); ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>  
                                        <p class="speaker">
                                            <a href="<?php echo get_permalink($speaker_parent) ?>">
                                                <?php echo $speaker_title ?>  <?php
                                                if ($speaker_work_title) {
                                                    echo $speaker_work_title;
                                                }
                                                ?>
                                            </a>

                                        </p>

                                        <div class="row hidden-content">
                                            <div class="col-sm-3">
                                                <a href="<?php echo get_permalink($speaker_parent) ?>">
                                                    <?php
                                                    echo get_the_post_thumbnail($speaker_parent, 'thumbnail', array('class' => "img-responsive  img-circle"));
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="col-sm-9">
                                                <p><?php echo $evnt_speaker_short_description ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Day 1 end -->
            <?php endforeach; ?>
        </div>
    </div>

<?php else : ?>
    <div class="wcs-timetable__zero-data wcs-timetable__zero-data-container"><p><?php echo $zero ?></p></div>
<?php endif; ?>



<script class="wcs-template-zero-data" type="text/x-handlebars-template">
    <div class="wcs-timetable__zero-data wcs-timetable__zero-data-container"><p><?php echo $zero ?></p></div>
</script>
