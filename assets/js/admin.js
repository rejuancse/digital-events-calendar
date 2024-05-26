jQuery(document).ready(function($){
    'use strict';

    $(function() {
        // Add Color Picker to all inputs that have 'color-field' class
        $( '#setting-event_primary_color, #setting-event_major_color, #setting-button_text_color, #setting-button_text_hover_color, #setting-button_BG_color' ).wpColorPicker();
    });
});
