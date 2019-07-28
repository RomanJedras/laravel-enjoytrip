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
    
    public function __construct(FrontendRepositoryInterface $fR ) 
    {
        $this->fR = $fR;
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

            $result = $this->fR->getSearchResults($request->input('city'));

            if($result)
            {

                // to do: filter results based on check in and check out etc.

                $request->flash(); // inputs for session for one request

                return $result; // filtered result

            }

        }
        
        return false;

    }
     

}


