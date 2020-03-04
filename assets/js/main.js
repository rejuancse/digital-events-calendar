/* -------------------------------------  
1. Calendar Next Month
---------------------------------------- */
function getNextMonth(){
    $(".upcoming-events").addClass("loading-calendar");
    $('.calendar').addClass('spinner');
    var nextmonth = $("#nextmonth").attr("month");  
    var nextyear  = $("#nextmonth").attr("year");
    $.ajax({
        type: 'POST',
        url: ajax_objects.ajaxurl,
        data: { "action": "eventco_displaynextmonth", "nextmonth":nextmonth, "nextyear":nextyear, _nonce : ajax_objects.ajax_nonce},
        success: function(data){
           $(".upcoming-events").removeClass("loading-calendar");
           $('.calendar').removeClass('spinner');
           $("#calendar_area").html(data);
        }
    }); 
}

/* -------------------------------------  
2. Calendar Prev Month
---------------------------------------- */
function getPrevMonth(){
    $(".upcoming-events").addClass("loading-calendar");
    $('.calendar').addClass('spinner');
    var prevmonth = $("#premonth").attr("month");  
    var prevyear  = $("#premonth").attr("year"); 
    $.ajax({
        type: 'POST',
        url: ajax_objects.ajaxurl,
        data: { "action": "eventco_displaynextmonth","nextmonth":prevmonth,"nextyear":prevyear, _nonce : ajax_objects.ajax_nonce},
        success: function(data){
            $(".upcoming-events").removeClass("loading-calendar");
            $('.calendar').removeClass('spinner');
            $("#calendar_area").html(data);
        }
    }); 
}

// console.log('AA: Calendar', getPrevMonth());

jQuery(document).ready(function($){'use strict';

});
