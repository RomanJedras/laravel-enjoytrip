<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Traits/Ajax.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Traits; /* Lecture 30 */

use Illuminate\Http\Request; /* Lecture 30 */

/* Lecture 30 */
trait Ajax {
    

    public function ajaxGetReservationData(Request $request)
    {

        $reservation = $this->bR->getReservationData($request);
            
        return response()->json([
                    'room_number' => $reservation->room->room_number,
                    'day_in' => $reservation->day_in,
                    'day_out' => $reservation->day_out,
                    'FullName' => $reservation->user->FullName,
                    'userLink' => route('person', ['id' => $reservation->user->id]),
                    'confirmResLink' => route('confirmReservation', ['id' => $reservation->id]),
                    'deleteResLink' => route('deleteReservation', ['id' => $reservation->id]),
                    'status' => $reservation->status
        ]);
        

    }

    
}

