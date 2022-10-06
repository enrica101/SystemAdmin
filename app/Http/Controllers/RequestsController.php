<?php

namespace App\Http\Controllers;

use App\Models\RequestDispatch;
use App\Models\Requests;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function showRequests(){
        $requests = Requests::all();
        $dispatched_requests = RequestDispatch::all();

        $results = [
            'requests' => $requests,
            'dipatched_requests' => $dispatched_requests,
        ];

        return response()->json($results, 201);
    }

    // Create and store dispatch requests
    public function createDispatchRequest(Request $request){
        //Requests should have userID, request status (searching responder, responder otw, arrived at request site, to destination, complete)
   
        //insertion for 'requests' table
        $formFields = $request->validate([
            'requestType' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'status' => 'nullable',
        ]);
        $requestDetails = Requests::create($formFields);
        
        //Insertion for 'request_dispatch' table with foreign key 'userID'
        $requestDispatchFields = $request->validate(([
            'userID' => 'required',
        ]));
        
        $requestDispatchFields['requestID'] = $requestDetails->max('id');
        
        $requestDispatchDetails = RequestDispatch::create($requestDispatchFields);

            $response = [
                'requestDetails' => $requestDetails,
                'requestDispatch' => $requestDispatchDetails
            ];

            return response()->json($response, 201);
    }
}
