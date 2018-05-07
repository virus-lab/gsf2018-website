(function ($) {
    'use strict';

    jQuery(document).ready(function ($) {
        console.log("GOO GOO");
        // Datepicker page
        $(".datetime_minutes").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });
    });

})(jQuery);
