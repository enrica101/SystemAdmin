<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requests;
use App\Models\Response;
use App\Models\Responder;
use Illuminate\Http\Request;

class ResponderController extends Controller
{
    // Create New Responder
    // public function createResponder(Request $request, User $id){
    //     $formInputs = $request->validate([
    //         // 'responderID' => 'nullable',
    //         'userID' => ['required'],
    //         'field' => ['required'],
    //         'lat' => ['required'],
    //         'lng' => ['required'],
            
    //     ]);

    //     $responder = Responder::create($formInputs);
    //     // $formInputs['responderID'] = Controller::generateID('ResponderApp', $responder->id());
    //     // dd($responder);
    //     // $responder->update($formInputs);
        
    //     return $responder; // 201 Created
    // }

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
            'status' => 'required',
        ]);
        $formInputs['status'] = 'Responder Found';
        $responder = Responder::where('id', $formInputs['responderID'])->first();
        $requestDispatch = Requests::where('id', $formInputs['requestID'])->first();
        //  == $requestDispatch->get('requestType')
        // if requestType of request and field of responder is equal then proceed hence abort error 403
       
        if($responder->field == $requestDispatch->requestType){
            $responderResponse = Response::create($formInputs);
            $response = [
                'responderResponse' => $responderResponse
            ];
            
            return response($response, 201); 
        }else{
            return response([
                'message' => 'Request Type and Responder Field does not match'
            ], 401);
        }
    }
}
