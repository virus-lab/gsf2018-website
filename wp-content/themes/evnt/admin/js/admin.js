/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function ($) {
    if ($("#event-date-id").length !== 0) {
        $("#event-date-id").datepicker({dateFormat: 'mm/dd/y'});
    }
    if ($("#wcs-options__dateformat").length !== 0) {
        $('#wcs-options__dateformat').dependsOn({

            'input[name*=view]': {
                values: ['0', '1', '2', '4', '6', '7']
            }

        });
    }
});