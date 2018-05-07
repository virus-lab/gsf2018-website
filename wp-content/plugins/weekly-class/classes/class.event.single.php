<?php

class CurlyWeeklyClassEvent {

	private $_id;
	private $_title;
	private $_timestamp;
	private $_repeat;
	private $_duration;
	private $_cancel;
	private $_end;
	private $_status;
	private $_post_meta;
	private $_out;
	private $_defaults;
	private $_terms;
	private $_excerpt;

	public function __construct( $id, $title, $start, $end, $terms, $excerpt ){

		$this->_id = $id;
		$this->_title = $title;
		$this->_status = 0;
		$this->_post_meta = get_post_meta( $id );
		$this->_out = array();
		$this->_timestamp = isset( $this->_post_meta['_wcs_timestamp'][0] ) ? intval( $this->_post_meta['_wcs_timestamp'][0] ) : false;
		$this->_duration 	= isset( $this->_post_meta['_wcs_duration'][0] ) ? intval( $this->_post_meta['_wcs_duration'][0] ) : 0;
		$this->_status 		= isset( $this->_post_meta['_wcs_status'][0] ) ? intval( $this->_post_meta['_wcs_status'][0] ) : 0;
		$this->_end 			= $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS;
		$this->_repeat 		= isset( $this->_post_meta['_wcs_interval'][0] ) && intval( $this->_post_meta['_wcs_interval'][0] ) === 1 ? true : false;
		$this->_terms 		= $terms;
		$this->_excerpt		= $excerpt;
		$gmt_offset 			=  get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;

		/** Repeatable Event */
		if( $this->_repeat ){

			if( $end - $start <= 7 * WEEK_IN_SECONDS ){
				$end = isset( $this->_post_meta['_wcs_repeat_until'][0] ) && ! empty( $this->_post_meta['_wcs_repeat_until'][0] ) ? strtotime( $this->_post_meta['_wcs_repeat_until'][0] ) + DAY_IN_SECONDS : $end;
				$past_timestamp = $this->_timestamp - WEEK_IN_SECONDS;
				while( $past_timestamp >= $start && $past_timestamp <= $end ){
					array_push( $this->_out, array(
						'title' => $this->_title,
						'hash'	=> hash( 'md5', $this->_id . date_i18n( 'c', $past_timestamp ) ),
						'visible' => $this->exists( $past_timestamp ),
						'id'		=> $this->_id,
						'timestamp' => $past_timestamp,
						'thumbnail' => $this->get_thumbnail(),
						'duration' => $this->get_duration(),
						'terms'			=> $this->get_terms(),
						'period'		=> $this->_duration,
						'excerpt'		=> $this->_excerpt,
						'start' => date_i18n( 'c', $past_timestamp ),
						'end' 	=> date_i18n( 'c', $past_timestamp + $this->_duration * MINUTE_IN_SECONDS ),
						'future' => $past_timestamp  >= current_time('timestamp') ? true : false,
						'finished' =>  $past_timestamp + $this->_duration * MINUTE_IN_SECONDS  < current_time('timestamp') ? true : false,
						'permalink' => add_query_arg( 'wcs_timestamp', $past_timestamp, get_the_permalink( $this->_id ) ),
						'buttons' => $this->prepare_buttons( $past_timestamp, $past_timestamp + $this->_duration * MINUTE_IN_SECONDS )
					) );
					$past_timestamp -= WEEK_IN_SECONDS;
				}
				while( $this->_timestamp <= $end ){
					if( $this->_timestamp >= $start ){
						array_push( $this->_out, array(
							'title' => $this->_title,
							'hash'	=> hash( 'md5', $this->_id . date_i18n( 'c', $this->_timestamp ) ),
							'visible' => $this->exists( $this->_timestamp ),
							'id'		=> $this->_id,
							'timestamp' => $this->_timestamp,
							'thumbnail' => $this->get_thumbnail(),
							'duration' => $this->get_duration(),
							'terms'			=> $this->get_terms(),
							'period'		=> $this->_duration,
							'excerpt'		=> $this->_excerpt,
							'start' => date_i18n( 'c', $this->_timestamp ),
							'end' 	=> date_i18n( 'c', $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS ),
							'future' => $this->_timestamp >= current_time('timestamp') ? true : false,
							'finished' => $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS < current_time('timestamp') ? true : false,
							'permalink' => add_query_arg( 'wcs_timestamp', $this->_timestamp, get_the_permalink( $this->_id ) ),
							'buttons' => $this->prepare_buttons( $this->_timestamp, $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS )
						) );
					}
					$this->_timestamp += WEEK_IN_SECONDS;
				}
			}

		}

		/** Single Event */
		else {

			if( $this->_timestamp >= $start && $this->_timestamp <= $end ){

				array_push( $this->_out, array(
					'title' => $this->_title,
					'id'		=> $this->_id,
					'visible' => $this->exists( $this->_timestamp ),
					'timestamp' => $this->_timestamp,
					'thumbnail' => $this->get_thumbnail(),
					'duration' => $this->get_duration(),
					'terms'		=> $this->get_terms(),
					'period'		=> $this->_duration,
					'excerpt'		=> $this->_excerpt,
					'hash'	=> hash( 'md5', $this->_id . date_i18n( 'c', $this->_timestamp ) ),
					'start' => date_i18n( 'c', $this->_timestamp ),
					'end' 	=> date_i18n( 'c', $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS ),
					'permalink' => add_query_arg( 'wcs_timestamp', $this->_timestamp, get_the_permalink( $this->_id ) ),
					'future' => $this->_timestamp >= current_time('timestamp') ? true : false,
					'finished' => $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS < current_time('timestamp') ? true : false,
					'buttons' => $this->prepare_buttons( $this->_timestamp, $this->_timestamp + $this->_duration * MINUTE_IN_SECONDS )
				) );

			}

		}

	}

