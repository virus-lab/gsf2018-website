<?php


	if( ! wp_script_is( 'wcs-isotope' ) )
		wp_enqueue_script( 'wcs-isotope' );

	if( ! wp_script_is( 'wcs-main' ) )
		wp_enqueue_script( 'wcs-main' );

	if( filter_var( $show_past_events, FILTER_VALIDATE_BOOLEAN ) ){

		$start_timestamp = null;
		$stop_timestamp  = null;
		$days = null;

	} else {

		$start_timestamp = current_time('timestamp');
		$stop_timestamp  = empty( $days ) ? null : apply_filters( 'wcs_timetable_timestamp_stop', $start_timestamp + intval( $days ) * DAY_IN_SECONDS);

	}

	if( $has_filters ){

		echo $filters_position === 'filters-center' ? "<div class='wcs-filter-toggler-container'><span class='wcs-filter-toggler'>$label_toggle <em class='icon ti-plus'></em></span></div>" : '';

		echo WeeklyClass::get_filters_new( $atts );

	}

	$timetable_data['method'] = 0;
	$timetable_data['start'] 	= $start_timestamp;
	$timetable_data['stop'] 	= $stop_timestamp;
	$timetable_data['days'] 	= $days_increment;

?>
<div class="wcs-timetable wcs-timetable--grid" <?php WeeklyClass::timetable_data( $timetable_data ); ?>>

	<input type="hidden" class="wcs-timetable__default_filters" name="default_filters" value="<?php echo esc_html( maybe_serialize( $filters ) ) ?>">

	<?php echo filter_var( $show_title, FILTER_VALIDATE_BOOLEAN ) ? "<h2>$title</h2>" : ''; ?>

	<div class="wcs-timetable__grid wcs-timetable__parent" <?php WeeklyClass::carousel_data( $carousel_nav, $carousel_dots, $carousel_loop, $carousel_autoplay, $carousel_autoplay_speed, $carousel_items_xs, $carousel_items_md, $carousel_items_lg ); ?>>

		<div class="wcs-isotope-item"></div>
		<div class="wcs-isotope-gutter"></div>

		<?php $classes = WeeklyClass::get_classes( $filters, $days, 0, $start_timestamp, $stop_timestamp, 0, false, $label_dateformat ); if( ! empty( $classes ) ) : foreach( $classes as $class ) : ?>

			<div class="wcs-class wcs-class--filterable <?php echo $class['css_classes'] ?>" <?php echo $class['data']; ?>>

				<div class="wcs-class__inner">

					<?php if( ! empty( $class['image'] ) ) :  ?><div class="wcs-class__image"><img class='<?php if( WeeklyClass::has_modal( $show_description, $class['content'], $class['status'] ) ) echo 'wcs-modal-call'; ?>' <?php echo $class['image_size'] ?> src="<?php echo $class['image']; ?>" <?php WeeklyClass::modal_data( $modal, $class['id'], $class['timestamp'], $class['date']['date'], $show_time_format, $schedule_id ); ?> title="<?php echo $class['title']; ?>"></div><?php endif; ?>

					<div class="wcs-class__title <?php if( WeeklyClass::has_modal( $show_description, $class['content'], $class['status'] ) ) echo 'wcs-modal-call'; ?>" <?php WeeklyClass::modal_data( $modal, $class['id'], $class['timestamp'], $class['date']['date'], $show_time_format, $schedule_id ); ?> title="<?php echo $class['title']; ?>" title="{{title}}"><?php echo $class['title'] ?></div>
					<div class="wcs-class__excerpt"><?php echo $class['excerpt'] ?></div>

					<?php if( ( filter_var( $show_location, FILTER_VALIDATE_BOOLEAN ) && ! empty( $class['rooms'] ) ) || ( filter_var( $show_instructors, FILTER_VALIDATE_BOOLEAN ) && ! empty( $class['instructors'] ) ) ) : ?>
					<div class="wcs-class__meta">
						<?php echo filter_var( $show_location, FILTER_VALIDATE_BOOLEAN ) && ! empty( $class['rooms'] ) ? ( ! empty( $label_locations ) ? "<span class='wcs-class__meta-label'>$label_locations</span>" : '' ) . $class['rooms']  : ''; ?>
						<?php echo filter_var( $show_instructors, FILTER_VALIDATE_BOOLEAN ) && ! empty( $class['instructors'] ) ? ( ! empty( $label_instructors ) ? "<span class='wcs-class__meta-label'>$label_instructors</span>" : '' ) . $class['instructors'] : ''; ?>
					</div>
					<?php endif; ?>

					<div class="wcs-class__date-time">
						<div class="wcs-class__time">
							<span class="ti-time"></span>
							<?php

								if( $show_time_format === 24 ){

									echo "{$class['date']['hour']}<span class='wcs-addons--blink'>:</span>{$class['date']['min']}";

								} else {

									echo "{$class['date']['hour_12']}<span class='wcs-addons--blink'>:</span>{$class['date']['min']} {$class['date']['meridiem']}";

								}


								if( filter_var( $show_ending, FILTER_VALIDATE_BOOLEAN ) ){

									echo $show_time_format === 24 ?
										" - {$class['ending']['hour']}<span class='wcs-addons--blink'>:</span>{$class['ending']['min']}" :
										" - {$class['ending']['hour_12']}<span class='wcs-addons--blink'>:</span>{$class['ending']['min']} {$class['ending']['meridiem']}";

								}
							?>
						</div>
						<div class="wcs-class__date">
							<span class="ti-calendar"></span><span><?php echo ! empty( $class['date']['formatted'] ) ? $class['date']['formatted'] : $class['date']['date_short'] ?></span>
						</div>

					</div>

					<div class="wcs-class__click-area"></div>
					<span class="wcs-class__minimize ti-fullscreen"></span>

				</div>

			</div>

		<?php endforeach; else : ?>

		<div class="wcs-timetable__zero-data wcs-timetable__zero-data-container">
			<h3><?php // echo $zero ?></h3>
		</div>

		<?php endif; ?>

	</div>

	<?php if( count( $classes ) > 0 ){ include( wcs_get_template_part( 'misc/button', 'more' ) ); } ?>

