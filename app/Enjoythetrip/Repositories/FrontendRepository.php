<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Repositories/FrontendRepository.php ***  
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Repositories; 

use App\{TouristObject,City}; 
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
        return  City::where('name',$city)->get() ?? false;  
    }
  
}


