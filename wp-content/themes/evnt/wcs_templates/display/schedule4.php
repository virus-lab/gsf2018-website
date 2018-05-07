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
    <div class=" schedule4">
        <h2 v-if="filter_var(options.show_title)">{{options.title}}</h2>
        <div class="">
            <template v-if="Object.keys(events_by_day).length > 0">
                <div  v-for="(day, key) in events_by_day" class="row day">
                    <div class="col-sm-2">
                        <div class="date wcs-day__date" >{{ day.date | moment(  'dddd' ) }} <br>
                            <small>{{ day.date | moment(  ' MM/D' ) }}</small>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div  v-for="event in day.events"  class="row talk wcs-class" :class="event | eventCSS" >
                              <div class="col-sm-3 time" v-html="starting_ending(event)"></div>
                            <div class="col-sm-4 subject " v-html="event.title"  v-on:click="openModal( event, options, $event )">
                            </div>
                            <div class="col-sm-3">
                                <template v-if="filter_var(options.show_wcs_instructor)"  v-for="aaa in event.terms.wcs_instructor"  >
                                    <?php foreach ($get_posts as $value) { ?>
                                        <?php
                                        $speaker_url = get_permalink($value->ID);
                                        ?>
                                        <div class="speaker" v-if="aaa.slug === '<?php echo $value->post_name ?>'">
                                            <a href="<?php echo $speaker_url; ?>">
                                                <?php echo $value->post_title ?> <?php echo $value->evnt_speaker_title ?></a>
                                        </div>
                                    <?php } ?>
                                </template>
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
        <button-more v-if="hasMoreButton()" v-on:add-events="addEvents" :more="options.label_more" :color="options.color_special_contrast"></button-more>
    </div>
</template>

