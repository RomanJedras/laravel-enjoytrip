<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Repositories/FrontendRepository.php ***  
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Repositories; 

use App\{TouristObject,City,Room}; 
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface {
    
    
    public function getObjectsForMainPage()
    {
		return TouristObject::with(['city','photos'])->ordered()->paginate(8);
    }

    public function getObject($id) {

    	return TouristObject::find($id);
    }

    public function getSearchCities( string $term)
    {
        return  City::where('name', 'LIKE', $term . '%')->get();               
    } 

     public function getSearchResults( string $city)
    {
        //return  City::where('name',$city)->get() ?? false;  
      return City::with(['rooms.reservations','rooms.photos','rooms.object.photos'])->where('name',$city)->first() ?? false;
    }

     public function getRoom($id)
    {
        // with - for mobile json
        return  Room::with(['object.address'])->find($id);
    }

     public function getReservationsByRoomId( $room_id )
    {
        return  Reservation::where('room_id',$room_id)->get(); 
    } 
  
}


