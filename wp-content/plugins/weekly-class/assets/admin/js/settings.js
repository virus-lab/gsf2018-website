(function($) {
	"use strict";
	
	
	$('.wcs-options--single-allow').dependsOn({
	    
	    '#wcs_single': {
	        checked: true
	    }
	    
	});
	
	$('.wcs-options--single').dependsOn({
	    
	    '#wcs_single': {
	        checked: true
	    },
	    'input[name="wcs_single_box"]': {
	        values: ['left', 'center', 'right']
	    }
	    
	});
	
	$('.wcs-options--map').dependsOn({
	    
	    '#wcs_single': {
	        checked: true
	    },
	    '#wcs_map': {
	        checked: true
	    }
	    
	});
	
	$(function() {
		
		$('.wp-color-picker-field').wpColorPicker();
		
	});	

	
})(jQuery);