	function get_terms(){

		$taxonomies = WeeklyClass::get_object_taxonomies( 'class', 'objects' );

		$data = $list = array();

		foreach( $taxonomies as $tax => $taxonomy ){
			//$list[$tax] = '';
			$terms = get_the_terms( $this->_id, $tax );
			if( is_array( $terms ) ) {
				foreach( $terms as $key => $term ){
					$data_array = array(
						'slug' => $term->slug,
						'id' => $term->term_id,
						'url' =>  ! empty( $term->description ) && filter_var( $term->description, FILTER_VALIDATE_URL ) ? esc_url_raw( $term->description ) : null,
						'desc' => ! empty( $term->description ) && ! filter_var( $term->description, FILTER_VALIDATE_URL ) ? true : false,
						'name' => $term->name
					);
					//$list[$tax] .= $term->name.',';
					if( isset( $data[ str_replace('-','_',$tax) ] ) ){
						$data[str_replace('-','_',$tax)][] = $data_array;
					}
					else{
						$data[str_replace('-','_',$tax)] = array( $data_array );
					}
				}
				//$list[$tax] = substr(trim($list[$tax] ), -1);
			}

		}
		return $data;
	}

	function get_duration(){
		/** Set duration */
		$hours = floor( $this->_duration / 60 );
		$minutes = $this->_duration - floor( $this->_duration / 60 ) * 60;

		$duration  = $hours > 0 ? sprintf( _n( '%sh', '%sh', $hours, 'WeeklyClass' ), $hours ) : '';
		$duration .= $minutes > 0 && $hours > 0 ? ' ' : '';
		$duration .= $minutes > 0 ? sprintf( __( '%d\'', 'WeeklyClass' ), $minutes ) : '';
		return $duration;
	}

