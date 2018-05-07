<?php
if (!wp_script_is('wcs-main'))
    wp_enqueue_script('wcs-main');

$start_timestamp = current_time('timestamp');
$stop_timestamp = empty($days) ? null : $start_timestamp + intval($days) * DAY_IN_SECONDS;

if ($has_filters) {

    echo $filters_position === 'filters-center' ? "<div class='wcs-filter-toggler-container'><span class='wcs-filter-toggler'>$label_toggle <em class='icon ti-plus'></em></span></div>" : '';

    echo WeeklyClass::get_filters_new($atts);
}

$timetable_data['method'] = 1;
$timetable_data['start'] = $start_timestamp;
$timetable_data['stop'] = $stop_timestamp;
$timetable_data['days'] = $days_increment;
$wcs_single = filter_var(esc_attr(get_option('wcs_single', true)), FILTER_VALIDATE_BOOLEAN);
?>
<div class="wcs-timetable wcs-timetable--compact" <?php WeeklyClass::timetable_data($timetable_data); ?>>

    <input type="hidden" class="wcs-timetable__default_filters" name="default_filters" value="<?php echo esc_html(maybe_serialize($filters)) ?>">

    <?php echo filter_var($show_title, FILTER_VALIDATE_BOOLEAN) ? "<h2>$title</h2>" : ''; ?>

    <ul class="wcs-timetable__compact wcs-timetable__parent">
        <div class="schedule4">
            <?php
            $days = WeeklyClass::get_classes($filters, $days, 1, $start_timestamp, $stop_timestamp, 0, false, $label_dateformat);
            if (count($days) > 0) : foreach ($days as $day) :
                    ?>
                    <!-- Day Start -->
                    <div class="row day">
                        <div class="col-sm-2">
                            <div class="date wcs-day__date"><?php echo $day['day_name'] ?>
                                <small><?php echo!empty($day['formatted']) ? $day['formatted'] : $day['day_month'] ?></small>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <?php
                            if (count($day['classes']) > 0) : foreach ($day['classes'] as $class) : $class['status'] = filter_var($class['status'], FILTER_VALIDATE_BOOLEAN);
                                    $speaker_parent = get_post_meta($class['id'], 'evnt_speaker_parent', true);
                                    $speaker_title = get_the_title($speaker_parent);
                                    $speaker_content = evnt_related_post_get_the_excerpt($speaker_parent);
                                    $speaker_parent_multi = get_post_meta($class['id'], 'evnt_speaker_parent_multiple', true);

                                    $evnt_speaker_short_description = get_post_meta($speaker_parent, 'evnt_speaker_short_description', true);
                                    $speaker_work_title = get_post_meta($speaker_parent, 'evnt_speaker_title', true);
                                    $speaker_facebook = get_post_meta($speaker_parent, 'evnt_speaker_facebook', true);
                                    $speaker_linkedin = get_post_meta($speaker_parent, 'evnt_speaker_linkedin', true);
                                    $speaker_twitter = get_post_meta($speaker_parent, 'evnt_speaker_twitter', true);
                                    ?>

                                    <div class="row talk wcs-class wcs-class--filterable <?php echo $class['css_classes'] ?>" <?php echo $class['data']; ?>>
                                        <div class="col-sm-3 time">
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
                                        <div class="col-sm-4 subject <?php if (WeeklyClass::has_modal($show_description, $class['content'], $class['status'])) echo 'wcs-modal-call';               ?>" <?php
                                        WeeklyClass::get_style($class['color']);
                                        WeeklyClass::modal_data($modal, $class['id'], $class['timestamp'], $class['date']['date'], $show_time_format, $schedule_id);
                                        ?> title="<?php echo $class['title']; ?>">

                                            <?php if ($wcs_single == true) { ?>
                                                <a href="<?php echo get_permalink($class['id']) ?>">
                                                    <?php echo $class['title']; ?>
                                                </a>
                                            <?php } else { ?>

                                                <?php echo $class['title']; ?>

                                            <?php } ?>
                                        </div>
                                        
                                           <div class="col-sm-3">
                                            <div class="speaker">
                                                <a href="<?php echo esc_url(get_permalink($speaker_parent)); ?>">
                                                    <?php echo $speaker_title ?>  <?php echo $speaker_work_title ?>
                                                </a>

                                            </div>
                                            <?php
                                            if (!empty($speaker_parent_multi)) {
                                                foreach ($speaker_parent_multi as $multiplespeaker) {
                                                    ?>  
                                                    <div class="speaker"><a href="<?php echo get_permalink($multiplespeaker) ?>">
                                                            <?php echo get_the_title($multiplespeaker); ?>  <?php echo get_post_meta($multiplespeaker, 'evnt_speaker_title', true) ?>
                                                        </a></div>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ($class['rooms']) {
                                            if (filter_var($show_location, FILTER_VALIDATE_BOOLEAN)) {
                                                ?>
                                                <div class="col-sm-2 venue">
                                                    <?php
                                                    echo $class['rooms'];
                                                    ?>

                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div><!-- Day End -->
                    <?php
                endforeach;
            else :
                ?>
                <li class="wcs-timetable__zero-data wcs-timetable__zero-data-container">
                    <h3><?php echo $zero ?></h3>
                </li>
            <?php endif; ?>
        </div><!-- Day 1 End ws -->
    </ul>
</div>

<?php
if (count($days) > 0) {
    include( __DIR__ . '/../misc/button-more.php' );
}
?>


<script class="wcs-template-zero-data" type="text/x-handlebars-template">
    <li class="wcs-timetable__zero-data wcs-timetable__zero-data-container">
    <h3><?php echo $zero ?></h3>
    </li>
</script>
<script class="wcs-template" type="text/x-handlebars-template">
    {{#each this}}
    <li class="wcs-day wcs-day--{{day_num}}">

    <div class="wcs-day__date">
    {{day_name}}
    <small>{{#if formatted}}{{formatted}}{{else}}{{day_month}}{{/if}}</small>
    </div>

    <ul class="wcs-timetable__classes">
    {{#each classes}}
    <li class="wcs-class wcs-class--filterable {{css_classes}}" {{{data}}}>
    <div class="wcs-class__time">
    <?php
    echo $show_time_format === 24 ?
            "<div class='wcs-class__non-breakable'>{{date.hour}}<span class='wcs-addons--blink'>:</span>{{date.min}}</div>" :
            "<div class='wcs-class__non-breakable'>{{date.hour_12}}<span class='wcs-addons--blink'>:</span>{{date.min}} {{date.meridiem}}</div>";

    if (filter_var($show_ending, FILTER_VALIDATE_BOOLEAN)) {

        echo $show_time_format === 24 ?
                " - <div class='wcs-class__non-breakable'>{{ending.hour}}<span class='wcs-addons--blink'>:</span>{{ending.min}}</div>" :
                " - <div class='wcs-class__non-breakable'>{{ending.hour_12}}<span class='wcs-addons--blink'>:</span>{{ending.min}} {{ending.meridiem}}</div>";
    }

    echo filter_var($show_duration, FILTER_VALIDATE_BOOLEAN) ? "<small class='wcs-class__duration'>{{duration}}</small> " : '';
    ?>
    </div>
    <div class="wcs-class__content">
    <h3 class="wcs-class__title <?php if (filter_var($show_description, FILTER_VALIDATE_BOOLEAN)) : ?>{{#wcs_if_not status '1'}}wcs-modal-call{{/wcs_if_not}}<?php endif; ?>" data-wcs-id='{{id}}' data-wcs-timestamp="{{timestamp}}" data-wcs-date="{{date.date}}" data-wcs-time-format='<?php echo $show_time_format ?>' data-wcs-modal-id='<?php echo $schedule_id ?>' title="{{title}}">{{{title}}}</h3>
    <small>
    {{#if rooms}}<?php echo filter_var($show_location, FILTER_VALIDATE_BOOLEAN) ? "<span>$label_locations</span> {{{rooms}}}" : ''; ?>{{/if}}
    {{#if instructors}}<?php echo filter_var($show_instructors, FILTER_VALIDATE_BOOLEAN) ? "<span class='wcs-addons--pipe'>$label_instructors</span> {{{instructors}}}" : ''; ?>{{/if}}
    </small>
    <?php if (filter_var($show_excerpt, FILTER_VALIDATE_BOOLEAN)) : ?><div class="wcs-class__excerpt">{{excerpt}}</div><?php endif; ?>
    </div>
    </li>
    {{/each}}
    </ul>

    </li>
    {{/each}}
</script>
