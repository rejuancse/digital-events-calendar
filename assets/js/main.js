/* -------------------------------------  
1. Calendar Next Month
---------------------------------------- */
function getNextMonth(){
    jQuery(".upcoming-events").addClass("loading-calendar");
    jQuery('.calendar').addClass('spinner');
    var nextmonth = jQuery("#nextmonth").attr("month");  
    var nextyear  = jQuery("#nextmonth").attr("year");
    jQuery.ajax({
        type: 'POST',
        url: eajax_objects.ajaxurl,
        data: { 
            "action": "edisplaynextmonth", 
            "nextmonth":nextmonth, 
            "nextyear":nextyear, 
            _nonce : eajax_objects.ajax_nonce 
        },
        success: function(data){
           jQuery(".upcoming-events").removeClass("loading-calendar");
           jQuery('.calendar').removeClass('spinner');
           jQuery("#calendar_area").html(data);
        }
    }); 
}

/* -------------------------------------  
2. Calendar Pre Month
---------------------------------------- */
function getPrevMonth(){
    jQuery(".upcoming-events").addClass("loading-calendar");
    jQuery('.calendar').addClass('spinner');
    var prevmonth = jQuery("#premonth").attr("month");  
    var prevyear  = jQuery("#premonth").attr("year"); 
    jQuery.ajax({
        type: 'POST',
        url: eajax_objects.ajaxurl,
        data: { 
            "action": "edisplaynextmonth",
            "nextmonth":prevmonth,
            "nextyear":prevyear, 
            _nonce : eajax_objects.ajax_nonce 
        },
        success: function(data){
            jQuery(".upcoming-events").removeClass("loading-calendar");
            jQuery('.calendar').removeClass('spinner');
            jQuery("#calendar_area").html(data);
        }
    }); 
}