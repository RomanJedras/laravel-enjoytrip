<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Gateways/FrontendGateway.php 
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Gateways;

use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface; 


class FrontendGateway { 

    private $fr;

    use \Illuminate\Foundation\Validation\ValidatesRequests;
    
    public function __construct(FrontendRepositoryInterface $fR ) 
    {
        $this->fR = $fR;
    }

     public function getReservationsByRoomId( $room_id )
    {
        return  Reservation::where('room_id',$room_id)->get(); 
    } 
    
    
    
    public function searchCities($request)
    {
        $term = $request->input('term');

        $results = array();

        $queries = $this->fR->getSearchCities($term);

        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $results;
    }


     public function getSearchResults($request)
    {

        if( $request->input('city') != null)
        {

             $dayin = date('Y-m-d', strtotime($request->input('check_in')));
             $dayout = date('Y-m-d', strtotime($request->input('check_out')));

            $result = $this->fR->getSearchResults($request->input('city'));

            if($result)
            {

                
                foreach ($result->rooms as $k=>$room)
                {
                   if( (int) $request->input('room_size') > 0 )
                   {
                        if($room->room_size != $request->input('room_size'))
                        {
                            $result->rooms->forget($k);
                        }
                   }

                    foreach($room->reservations as $reservation)
                    {

                        if( $dayin >= $reservation->day_in
                            &&  $dayin <= $reservation->day_out
                        )
                        {
                            $result->rooms->forget($k);
                        }
                        elseif( $dayout >= $reservation->day_in
                            &&  $dayout <= $reservation->day_out
                        )
                        {
                            $result->rooms->forget($k);
                        }
                        elseif( $dayin <= $reservation->day_in
                            &&  $dayout >= $reservation->day_out
                        )
                        {
                            $result->rooms->forget($k);
                        }

                    }

                }

                
                if(count($result->rooms)> 0)
                return $result;  // filtered result
                else return false;

            }

        }
        
        return false;

    }

     public function addComment($commentable_id, $type, $request)
    {
        $this->validate($request,[
            'content'=>"required|string"
        ]);
        
        return $this->fR->addComment($commentable_id, $type, $request);
    }


    public function checkAvaiableReservations($room_id, $request)
    {

        $dayin = date('Y-m-d', strtotime($request->input('checkin')));
        $dayout = date('Y-m-d', strtotime($request->input('checkout')));

        $reservations = $this->fR->getReservationsByRoomId($room_id);

        $avaiable = true;
        foreach($reservations as $reservation)
        {
            if( $dayin >= $reservation->day_in
                &&  $dayin <= $reservation->day_out
            )
            {
                $avaiable = false;break;
            }
            elseif( $dayout >= $reservation->day_in
                &&  $dayout <= $reservation->day_out
            )
            {
                $avaiable = false;break;
            }
            elseif( $dayin <= $reservation->day_in
                &&  $dayout >= $reservation->day_out
            )
            {
                $avaiable = false;break;
            }
        }

        return $avaiable;
    }


     public function makeReservation($room_id, $city_id, $request)
    {
        $this->validate($request,[
            'checkin'=>"required|string",
            'checkout'=>"required|string"
        ]);
        
        return $this->fR->makeReservation($room_id, $city_id, $request);
    }

}


