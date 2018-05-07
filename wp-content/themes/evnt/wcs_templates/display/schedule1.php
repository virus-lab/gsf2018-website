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



$args2 = array(
    'post_type' => 'class',
    'orderby' => 'date',
    'order' => 'DESC',
    'numberposts' => -1,
    'offset' => 0,
);
$get_posts_class = get_posts($args2);
?>

<template>
    <div class="wcs-timetable  wcs-timetable--large schedule1">
        <h2 v-if="filter_var(options.show_title)">{{options.title}}</h2>
        <div class="wcs-timetable__large wcs-table">
            <template v-if="Object.keys(events_by_day).length > 0">

                <ul class="nav nav-tabs nav-justified">

                    <li v-for="(day, key) in events_by_day" >
                        <a  v-bind:href="'#tab-'+key" data-toggle="tab">{{ day.date | moment( options.label_dateformat ? options.label_dateformat : 'dddd, MMMM D' ) }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" v-for="(day, key) in events_by_day" v-if="day.events" class="tab-pane in fade" v-bind:class="{ 'active': key === 0 }"  v-bind:id="'tab-'+key">
                        <div v-for="event in day.events" class="wcs-class" :class="event | eventCSS">
                             <div class="row wcs-class ">
                                <div class="col-xs-12 col-sm-2">




                                    <?php foreach ($get_posts_class as $value) { ?>

                                        <template  v-if="event.id == '<?php echo $value->ID ?>'" v-html="event.id">
                                            <?php
                                            $speaker_parent = get_post_meta($value->ID, 'evnt_speaker_parent', true);
                                            ?>
                                            <a href="<?php echo get_permalink($speaker_parent) ?>">

                                                <?php echo get_the_post_thumbnail($speaker_parent, 'evnt_thumbnail', array('class' => "img-responsive  img-circle")); ?>
                                            </a>
                                        </template>
                                    <?php } ?>

                                </div>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="info-box">
                                        <div class="content">
                                            <h4 v-html="event.title"  v-on:click="openModal( event, options, $event )"></h4>
                                            <div v-if="filter_var(options.show_excerpt)" class="wcs-class__excerpt" v-html="event.excerpt"></div>
                                        </div>
                                        <footer>
                                            <ul>
                                                <li>
                                                    <i class="fa fa-clock-o"></i>
                                                    <span v-html="starting_ending(event)"></span>
                                                </li>
                                                <li v-if="filter_var(options.show_wcs_room)" class='wcs-class__locations' :data-wcs-location='options.label_wcs_room'>

                                                    <i style="color:#be1a39;" class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;
                                                <taxonomy-list :options="options" :tax="'wcs_room'" :event="event" v-on:open-modal="openTaxModal"></taxonomy-list>

                                                </li>

                                                <li v-if="filter_var(options.show_wcs_instructor)"  >

                                                    <template v-for="aaa in event.terms.wcs_instructor"  >

                                                        <?php foreach ($get_posts as $value) { ?>
                                                            <?php
                                                            $speaker_url = get_permalink($value->ID);
                                                            ?>

                                                            <a  v-if="aaa.slug === '<?php echo $value->post_name ?>'" href="<?php echo $speaker_url; ?>">
                                                                <i class="fa fa-microphone"></i>
                                                                <?php echo $value->post_title ?> <?php echo $value->evnt_speaker_title ?>&nbsp;&nbsp;
                                                            </a>
                                                        <?php } ?>
                                                    </template>
                                                </li>
                                            </ul>
                                        </footer>
                                    </div>
                                </div>
                            </div>
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

