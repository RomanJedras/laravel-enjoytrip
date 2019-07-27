<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Repositories/FrontendRepository.php ***  
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Repositories; 

use App\TouristObject; 
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface {
    
    
    public function getObjectsForMainPage()
    {

        return TouristObject::all();
    } 
  
}