	function get_thumbnail(){
		$image = isset( $this->_post_meta['_wcs_image_id'][0] ) ? wp_get_attachment_image_src( esc_attr( $this->_post_meta['_wcs_image_id'][0] ), 'large' ) : false;
		$image_path = isset( $this->_post_meta['_wcs_image'][0] ) ? esc_url( $this->_post_meta['_wcs_image'][0] ) : false;

		if( $image === false && $image_path !== false ){
			$image = $image_path;
		} elseif( is_array( $image ) ){
			$image = $image[0];
			$imaze_size = "width='{$image[1]}' height='{$image[2]}'";
		}
		return $image;
	}

	public function get_terms_list(){
		$term_list = '';
		foreach( $this->_terms as $key => $term ){
			$term_list += $term->name . ', ';
		}
		$term_list = substr(trim( $term_list ), 0 , -1);
		return $term_list;
	}

	public function prepare_buttons( $timestamp, $timestamp_ending){

		$buttons = array();
		$id = $this->_id;
		$title = $this->_title;

		$btn_label		= isset( $this->_post_meta['_wcs_action_label'] ) ? esc_attr( $this->_post_meta['_wcs_action_label'][0] ) : '';
		$gmt_offset 	=  get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;

		/** Main Button */
		if( ! empty( $btn_label ) ){
			$buttons['main'] = array(
				'custom_url' 	=> isset( $this->_post_meta['_wcs_action_custom'] ) ? esc_url_raw( $this->_post_meta['_wcs_action_custom'][0] ) : false,
				'permalink'  	=> isset( $this->_post_meta['_wcs_action_page'] ) ? get_permalink( esc_attr( $this->_post_meta['_wcs_action_page'][0] ) ) : false,
				'label'				=> $btn_label,
				'email'				=> isset( $this->_post_meta['_wcs_action_email'] ) ? esc_url( add_query_arg(
	        array(
	          'subject' => $title . ' - ' . date_i18n( 'm/d @ H:i', $timestamp + $gmt_offset )
	        ),
	        'mailto:' . sanitize_email( esc_attr( $this->_post_meta['_wcs_action_email'][0] ) )
	      ) ) : false,
				'method'			=> isset( $this->_post_meta['_wcs_action_call'] ) ? intval( esc_attr( $this->_post_meta['_wcs_action_call'][0] ) ) : false,
				'target'			=> isset( $this->_post_meta['_wcs_action_target'] ) ? filter_var( esc_attr( $this->_post_meta['_wcs_action_target'][0] ), FILTER_VALIDATE_BOOLEAN ) : false,
				'ical'				=> add_query_arg( array(
				    'start' 	=> $timestamp + $gmt_offset * -1,
				    'end' 		=> $timestamp_ending + $gmt_offset * -1,
				    'subject' => urlencode( $title ),
				    'desc'		=> urlencode( strip_tags( $this->_excerpt ) ),
				    'url'			=> urlencode( site_url('/') ),
				    'location'  => urlencode( get_bloginfo( 'name' ) . ' @ ' . $this->get_terms_list() ),
				    'name'		=> urlencode( sanitize_file_name( "$title $timestamp" ) )
				), site_url( '/?feed=wcs_ical' ) )
			);
		}


		/** Woo Button */
		if( WCS_WOO && $this->exists( $timestamp ) ){

			$woo_booking_capacity = isset( $this->_post_meta[ WCS_PREFIX . '_woo_capacity' ] ) ? $this->_post_meta[ WCS_PREFIX . '_woo_capacity' ][0] : '';
			$woo_booking_label 		= isset( $this->_post_meta[ WCS_PREFIX . '_woo_label' ] ) ? $this->_post_meta[ WCS_PREFIX . '_woo_label' ][0] : '';
			$woo_booking_product 	= isset( $this->_post_meta[ WCS_PREFIX . '_woo_product' ] ) ? $this->_post_meta[ WCS_PREFIX . '_woo_product' ][0] : '';
			$woo_booking_history 	= isset( $this->_post_meta[ '_' . WCS_PREFIX . '_woo_history' ] ) ? $this->_post_meta[ '_' . WCS_PREFIX . '_woo_history' ][0] : '';

			if( ! empty( $woo_booking_label ) && ! empty( $woo_booking_capacity ) && ! empty( $woo_booking_product ) && intval( $woo_booking_capacity ) > 0 ){

				$product = wc_get_product( $woo_booking_product );

				if( is_object( $product ) && $product->is_purchasable() ){
					$total = 0;

					/** Check for previous orders */
					if( ! empty( $woo_booking_history ) ){
						$history = maybe_unserialize( $woo_booking_history );
						if( isset( $history[$timestamp] ) ){
							$orders = $history[$timestamp];
							foreach( $orders as $ord ){
								$order = wc_get_order( $ord );
								if( ! in_array( $order->get_status(), array( 'cancelled', 'refunded', 'rejected', 'failed' ) ) ){
									$items = $order->get_items();
									foreach( $items as $item ){
										if( intval( $item['product_id'] ) === intval( $woo_booking_product ) && isset( $item["item_meta"]['_wcs_event'] ) && intval( $item["item_meta"]['_wcs_event'][0] ) === intval( $id ) && isset( $item["item_meta"]['_wcs_timestamp'] ) && intval( $item["item_meta"]['_wcs_timestamp'][0] ) === intval( $timestamp ) ){
											$total += $item['qty'];
										}
									}
								}
							}
						}
					}

					/** Check for no capacity */
					if( ( intval( $woo_booking_capacity ) - $total ) <= 0 ){
						$woo_booking_label_sold = isset( $this->_post_meta['_woo_label_sold'] ) ? $this->_post_meta['_woo_label_sold'][0] : '';
						if( ! empty( $woo_booking_label_sold ) ){
							$woo_booking_label_sold_link = isset($this->_post_meta['_woo_label_sold_link']) ? $this->_post_meta['_woo_label_sold_link'][0] : '';
							if( ! empty( $woo_booking_label_sold_link ) ){
								$buttons['woo'] = array(
									'href' => $woo_booking_label_sold_link,
									'classes' => 'wcs-btn wcs-btn--sold-out wcs-btn--action',
									'label'	=> $woo_booking_label_sold,
									'status' => true
								);
							} else {
								$buttons['woo'] = array(
									'classes' => 'wcs-btn wcs-btn--disabled wcs-btn--sold-out',
									'label'	=> $woo_booking_label_sold,
									'status' => false
								);
							}
						}

					}
					/** If capacity is allowed */
					else {

						global $woocommerce;

						$direction = esc_attr( WC_Admin_Settings::get_option( 'wc_settings_tab_wcs_redirect', 0 ) );

						$buttons['woo'] = array(
							'href' => add_query_arg( array(
								'add-to-cart' => $woo_booking_product,
								'event' => $id,
								'timestamp' => $timestamp
							), intval( $direction ) === 0 ? $woocommerce->cart->get_cart_url() : $woocommerce->cart->get_checkout_url() ),
							'classes' => 'wcs-btn wcs-btn--action',
							'label'	=> $woo_booking_label,
							'status' => true
						);
					}

				}

			}

		}

		return $buttons;

	}

	public function exists( $timestamp ){

		if( $this->_status === 1 )
			return false;

		if( $this->_status === 2 ){
/*
			$canceled = isset( $this->_post_meta['_wcs_canceled'] ) ? maybe_unserialize( $this->_post_meta['_wcs_canceled'][0] ) : array();

			if( ! empty( $canceled ) ) : foreach( $canceled as $not ){

				if( $timestamp >= strtotime( $not ) && $timestamp < strtotime( $not ) + DAY_IN_SECONDS ){
					return false;
				}

			} endif;*/

		}

		return true;

	}

	public function render(){
		return $this->_out;
	}

}

?>
