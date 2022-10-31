<?php

namespace App\Http\Controllers;

use App\Models\HistoryRequest;
use App\Models\User;
use App\Models\Requests;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\RequestDispatch;

// TODO:
// - Create a request that will filter 
//   out all available request that are not 
//   been taken by a responder in response table

class RequestsController extends Controller
{
    //This will get all requests regardless being taken by a responder
    public function showRequests(){
        $requests = Requests::all();
        $dispatched_requests = RequestDispatch::all();

        $results = [
            'requests' => $requests,
            'dipatched_requests' => $dispatched_requests,
        ];

        return response()->json($results, 201);
    }

    public function allAvailableRequests(){
        $responseIds = [];
        $allResponses = Response::all();

        foreach($allResponses as $dataRow){
            array_push($responseIds,$dataRow->id);
        }
        
        $results = Requests::wherenotin('id', $responseIds)->get();
        return response()->json($results, 200);
    }

    // Create and store dispatch requests
    public function generateRequest(Request $request){
        
        $formFields = $request->validate([
            'requestType' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'status' => 'required',
        ]);
        if($formFields['status' == 'Cancelled']){
            $formFields['userID'] = $request['userID'];
            $requestDetails = HistoryRequest::create($formFields);

        }else {
            $requestDetails = Requests::create($formFields);
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

    public function updateRequest(Request $request){
        $accountInputs = $request->validate([
            'userID'=> 'required',
            'requestID'=> 'required',
        ]);

        $formFields = $request->validate([
            'lat' => 'nullable',
            'lng' => 'nullable',
            'status' => 'required',
        ]);

        $requester = RequestDispatch::where('requestID', $accountInputs['requestID'])->where('userID', $accountInputs['userID'])->first();

        if($requester==[]){
            return response([
                'message' => 'Incorrect Inputs'
            ], 404);
        }else{
            $user = User::where('id', $requester->userID)->first();
            $requestDispatch = Requests::where('id', $requester->requestID)->first();
            $requestDispatch->update($formFields);

            $response = [
                'user' => $user->id,
                'requestDispatch' => $requestDispatch
            ];

            return response($response, 200);
        }
        
    }
}
