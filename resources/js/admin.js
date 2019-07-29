/*
|--------------------------------------------------------------------------
| resources/js/admin.js *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

function datesBetween(startDt, endDt) {
    
    var between = [];
    var currentDate = new Date(startDt);
    var end = new Date(endDt);
    while (currentDate <= end) {
        between.push( $.datepicker.formatDate('mm/dd/yy',new Date(currentDate)) );
        currentDate.setDate(currentDate.getDate() + 1);
    }

    return between;
}


/* Lecture 30 */
/* Lecture 30 */
var Ajax = {

    get: function (url, success, data = null, beforeSend = null) {

        $.ajax({

            cache: false,
            url: base_url + '/' + url,
            type: "GET",
            data: data,
            success: function(response){
                
            App[success](response);
                
            },
            beforeSend: function(){
               
            if(beforeSend)    
            App[beforeSend]();
                
            }

        });
    }


};

/* Lecture 30 */
var App = {


    GetReservationData: function (id, date) {

        Ajax.get('ajaxGetReservationData?fromWebApp=1', 'AfterGetReservationData',{room_id: id, date: date},'BeforeGetReservationData'); /* Lecture 31 ?fromWebApp=1 */
        

    },
    BeforeGetReservationData: function() {
        
        
        
    },
    AfterGetReservationData: function(response) {
        
     
        
    }


};

