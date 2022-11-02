<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requests;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\HistoryRequest;
use App\Models\RequestDispatch;
use Illuminate\Validation\Rule;

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
            'lat' => ['required', Rule::unique('requests', 'lat')],
            'lng' => ['required', Rule::unique('requests', 'lng')],
            'status' => 'required',
        ]);
       
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
            ], 400);
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

    public function archiveDispatchRequest(Request $request){

        $requestInfo = Requests::where('id', $request['requestID'])->first();
        if(!empty($requestInfo)){
            $inputs = $request->validate([
                'requestID' => ['required', Rule::unique('history_requests', 'requestID')],
                'requestType' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'status' => 'required',
            ]);
            
            if($requestInfo->status == $inputs['status'] && $requestInfo->status == 'Completed' ||  $requestInfo->status == 'Cancelled' ){
                $archiveRequestDetails = HistoryRequest::create($inputs);
    
                return response()->json($archiveRequestDetails, 201);
            }else{
                return response([
                    'message' => "Status input is incorrect for archiving a request.'"
                ], 400);
            }
        }else{
            return response([
                'message' => "This request does not exists."
            ], 404);
        }
    }

    // Return all history request of a user
    public function getProfileHistoryRequest(Request $request){
        $inputs = $request->validate([
            'userID' => 'required',
        ]);

        $userRequestDispatches = RequestDispatch::where('userID', $inputs['userID'])->get();
        $allRequestsIDs = [];
        foreach($userRequestDispatches as $eachRequest){
            array_push($allRequestsIDs, $eachRequest->requestID);
        }
        $allRequestsbyProfile = [];
        for($count = 0; $count<count($allRequestsIDs);$count++){
            $requestInfo = Requests::where('id', $allRequestsIDs[$count])->first();
            array_push($allRequestsbyProfile, $requestInfo->getAttributes());
        }

        return response()->json($allRequestsbyProfile, 200);
    }

    public function forceCancel(Request $request){
        $inputs = $request->validate([
            'requestID' => ['required', Rule::unique('history_requests', 'requestID')],
            'responderID' => 'required',
            'status' => 'required',
        ]);

        $responseInput = $request->validate([
            'status' => 'required',
        ]);
        $responseInput['status'] = 'Cancelled';

        $responderHandling = Response::where('responderID', $inputs['responderID'])->first();
        if(!empty($responderHandling)){
            $requestInfo = Requests::where('id', $responderHandling->requestID)->first();
            $updatedRequest = $requestInfo->update($responseInput);
            // dd($requestInfo->getAttributes());
            $cancelledRequest = HistoryRequest::create([
                'requestID' => $requestInfo->id,
                'requestType' => $requestInfo->requestType,
                'lat' => $requestInfo->lat,
                'lng' => $requestInfo->lng,
                'status' => $requestInfo->status,
            ]);

            return response()->json($cancelledRequest->getAttributes(),201);
        }
        
    }
}
