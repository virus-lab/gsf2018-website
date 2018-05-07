<?php


class WCS_Settings {

	function __construct(){

		add_action( 'admin_menu', array( $this, 'settings_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'wp_ajax_wcs_save_schedule', array( $this, 'save_settings' ) );

	}


	function save_settings(){

		if( empty( $_POST ) || ! check_admin_referer( 'save_schedule', 'schedule_nonce' ) )
			wp_die();

		$data 	= maybe_unserialize( $_POST['data'] );
		$id 	= $_POST['id'];

		foreach( $data as $key => $value ){
			$data[$key] = esc_attr( $value );
		}

		$current = get_option( "__wcs_schedule_$id" );

		if( ! $current ){
			update_option( '__wcs_schedule_count', $id );
		}

		update_option( "__wcs_schedule_$id", $data );

		echo 1;

		wp_die();

	}


	function load_assets(){

		$screen = get_current_screen();

		if( $screen->base === 'edit' )
			return;

		wp_register_script( 'wcs-tabber', plugins_url() . '/weekly-class/assets/libs/hashtabber/hashTabber.js', array( 'jquery' ), null );
		wp_register_script( 'wcs-fs-core', plugins_url() . '/weekly-class/assets/libs/formstone/js/core.js', array( 'jquery' ), null );
		wp_register_script( 'wcs-fs-tooltip', plugins_url() . '/weekly-class/assets/libs/formstone/js/tooltip.js', array( 'jquery', 'wcs-fs-core' ), null );
		wp_register_script(
			'wcs-ladda-spin',
			plugins_url() . '/weekly-class/assets/libs/ladda/js/spin.min.js',
			array( 'jquery' ),
			null,
			true
		);

		wp_register_script(
			'wcs-ladda',
			plugins_url() . '/weekly-class/assets/libs/ladda/js/ladda.min.js',
			array( 'jquery', 'wcs-ladda-spin' ),
			null,
			true
		);


		wp_register_script(
			'wcs-ladda-jquery',
			plugins_url() . '/weekly-class/assets/libs/ladda/js/ladda.jquery.min.js',
			array( 'jquery', 'wcs-ladda-spin', 'wcs-ladda'  ),
			null,
			true
		);

		wp_register_script(
			'wcs-dependson',
			plugins_url() . '/weekly-class/assets/libs/dependson/dependsOn-1.0.2.min.js',
			array( 'jquery'  ),
			null,
			true
		);

		wp_register_script( 'wcs-settings', plugins_url() . '/weekly-class/assets/admin/js/min/settings-min.js', array( 'jquery', 'wp-color-picker', 'wcs-tabber', 'wcs-fs-tooltip', 'wcs-dependson' ), null );

		wp_register_style(
			'wcs-ladda',
			plugins_url() . '/weekly-class/assets/libs/ladda/css/ladda-themeless.min.css',
			null,
			false,
			'all'
		);
		wp_register_style( 'wcs-fs-tooltip', plugins_url() . '/weekly-class/assets/libs/formstone/css/tooltip.css' );
		wp_register_style( 'wcs-themify', plugins_url() . '/weekly-class/assets/libs/themify/themify-icons.css' );
		wp_register_style( 'wcs-settings', plugins_url() . '/weekly-class/assets/admin/css/settings.css', array( 'wp-color-picker', 'wcs-themify', 'wcs-fs-tooltip'  ) );

	}


	function settings_page(){

		add_submenu_page( 'edit.php?post_type=class', __( 'Events Schedule Settings', 'WeeklyClass' ), __( 'Settings', 'WeeklyClass' ), 'manage_options', 'wcs_settings', array( $this, 'settings_page_hook' ) );

	}

	function settings_page_hook(){

		if( isset( $_REQUEST['wcs_action'] ) ){

			update_option( 'wcs_single', isset( $_REQUEST['wcs_single'] ) ? true : false );

			if( isset( $_REQUEST['wcs_slug'] ) && ! empty( $_REQUEST['wcs_slug'] ) ){

				update_option( 'wcs_slug', esc_attr( $_REQUEST['wcs_slug'] ) );

			}

			if( isset( $_REQUEST['wcs_template'] ) && ! empty( $_REQUEST['wcs_template'] ) ){

				update_option( 'wcs_single_template', esc_attr( $_REQUEST['wcs_template'] ) );

			}

			if( isset( $_REQUEST['wcs_color'] ) && ! empty( $_REQUEST['wcs_color'] ) ){

				update_option( 'wcs_single_color', esc_attr( $_REQUEST['wcs_color'] ) );

			}

			if( isset( $_REQUEST['wcs_dateformat'] ) && ! empty( $_REQUEST['wcs_dateformat'] ) ){

				update_option( 'wcs_dateformat', esc_attr( $_REQUEST['wcs_dateformat'] ) );

			}

			if( isset( $_REQUEST['wcs_api_key'] ) ){

				update_option( 'wcs_api_key', esc_attr( $_REQUEST['wcs_api_key'] ) );

			}

			update_option( 'wcs_time_format', isset( $_REQUEST['wcs_time_format'] ) ? true : false );
			update_option( 'wcs_single_ending', isset( $_REQUEST['wcs_ending'] ) ? true : false );
			update_option( 'wcs_single_duration', isset( $_REQUEST['wcs_duration'] ) ? true : false );
			update_option( 'wcs_single_location', isset( $_REQUEST['wcs_location'] ) ? true : false );
			update_option( 'wcs_single_instructor', isset( $_REQUEST['wcs_instructor'] ) ? true : false );
			update_option( 'wcs_single_map', isset( $_REQUEST['wcs_map'] ) ? true : false );

			if( isset( $_REQUEST['wcs_single_box'] ) ){

				update_option( 'wcs_single_box', esc_attr( $_REQUEST['wcs_single_box'] ) );

			}

			if( isset( $_REQUEST['wcs_map_theme'] ) ){

				update_option( 'wcs_single_map_theme', esc_attr( $_REQUEST['wcs_map_theme'] ) );

			}

			if( isset( $_REQUEST['wcs_map_type'] ) ){

				update_option( 'wcs_single_map_type', esc_attr( $_REQUEST['wcs_map_type'] ) );

			}

			if( isset( $_REQUEST['wcs_map_zoom'] ) && ! empty( $_REQUEST['wcs_map_zoom'] ) && intval( $_REQUEST['wcs_map_zoom'] ) >= 1 ){

				update_option( 'wcs_single_map_zoom', intval( $_REQUEST['wcs_map_zoom'] ) > 15 ? 15 : esc_attr( $_REQUEST['wcs_map_zoom'] ) );

			}

		}

		wp_enqueue_style( 'wcs-settings' );
		wp_enqueue_script( 'wcs-settings' );

 		$wcs_single 		= filter_var( esc_attr( get_option( 'wcs_single', true ) ), FILTER_VALIDATE_BOOLEAN );
 		$wcs_slug 			= esc_attr( get_option( 'wcs_slug', 'class' ) );
 		$wcs_dateformat = esc_attr( get_option( 'wcs_dateformat', 'F j @ H:i' ) );
 		$wcs_ending 		= filter_var( esc_attr( get_option( 'wcs_single_ending', true ) ), FILTER_VALIDATE_BOOLEAN );
 		$wcs_duration 	= filter_var( esc_attr( get_option( 'wcs_single_duration', true ) ), FILTER_VALIDATE_BOOLEAN );
 		$wcs_location 	= filter_var( esc_attr( get_option( 'wcs_single_location', true ) ), FILTER_VALIDATE_BOOLEAN );
 		$wcs_instructor = filter_var( esc_attr( get_option( 'wcs_single_instructor', true ) ), FILTER_VALIDATE_BOOLEAN );
		$wcs_map 				= filter_var( esc_attr( get_option( 'wcs_single_map', true ) ), FILTER_VALIDATE_BOOLEAN );
		$wcs_map_theme 	= esc_attr( get_option( 'wcs_single_map_theme', 'light' ) );
		$wcs_map_zoom 	= esc_attr( get_option( 'wcs_single_map_zoom', 15 ) );
		$wcs_map_type 	= esc_attr( get_option( 'wcs_single_map_type', 'roadmap' ) );
		$wcs_single_box = esc_attr( get_option( 'wcs_single_box', 'left' ) );
		$wcs_color 			= esc_attr( get_option( 'wcs_single_color', '#BD322C' ) );
		$wcs_single_template = esc_attr( get_option( 'wcs_single_template', 'page' ) );
		$wcs_api_key		=	esc_attr( get_option( 'wcs_api_key' ) );
		$wcs_time_format		 = filter_var( esc_attr( get_option( 'wcs_time_format' ) ), FILTER_VALIDATE_BOOLEAN );

  	$templates 		= get_page_templates();
  	$templates		= array_merge( array( __('Default Page', 'WeeklyClass' ) => 'page', __('Single Page', 'WeeklyClass' ) => 'single' ), $templates );

		?>

		<div class="wrap wcs-settings">

			<h1 class="wcs-settings__title"><?php _e( 'Events Schedule Settings', 'WeeklyClass' ) ?></h1>

			<form class="wcs-settings__container" action="<?php echo admin_url( '/edit.php?post_type=class&page=wcs_settings&wcs_action=update') ?>" method="post">
				<?php wp_nonce_field( 'save_settings', 'schedule_settings_nonce' ); ?>
				<table class="form-table">
					<tr>
						<th>
							<?php _e( 'Event Single Page', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_single" name="wcs_single" <?php checked( true, $wcs_single, true ) ?> value='1'> <?php _e( 'Allow events to have a public single page', 'WeekylClass' ) ?></label>
							<p class="description"><?php _e( 'Checking this field will allow visitors to view each event also as a separate page', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--single-allow">
						<th>
							<label for="wcs_template"><?php _e( 'Event Page Template', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<select id="wcs_template" name="wcs_template">

								<?php foreach( $templates as $key => $template ) : ?>
									<option <?php selected( $template, $wcs_single_template, true ) ?> value="<?php echo $template ?>"><?php echo $key ?></option>
								<?php endforeach; ?>

							</select>
						</td>
					</tr>
					<tr class="wcs-options--single-allow">
						<th>
							<label for="wcs_slug"><?php _e( 'Event Page Slug', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<input type="text" id="wcs_slug" name="wcs_slug" value="<?php echo $wcs_slug ?>">
							<p class="description"><?php _e( 'Default: class. This field cannot be empty', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--single-allow">
						<th>
							<?php _e( 'Events Box Position', 'WeeklyClass' ) ?>
						</th>
						<td>
							<fieldset>
								<p><label><input type="radio" name="wcs_single_box" value='disabled' <?php checked( 'disabled', $wcs_single_box, true ) ?>> <?php _e( 'Disabled', 'WeeklyClass' ) ?></label></p>
								<p><label><input type="radio" name="wcs_single_box" value='left' <?php checked( 'left', $wcs_single_box, true ) ?>> <?php _e( 'Left', 'WeeklyClass' ) ?></label></p>
								<p><label><input type="radio" name="wcs_single_box" value='center' <?php checked( 'center', $wcs_single_box, true ) ?>> <?php _e( 'Center', 'WeeklyClass' ) ?></label></p>
								<p><label><input type="radio" name="wcs_single_box" value='right' <?php checked( 'right', $wcs_single_box, true ) ?>> <?php _e( 'Right', 'WeeklyClass' ) ?></label></p>
							</fieldset>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<label for="wcs_color"><?php _e( 'Special Color', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<input type="text" id="wcs_color" name="wcs_color" class="wp-color-picker-field" value="<?php echo $wcs_color ?>">
							<p class="description"><?php _e( 'This color will be used in the titles and on the background of the buttons', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<label for="wcs_dateformat"><?php _e( 'Event Page Date Format', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<input type="text" id="wcs_dateformat" name="wcs_dateformat" value="<?php echo $wcs_dateformat ?>">
							<p class="description"><?php _e( 'Default: F j @ H:i. Available date &amp; time formats available here: <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">WordPress Date Formatting</a>', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Time in 12h Format', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_time_format" name="wcs_time_format" <?php checked( true, $wcs_time_format, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Ending Time', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_ending" name="wcs_ending" <?php checked( true, $wcs_ending, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Duration', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_duration" name="wcs_duration" <?php checked( true, $wcs_duration, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Location', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_location" name="wcs_location" <?php checked( true, $wcs_location, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Instructor', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_instructor" name="wcs_instructor" <?php checked( true, $wcs_instructor, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--single">
						<th>
							<?php _e( 'Show Map', 'WeeklyClass' ) ?>
						</th>
						<td>
							<label><input type="checkbox" id="wcs_map" name="wcs_map" <?php checked( true, $wcs_map, true ) ?>> <?php _e( 'Yes', 'WeeklyClass' ) ?></label>
						</td>
					</tr>
					<tr class="wcs-options--map">
						<th>
							<label for='wcs_api_key'><?php _e( 'Google Maps API Key', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<input type="text" id="wcs_api_key" name="wcs_api_key" value="<?php echo $wcs_api_key ?>">
							<p class="description"><?php _e( 'For optimal performances we recommend using your own Google Maps API Key. You can create one here: <a href="
https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Generate API Key</a>', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--map">
						<th>
							<?php _e( 'Map Theme', 'WeeklyClass' ) ?>
						</th>
						<td>
							<fieldset>
								<p><label><input type="radio" name="wcs_map_theme" value='light' <?php checked( 'light', $wcs_map_theme, true ) ?>> <?php _e( 'Light theme', 'WeeklyClass' ) ?></label></p>
								<p><label><input type="radio" name="wcs_map_theme" value='dark' <?php checked( 'dark', $wcs_map_theme, true ) ?>> <?php _e( 'Dark theme', 'WeeklyClass' ) ?></label></p>
							</fieldset>
						</td>
					</tr>
					<tr class="wcs-options--map">
						<th>
							<label for="wcs_map_zoom"><?php _e( 'Map Zoom Level', 'WeeklyClass' ) ?></label>
						</th>
						<td>
							<input type="number" id="wcs_map_zoom" name="wcs_map_zoom" class="small-text" value="<?php echo $wcs_map_zoom ?>">
							<p class="description"><?php _e( 'Default: 15', 'WeeklyClass' ) ?></p>
						</td>
					</tr>
					<tr class="wcs-options--map">
						<th>
							<?php _e( 'Map Type', 'WeeklyClass' ) ?>
						</th>
						<td>
							<fieldset>
								<p><label><input type="radio" name="wcs_map_type" value='roadmap' <?php checked( 'roadmap', $wcs_map_type, true ) ?>> <?php _e( 'Roadmap', 'WeeklyClass' ) ?></label></p>
								<p><label><input type="radio" name="wcs_map_type" value='satellite' <?php checked( 'satellite', $wcs_map_type, true ) ?>> <?php _e( 'Satellite', 'WeeklyClass' ) ?></label></p>
							</fieldset>
						</td>
					</tr>
				</table>
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Settings', 'WeeklyClass' ) ?>"></p>
			</form>



		</div>

		<?php

	}


}

new WCS_Settings();


?>