</div>
<!--<script class="wcs-template-zero-data" type="text/x-handlebars-template">
	<div class="wcs-timetable__zero-data wcs-timetable__zero-data-container">
		<h3><?php echo $zero ?></h3>
	</div>
</script>-->
<script class="wcs-template" type="text/x-handlebars-template">
{{#each this}}
	<div class="wcs-class wcs-class--filterable {{css_classes}}" {{{data}}}>

		<div class="wcs-class__inner">

			{{#if image}}
				<div class="wcs-class__image">
					{{#wcs_if_is status 0}}
						{{#if content}}
							<img class='<?php echo filter_var( $show_description, FILTER_VALIDATE_BOOLEAN ) ?  'wcs-modal-call' : ''; ?>' {{{image_size}}} src="{{image}}" <?php WeeklyClass::modal_data( $modal, null, null, null, $show_time_format, $schedule_id ); ?> title="{{title}}" {{#if single_href}} data-wcs-href="{{single_href}}" {{/if}} data-wcs-timestamp='{{timestamp}}' data-wcs-date='{{date.date}}' data-wcs-id='{{id}}'>
						{{else}}
							<img {{{image_size}}} src="{{image}}" title="{{title}}">
						{{/if}}
					{{else}}
						<img {{{image_size}}} src="{{image}}" title="{{title}}">
					{{/wcs_if_is}}
				</div>
			{{/if}}

			<?php if( filter_var( $show_description, FILTER_VALIDATE_BOOLEAN ) ) : ?>
			{{#wcs_if_is status 0}}
				{{#if content}}
					<div class="wcs-class__title wcs-modal-call"  title="{{title}}" data-wcs-id='{{id}}' {{#if single_href}} data-wcs-href="{{single_href}}" {{/if}} data-wcs-timestamp='{{timestamp}}' data-wcs-date='{{date.date}}' <?php WeeklyClass::modal_data( $modal, null, null, null, $show_time_format, $schedule_id ); ?>>{{{title}}}</div>
				{{else}}
					<div class="wcs-class__title">{{{title}}}</div>
				{{/if}}
			{{/wcs_if_is}}
			<?php else : ?>
				<div class="wcs-class__title">{{{title}}}</div>
			<?php endif; ?>

			<div class="wcs-class__excerpt">{{{excerpt}}}</div>

			<div class="wcs-class__meta">

				{{#if rooms}}<?php echo filter_var( $show_location, FILTER_VALIDATE_BOOLEAN ) ? "<span class='wcs-class__meta-label'>$label_locations</span> {{{rooms}}}" : ''; ?>{{/if}}
				{{#if instructors}}<?php echo filter_var( $show_instructors, FILTER_VALIDATE_BOOLEAN ) ? "<span class='wcs-class__meta-label'>$label_instructors</span> {{{instructors}}}" : ''; ?>{{/if}}

			</div>

			<div class="wcs-class__date-time">
				<div class="wcs-class__time">
					<span class="ti-time"></span>
					<?php if( $show_time_format === 24 ) : ?>

						{{date.hour}}<span class="wcs-addons--blink">:</span>{{date.min}}

					<?php else : ?>

						{{date.hour_12}}<span class="wcs-addons--blink">:</span>{{date.min}} {{date.meridiem}}

					<?php endif;

						if( $show_time_format === 24 ) {

							echo filter_var( $show_ending, FILTER_VALIDATE_BOOLEAN ) ? ' - {{ending.hour}}<span class="wcs-addons--blink">:</span>{{ending.min}}' : '';

						}  else {

							echo filter_var( $show_ending, FILTER_VALIDATE_BOOLEAN ) ? ' - {{ending.hour_12}}<span class="wcs-addons--blink">:</span>{{ending.min}} {{ending.meridiem}}' : '';

						}

					?>

				</div>
				<div class="wcs-class__date">
					<span class="ti-calendar"></span><span>{{#if date.formatted}}{{date.formatted}}{{else}}{{date.date_short}}{{/if}}</span>
				</div>

			</div>

			<div class="wcs-class__click-area"></div>
			<span class="wcs-class__minimize ti-fullscreen"></span>

		</div>

	</div>
{{/each}}
</script>
