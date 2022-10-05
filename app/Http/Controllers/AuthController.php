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
                
            ]);

            // Hash Password
            $formInputs['password'] = bcrypt($formInputs['password']);
            
            if($request->hasFile('avatar')){
                    $formInputs['avatar'] = $request->file('avatar')->store('avatars', 'public');
                }

            $user = User::create($formInputs);
            // $formInputs['uuid'] = Controller::generateID($user->accountType, $user->max('userID'));
            // $user->update($formInputs);

            if($request['accountType'] == 'Responder'){
                $responderInputs = $request->validate([
                    'userID'  => 'nullable',
                    'field'  => 'required',
                    'lat'  => 'required',
                    'lng'  => 'required',
                ]);

            $responderInputs['userID'] = $user->max('userID');

            $responder = Responder::create($responderInputs);
            }else{
                $responder='';
            }
            
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            if(!empty($responder)){
                $response = [
                    'user' => $user,
                    'responder' => $responder,
                    'token' => $token
                ];
            }

            return response()->json($response,201); // 201 Created
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

        public function createResponder(Request $request, User $user){
            $formInputs = $request->validate([
                'field' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                
            ]);


            $responder = Responder::create($formInputs);
            $formInputs['uuid'] = Controller::generateID(auth()->user()->accountType, auth()->id());

            $user->update($formInputs);
            
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response()->json($response,201); // 201 Created

        }
    
}
