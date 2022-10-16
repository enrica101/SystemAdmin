<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Requests;
use App\Models\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function allRequests(){
        $coords = Requests::all();

        return response()->json($coords, 201);
    }

    public function storeRequest(Request $request){
        
        $fields = $request->validate([
            'requestType' => 'required',
            'lat' => 'required',
            'lng'=> 'required',
        ]);

        $requestDetails = Requests::create($fields);

        return response()->json($requestDetails, 201);
    }

        // Create New User
        public function register(Request $request){
            
            $formInputs = $request->validate([
                'accountType' => ['required'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'confirmed', 'min:6'],
                'fname' => ['required', 'min:3'],
                'mname' => ['nullable', 'min:3'],
                'lname' => ['required', 'min:3'],
                'gender' => ['required'], //male or female
                'birthdate' => ['required'], //yyyy-mm-dd
                'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')], // validation for 09 or +639
                'avatar'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'remember_token' => 'nullable'
                
            ]);

            // Hash Password
            $formInputs['password'] = bcrypt($formInputs['password']);
            
            if($request->hasFile('avatar')){
                    $formInputs['avatar'] = $request->file('avatar')->store('avatars', 'public');
                }
        
            $user = User::create($formInputs, true);
            $token = $user->createToken('myapptoken')->plainTextToken;
            $formInputs['remember_token'] = $token;
            $user->update($formInputs);


            if($request['accountType'] == 'Responder'){
                $responderInputs = $request->validate([
                    'userID'  => 'nullable', 
                    'field'  => 'required',
                    'lat'  => 'required', //upon remova
                    'lng'  => 'required',//upon removal
                ]);  
         

            $responderInputs['userID'] = $user->max('id');

            $responder = Responder::create($responderInputs);
            } 
            
        
            if(!empty($responder)){
                $response = [
                    'user' => $user,
                    'responder' => $responder,
                    'token' => $token
                ];
            }else{
                $response = [
                    'user' => $user,
                    'token' => $token
                ];
            }
           
  
    return response($response,201); // 201 Created
}

         // Authenticate User
        public function login(Request $request){
            $formInputs = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            $user = User::where('email', $formInputs['email'])->first();

            // Check password
            if(!$user || !Hash::check($formInputs['password'], $user->password)){
                return response([
                    'message' => 'Incorrect Credentials'
                ], 401);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
        }

        public function logout() {
            auth()->user()->tokens()->delete();
            $response = [
                'message' => 'Logged out'
            ];

            return response($response, 201);
        }
    
}
