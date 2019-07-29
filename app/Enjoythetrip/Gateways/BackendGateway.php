<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Gateways/BackendGateway.php 
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Gateways;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; 



class BackendGateway { 
    

    public function __construct(BackendRepositoryInterface $bR ) 
    {
        $this->bR = $bR;
    }
    
    
    
    public function getReservations($request)
    {
        if ($request->user()->hasRole(['owner','admin']))
        {

            $objects = $this->bR->getOwnerReservations($request);

            

        }
        else
        {
            
            $objects = $this->bR->getTouristReservations($request);
        }
        
        return $objects;
    }
    

}


