<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dispatch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function allCcoordinates(){
        $coords = Dispatch::all();

        return response()->json($coords, 201);
    }

    public function storeCoordinates(Request $request){
        $fields = $request->validate([
            'lat' => 'required',
            'lng'=> 'required'
        ]);

        $coords = Dispatch::create($fields);

        return response()->json($coords, 201);
    }
}
