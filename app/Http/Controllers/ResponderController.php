<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Responder;
use Illuminate\Http\Request;
use App\Models\RequestDispatch;
use App\Models\Requests;

class ResponderController extends Controller
{

    public function updateLocation(Request $request){
        
        $accountInputs = $request->validate([
            'id'=> 'required',
        ]);

        $locationInputs = $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $responder = Responder::where('id', $accountInputs['id']);
        $responder->update($locationInputs);
    
        return response($responder->get(), 200);
    }


    public function createResponse(Request $request){
        $formInputs = $request->validate([
            'requestID' => 'required',
            'responderID' => 'required',
            'status' => 'nullable'
        ]);

        $requestInputs = $request->validate([
            'status' => 'nullable',
        ]);

        $formInputs['status'] = 'You got a request!';
        $requestInputs['status'] = 'Responder Found!';
        $responder = Responder::where('id', $formInputs['responderID'])->first();
        $requestDispatch = Requests::where('id', $formInputs['requestID'])->first();
        $requestor = RequestDispatch::where('requestID', $formInputs['requestID'])->first();

        if($requestDispatch->status == 'Cancelled' || $requestDispatch->status == 'Completed'){
            return response(['message' => 'This request is archived.'], 401);
            
        }else{
            if($responder->field == $requestDispatch->requestType){
                $responderResponse = Response::create($formInputs);
                $requestRow = $requestDispatch->update($requestInputs);
                $response = [
                    'userID' => $requestor->id,
                    'responderResponse' => $responderResponse,
                ];
                
                return response($response, 201); 
            }else{
                return response(['message' => 'Request Type and Responder Field does not match.'], 401);
            }
        }
    }
}
