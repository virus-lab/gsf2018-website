<?php
/** Template: Display -> Large List */
$args = array(
    'post_type' => 'speaker',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts' => -1,
    'offset' => 0,
);
$get_posts = get_posts($args);
?>

<template>
    <div class="wcs-timetable wcs-timetable--large schedule2">
        <h2 v-if="filter_var(options.show_title)">{{options.title}}</h2>
        <div class="wcs-timetable__large wcs-table">
            <template v-if="Object.keys(events_by_day).length > 0">

                <ul class="nav nav-tabs nav-justified">

                    <li v-for="(day, key) in events_by_day" >
                        <a  v-bind:href="'#tab-'+key" data-toggle="tab">{{ day.date | moment( options.label_dateformat ? options.label_dateformat : 'dddd, MMMM D' ) }}</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div  v-for="(day, key) in events_by_day" v-if="day.events" class="tab-pane in fade" v-bind:class="{ 'active': key === 0 }"  v-bind:id="'tab-'+key">


                        <div v-for="event in day.events" class="wcs-class" :class="event | eventCSS">
                             <div class="row talk">
                                <div class="col-xs-12 col-sm-2">
                                    <div class="time" v-html="starting_ending(event)"></div>
                                </div>
                                <!--                                 <div class="time wcs-class__time wcs-table__td" v-html="starting_ending(event)"></div>-->
                                <div class="col-xs-12 col-sm-10">
                                    <div class="content-box">
                                        <div class="trigger">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <h4 v-html="event.title"  v-on:click="openModal( event, options, $event )"></h4>
                                        <div v-if="filter_var(options.show_excerpt)" class="wcs-class__excerpt" v-html="event.excerpt"></div>
                                        <div v-if="filter_var(options.show_wcs_room)" class='wcs-class__locations' :data-wcs-location='options.label_wcs_room'>
                                            <i style="color:#be1a39;" class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;
                                            <taxonomy-list :options="options" :tax="'wcs_room'" :event="event" v-on:open-modal="openTaxModal"></taxonomy-list>
                                        </div>
                                        <template v-if="filter_var(options.show_wcs_instructor)"  v-for="aaa in event.terms.wcs_instructor"  >
                                            <?php foreach ($get_posts as $value) { ?>
                                                <?php
//                                                $speaker_parent = get_post_meta($value->ID, 'evnt_speaker_parent', true);
//                                                $speaker_parent_multi = get_post_meta($value->ID, 'evnt_speaker_parent_multiple', true);
//
//                                                $evnt_speaker_parent_multiple_names = get_post_meta($value->ID, 'evnt_speaker_parent_multiple_names', true);

                                                $speaker_title = get_the_title($value->ID);
                                                $speaker_content = evnt_related_post_get_the_excerpt($value->ID);

                                                $evnt_speaker_short_description = get_post_meta($value->ID, 'evnt_speaker_short_description', true);
                                                $speaker_work_title = get_post_meta($value->ID, 'evnt_speaker_title', true);
                                                $speaker_facebook = get_post_meta($value->ID, 'evnt_speaker_facebook', true);
                                                $speaker_linkedin = get_post_meta($value->ID, 'evnt_speaker_linkedin', true);
                                                $speaker_twitter = get_post_meta($value->ID, 'evnt_speaker_twitter', true);
                                                $speaker_thumbnail = get_the_post_thumbnail($value->ID, 'thumbnail', array('class' => "img-responsive  img-circle"), false);
                                                $speaker_url = get_permalink($value->ID);
                                                ?>

                                                <template v-if="aaa.slug === '<?php echo $value->post_name ?>'">
                                                    <p class="speaker show-content">
                                                        <a href="<?php echo $speaker_url; ?>">
                                                            <?php echo $value->post_title ?> <?php echo $value->evnt_speaker_title ?></a>
                                                    </p>
                                                    <p class="speaker hidden-content">
                                                        <a href="<?php echo $speaker_url; ?>">
                                                            <?php echo $value->post_title ?> <?php echo $value->evnt_speaker_title ?></a>

                                                    </p>
                                                    <div class="row hidden-content">
                                                        <div class="col-sm-3">
                                                            <a href="<?php echo $speaker_url; ?>">
                                                                <?php echo $speaker_thumbnail; ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p><?php echo $evnt_speaker_short_description ?></p>
                                                        </div>
                                                    </div>


                                                    <div class="row show-content">
                                                        <?php //var_dump($value);  ?>
                                                    </div>
                                                </template>
                                            <?php } ?>
                                        </template>


                                    </div>
                                </div>
                            </div>

                            <!--</div>-->
                            <!--</template>-->
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="wcs-timetable__zero-data-container">
                    <div><div class="wcs-timetable__zero-data"><p v-html="options.zero"></p></div></div>
                </div>
            </template>
        </div>
        <!--<button-more v-if="hasMoreButton()" v-on:add-events="addEvents" :more="options.label_more" :color="options.color_special_contrast"></button-more>-->
    </div>
</template>

