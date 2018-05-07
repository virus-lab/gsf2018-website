<?php


$wcs_single = new CurlyWeeklySingle();

class CurlyWeeklySingle{

	function __construct(){

		add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ), 1, 1 );
		add_filter( 'the_content', array( $this, 'filter_content' ), 1, 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );

	}

	function assets(){

		$key = esc_attr( get_option( 'wcs_api_key', 'AIzaSyArPwtdP09w4OeKGuRDjZlGkUshNh180z8' ) );
		$key = ! empty( $key ) ? $key : 'AIzaSyArPwtdP09w4OeKGuRDjZlGkUshNh180z8';
		$maps_url = add_query_arg( array( 'key' => $key ), '//maps.google.com/maps/api/js');

		wp_register_script(
			'wcs-google-map',
			$maps_url,
			array( 'jquery' ),
			null
		);
		wp_register_script(
			'wcs-gmaps',
			plugins_url() . '/weekly-class/assets/libs/gmaps/gmap3.min.js',
			array( 'jquery' ),
			'7.1'
		);

		wp_register_script(
			'wcs-single',
			plugins_url() . '/weekly-class/assets/front/js/min/single-min.js',
			array( 'jquery', 'wcs-google-map', 'wcs-gmaps' ),
			null,
			true
		);

		wp_localize_script( 'wcs-single', 'wcs_maps_url', $maps_url );

	}


	function event_title( $atts ){

		$atts = shortcode_atts( array(
			'id' => false,
		), $atts, 'wcs-single-event-title' );

		extract( $atts );

		echo $id ? get_the_title( $id ) : get_the_title();

	}



	function get_custom_post_type_template( $single_template ) {

	     global $post;

	     if( ! is_singular( 'class' ) )
	     	return $single_template;

	     $template = esc_attr( get_option( 'wcs_single_template', 'page' ) );
	     $template = str_replace( '.php', '', $template );

	     $temp = wcs_get_template_part( $template );

	     if ( $post->post_type === 'class' && ! empty( $temp ) ) {

	          $single_template = $temp;

	     }

	     return $single_template;

	}


	function filter_content_modal( $content, $id ){

		$content = str_replace( '[wcs-single-event-title]', "[wcs-single-event-title id=$id]", $content );

		return $content;

	}

	public static function prepare_button_woo( $id, $timestamp, $status = 0 ){

		if( ! WCS_WOO ){
			return;
		}

		if( intval( $status ) !== 0 ){
			return;
		}

		$woo_booking_capacity = get_post_meta( $id, WCS_PREFIX . '_woo_capacity', true );
		$woo_booking_label 		= get_post_meta( $id, WCS_PREFIX . '_woo_label', true );
		$woo_booking_product 	= get_post_meta( $id, WCS_PREFIX . '_woo_product', true );
		$woo_booking_history 	= get_post_meta( $id, '_' . WCS_PREFIX . '_woo_history', true );

		if( empty( $woo_booking_label ) || empty( $woo_booking_capacity ) || empty( $woo_booking_product ) || intval( $woo_booking_capacity ) <= 0 ){
			return;
		}

		$product = wc_get_product( $woo_booking_product );

		if( ! is_object( $product ) ){
			return;
		}

		if( ! $product->is_purchasable() ){
			return;
		}

		$total = 0;

		if( ! empty( $woo_booking_history ) ){

			$history = maybe_unserialize( $woo_booking_history );

			if( isset( $history[$timestamp] ) ){

				$orders = $history[$timestamp];

				foreach( $orders as $ord ){

					$order = wc_get_order( $ord );

					if( ! empty( $order ) && ! is_null( $order ) && $order !== false && ! in_array( $order->get_status(), array( 'cancelled', 'refunded', 'rejected', 'failed' ) ) ){
						$items = $order->get_items();
						foreach( $items as $item ){
							if( intval( $item->get_product_id() ) === intval( $woo_booking_product ) && $item->meta_exists('_wcs_event') && intval( $item->get_meta('_wcs_event', true ) ) === intval( $id ) && $item->meta_exists('_wcs_timestamp') && intval( $item->get_meta('_wcs_timestamp', true ) )  === intval( $timestamp ) ){
								$total += $item['qty'];
							}
						}
					}

				}

			}

		}

		if( ( intval( $woo_booking_capacity ) - $total ) <= 0 ){

			$woo_booking_label_sold = get_post_meta( $id, WCS_PREFIX . '_woo_label_sold', true );

			if( empty( $woo_booking_label_sold ) ){
				return;
			}

			$woo_booking_label_sold_link = get_post_meta( $id, WCS_PREFIX . '_woo_label_sold_link', true );

			if( ! empty( $woo_booking_label_sold_link ) ){

				return "<a href='$woo_booking_label_sold_link' class='wcs-btn wcs-btn--sold-out wcs-btn--action'>$woo_booking_label_sold</a>";

			}

			return "<span class='wcs-btn wcs-btn--disabled wcs-btn--sold-out'>$woo_booking_label_sold</span>";

		} else {

			$direction = esc_attr( WC_Admin_Settings::get_option( 'wc_settings_tab_wcs_redirect', 0 ) );
			$direction = intval( $direction ) === 0 ? 'cart' : 'checkout';

			$url = site_url( "/$direction/?add-to-cart=$woo_booking_product&event=$id&timestamp=$timestamp" );

			$button_woo = "<a href='$url' class='wcs-btn wcs-btn--action'>$woo_booking_label</a>";

			return $button_woo;

		}

	}



	function filter_content( $content ){

		global $post;

		if( ! is_singular( 'class' ) )
			return $content;

		if( ! wp_script_is( 'wcs-single' ) )
			wp_enqueue_script( 'wcs-single' );

		$single_layout 	= esc_attr( get_option( 'wcs_single_box', 'left' ) );
		$single_time_format 	= esc_attr( get_option( 'wcs_time_format' ) );

		if( $single_layout !== 'disabled' ){

			$before_content = $after_content = $rooms_list = $instructors_list = '';

			$id	= $post->ID;
			//$post = get_post( $id );
			$post_meta = get_post_meta( $id );

			$timestamp  = isset( $_REQUEST['wcs_timestamp'] ) ? $_REQUEST['wcs_timestamp'] : get_post_meta( $id, '_wcs_timestamp', true );
			$timestamp	= intval( $timestamp );
			$duration  	= get_post_meta( $id, '_wcs_duration', true );
			$status  		= get_post_meta( $id, '_wcs_status', true );

			$instructors_temp = get_the_terms( $id, 'wcs-instructor' );
			$instructors = array( null );

			if( is_array( $instructors_temp ) ){
				foreach( $instructors_temp as $instructor ){
					$separator = filter_var( preg_match( '/#/', $instructor->name ), FILTER_VALIDATE_BOOLEAN ) ? '&nbsp;' : ',';
					$instructors_list .= ! empty( $instructor->description ) && filter_var( $instructor->description, FILTER_VALIDATE_URL ) ? "<a href='" . esc_url_raw( $instructor->description ) . "'>{$instructor->name}</a>$separator " : ( empty( $instructor->description ) ? "{$instructor->name}$separator " : "<a href='#' class='wcs-modal-call' data-wcs-id='{$instructor->term_id}' data-wcs-method='1' data-wcs-type='wcs-instructor'>{$instructor->name}</a>$separator " );
				}
			}
			$instructors_list = substr( trim( $instructors_list ), 0, -1 );

			$locations_temp = get_the_terms( $id, 'wcs-room' );
			$locations = array( null );

			if( is_array( $locations_temp ) ){
				foreach( $locations_temp as $location ){
					$separator = filter_var( preg_match( '/#/', $location->name ), FILTER_VALIDATE_BOOLEAN ) ? '&nbsp;' : ',';
					$rooms_list .= ! empty( $location->description ) && filter_var( $location->description, FILTER_VALIDATE_URL ) ? "<a href='" . esc_url_raw( $location->description ) . "'>{$location->name}</a>$separator " : ( empty( $location->description ) ? "{$location->name}$separator " : "<a href='#' class='wcs-modal-call' data-wcs-id='{$location->term_id}' data-wcs-method='1' data-wcs-type='wcs-room'>{$location->name}</a>$separator "  );
				}
			}
			$rooms_list = substr( trim( $rooms_list ), 0, -1 );


			$types 	= get_the_terms( $id, 'wcs-type' );
			$types	= CurlyWeeklyClass::object_to_list( $types, 'name' );

			$temp = new DateTime();
			$temp->setTimestamp( $timestamp );

			$end = new DateTime();
			$end->setTimestamp( $timestamp + $duration * 60 );

			$period = $duration;

			$hours = floor( $duration / 60 );
			$minutes = $duration - floor( $duration / 60 ) * 60;

			$duration  = $hours > 0 ? sprintf( _n( '%sh', '%sh', $hours, 'WeeklyClass' ), $hours ) : '';
			$duration .= $minutes > 0 && $hours > 0 ? ' ' : '';
			$duration .= $minutes > 0 ? sprintf( __( '%d\'', 'WeeklyClass' ), $minutes ) : '';

			$image = wp_get_attachment_image_src( esc_attr( get_post_meta( $id, '_wcs_image_id', true )  ), 'large' );
			$image_path = esc_attr( get_post_meta( $id, '_wcs_image', true ) );

			if( $image === false && $image_path !== false ){
				$image = $image_path;
			} elseif( is_array( $image ) ){
				$image = $image[0];
			}

			$title = esc_attr( $post->post_title );
			$btn_label = isset( $post_meta['_wcs_action_label'] ) ? esc_attr( $post_meta['_wcs_action_label'][0] ) : '';
			$button = array();
			if( ! empty( $btn_label )  ){
				$gmt_offset 			=  get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;
				$button = array(
					'custom_url' 	=> isset( $post_meta['_wcs_action_custom'] ) ? esc_url_raw( $post_meta['_wcs_action_custom'][0] ) : false,
					'permalink'  	=> isset( $post_meta['_wcs_action_page'] ) ? get_permalink( esc_attr( $post_meta['_wcs_action_page'][0] ) ) : false,
					'label'				=> $btn_label,
					'email'				=> isset( $post_meta['_wcs_action_email'] ) ? esc_url( add_query_arg(
		        array(
		          'subject' => $title . ' - ' . date_i18n( 'F j, Y', $timestamp + $gmt_offset )
		        ),
		        'mailto:' . sanitize_email( esc_attr( $post_meta['_wcs_action_email'][0] ) )
		      ) ) : false,
					'method'			=> isset( $post_meta['_wcs_action_call'] ) ? intval( esc_attr( $post_meta['_wcs_action_call'][0] ) ) : false,
					'target'			=> isset( $post_meta['_wcs_action_target'] ) ? filter_var( esc_attr( $post_meta['_wcs_action_target'][0] ), FILTER_VALIDATE_BOOLEAN ) : false,
					'ical'				=> add_query_arg( array(
					    'start' 	=> $timestamp + $gmt_offset * -1,
					    'end' 		=> $timestamp + $period + $gmt_offset * -1,
					    'subject' => urlencode( $title ),
					    'desc'		=> urlencode( strip_tags( $post->_excerpt ) ),
					    'url'			=> urlencode( site_url('/') ),
					    'location'  => urlencode( get_bloginfo( 'name' ) ),
					    'name'		=> urlencode( sanitize_file_name( "$title $timestamp" ) )
					), site_url( '/?feed=wcs_ical' ) )
				);
			}

			if( ! empty( $button ) ){
				$target = $button['target'] ? '_blank' : '_self';
				$href = array( $button['permalink'], $button['custom_url'], $button['email'], $button['ical'] );
				$button = "<a class='wcs-btn--action wcs-btn' href='{$href[$button['method']]}' target='{$target}'>{$button['label']}</a>";
			} else{
				$button = '';
			}

			$map = null;
			$lat = get_post_meta( $id, WCS_PREFIX . '_latitude', true );
			$lon = get_post_meta( $id, WCS_PREFIX . '_longitude', true );

			if( ! empty( $lat ) && ! empty( $lon ) ){

				$map = array();

				$map['latitude'] = $lat;
				$map['longitude'] = $lon;

				$type 	= get_post_meta( $id, WCS_PREFIX . '_map_type', true );
				$theme 	= get_post_meta( $id, WCS_PREFIX . '_map_theme', true );
				$zoom 	= get_post_meta( $id, WCS_PREFIX . '_map_zoom', true );

				$map['type'] 	= ! empty( $type ) ? $type : 'roadmap';
				$map['theme'] = ! empty( $theme ) ? $theme : 'default';
				$map['zoom']	= ! empty( $zoom ) ? $zoom : 15;
			}

			$button_woo = $this->prepare_button_woo( $id, $timestamp );
			$special_color = esc_attr( get_option( 'wcs_single_color', '#BD322C' ) );

			if( ! wp_script_is( 'enqueue', 'wcs-single' ) )
				wp_enqueue_script( 'wcs-single' );


			$single_css	 	= "single-wcs-event--$single_layout";

			$starting_time = filter_var( $single_time_format, FILTER_VALIDATE_BOOLEAN ) ? date_i18n( 'g:i a',  $timestamp ) : date_i18n( 'H:i',  $timestamp );
			$ending_time 	 = filter_var( $single_time_format, FILTER_VALIDATE_BOOLEAN ) ? $end->format('g:i a') : $end->format('H:i');

			$before_content .= "<div id='single-wcs-event' class='$single_css'>";
			$before_content .= "<style type='text/css' scoped>.wcs-single__action .wcs-btn--action{ color: " . CurlyWeeklyClassShortcodes::contrast( $special_color, 1, 0.75 )  . "; background-color: $special_color }</style>";
			$before_content .= "<div class='wcs-single-left'>";

			$after_content .= filter_var( esc_attr( get_option( 'wcs_single_map', true ) ), FILTER_VALIDATE_BOOLEAN ) && ! empty( $map['longitude'] ) && ! empty( $map['latitude'] ) ? "<div class='wcs-map' data-wcs-map-type='{$map['type']}' data-wcs-map-theme='{$map['theme']}' data-wcs-map-zoom='{$map['zoom']}' data-wcs-map-lat='{$map['latitude']}' data-wcs-map-lon='{$map['longitude']}'></div>" : '';
			$after_content .= "</div><div class='wcs-single-right'>";
			$after_content .= $image ? "<img src='$image' class='wcs-single__image'>" : '';
			$after_content .= "<div class='wcs-single-right__content'><p class='wcs-single__date'>" . date_i18n( esc_attr( get_option( 'wcs_dateformat', 'F j' ) ),  $timestamp ) . "</p><p class='wcs-single__starting'>{$starting_time}</p>";
			$after_content .= filter_var( esc_attr( get_option( 'wcs_single_ending', true ) ), FILTER_VALIDATE_BOOLEAN ) ? "<p class='wcs-single__ending'> - {$ending_time}</p>" : '';
			$after_content .= filter_var( esc_attr( get_option( 'wcs_single_duration', true ) ), FILTER_VALIDATE_BOOLEAN ) ? "<span class='wcs-single__duration'>($duration)</span>" : '';
			$after_content .= filter_var( esc_attr( get_option( 'wcs_single_location', true ) ), FILTER_VALIDATE_BOOLEAN ) ? "<p class='wcs-single__location'>$rooms_list</p>" : '';
			$after_content .= filter_var( esc_attr( get_option( 'wcs_single_instructor', true ) ), FILTER_VALIDATE_BOOLEAN ) ? "<p class='wcs-single__instructor'>$instructors_list</p>" : '';
			$after_content .= "<p class='wcs-single__action'>$button $button_woo</p>";
			$after_content .= "</div>";
			$after_content .= "</div></div>";

			$content = $before_content.$content.$after_content;

		}

		return $content;

	}

}


?>
