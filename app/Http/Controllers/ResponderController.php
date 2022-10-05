<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
