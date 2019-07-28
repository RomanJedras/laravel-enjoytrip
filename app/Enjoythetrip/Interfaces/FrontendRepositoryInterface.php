<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Interfaces/FrontendRepositoryInterface.php
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Interfaces; /* Lecture 13 */



interface FrontendRepositoryInterface   {
    
    
    public function getObjectsForMainPage();
    public function getObject($id);
  
}


