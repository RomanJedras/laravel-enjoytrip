<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;
use App\Enjoythetrip\Gateways\FrontendGateway;

class FrontendController extends Controller
{
    //

    private $fR;
    private $fG;


    public function __construct(FrontendRepositoryInterface $frontendRepository,FrontendGateway $frontendGateway)
    {
        $this->fR = $frontendRepository;
        $this->fG = $frontendGateway;
    }

   	public function index()
    {
    $objects = $this->fR->getObjectsForMainPage();
        //dd($objects);
       return view('frontend.index')->with('objects',$objects);
    }
    
    
    public function article()
    {
        return view('frontend.article');
    }
    
    
    public function object($id)
    {
      $object = $this->fR->getObject($id);

        return view('frontend.object')->with('object',$object);
    }
    
    
    public function person()
    {
        return view('frontend.person');
    }
    
    
    public function room($id)
    {

        $room = $this->fR->getRoom($id);
        return view('frontend.room')->with('room',$room);
    }
    
     public function ajaxGetRoomReservations($id)
    {
        
        $reservations = $this->fR->getReservationsByRoomId($id);
        
        return response()->json([
            'reservations'=>$reservations
        ]);
    }
    
    public function roomsearch(Request $request)
    {

         if($city = $this->fG->getSearchResults($request))
        {
            //dd($city);
            return view('frontend.roomsearch',['city'=>$city]);
        }
        else
        {
            if (!$request->ajax())
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
        }
    }


     public function searchCities(Request $request)
    {

        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }

}
