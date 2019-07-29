/*
|--------------------------------------------------------------------------
| resources/js/admin.js *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

/* Lecture 32 */
function datesBetween(startDt, endDt) {
    console.log(startDt);
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


    GetReservationData: function (id, calendar_id, date) {

        App.calendar_id = calendar_id;
        Ajax.get('ajaxGetReservationData?fromWebApp=1', 'AfterGetReservationData',{room_id: id, date: date},'BeforeGetReservationData'); /* Lecture 31 ?fromWebApp=1 */
        

    },
    BeforeGetReservationData: function() {
        
       
    $('.loader_' + App.calendar_id).hide();
    $('.hidden_' + App.calendar_id).show(); 
        
  
    },
    AfterGetReservationData: function(response) {
        
        
        $('.hidden_' + App.calendar_id + " .reservation_data_room_number").html(response.room_number); /* Lecture 32 */
        
        $('.hidden_' + App.calendar_id + " .reservation_data_day_in").html(response.day_in); /* Lecture 33 */
        $('.hidden_' + App.calendar_id + " .reservation_data_day_out").html(response.day_out); /* Lecture 33 */
        $('.hidden_' + App.calendar_id + " .reservation_data_person").html(response.FullName); /* Lecture 33 */
        $('.hidden_' + App.calendar_id + " .reservation_data_person").attr('href', response.userLink); /* Lecture 33 */
        $('.hidden_' + App.calendar_id + " .reservation_data_delete_reservation").attr('href', response.deleteResLink); /* Lecture 33 */

    
        if (response.status)
        {
            $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").removeAttr('href');
            $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").attr('disabled', 'disabled');

        } else
        {
            $('.hidden_' + App.calendar_id + " .reservation_data_confirm_reservation").attr('href', response.confirmResLink);
        }

        
    }


};

