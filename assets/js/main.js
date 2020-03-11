/* -------------------------------------  
|        Calendar Next Month
---------------------------------------- */
function getNextMonth() {
    jQuery(".upcoming-events").addClass("loading-calendar");
    jQuery('.calendar').addClass('spinner');
    var nextmonth = jQuery("#nextmonth").attr("month");  
    var nextyear  = jQuery("#nextmonth").attr("year");
    jQuery.ajax(
    {
        type: 'POST',
        url: ajax_objects.ajaxurl,
        data: { 
            "action": "ecalendar_displaynextmonth", 
            "nextmonth": nextmonth, 
            "nextyear": nextyear, 
            _nonce : ajax_objects.ajax_nonce
        },
        success: function(data){
           $(".upcoming-events").removeClass("loading-calendar");
           $('.calendar').removeClass('spinner');
           $("#calendar_area").html(data);
        }
    } ); 
}

/* -------------------------------------  
|           Calendar Prev Month
---------------------------------------- */
function getPrevMonth() {
    jQuery(".upcoming-events").addClass("loading-calendar");
    jQuery('.calendar').addClass('spinner');
    var prevmonth = jQuery("#premonth").attr("month");  
    var prevyear  = jQuery("#premonth").attr("year"); 
    jQuery.ajax(
    {
        type: 'POST',
        url: ajax_objects.ajaxurl,
        data: { 
            "action": "ecalendar_displaynextmonth",
            "nextmonth": prevmonth,
            "nextyear": prevyear, 
            _nonce : ajax_objects.ajax_nonce
        },
        success: function(data){
            jQuery(".upcoming-events").removeClass("loading-calendar");
            jQuery('.calendar').removeClass('spinner');
            jQuery("#calendar_area").html(data);
        }
    } ); 
}


jQuery(document).ready(function($){ 'use strict';

});