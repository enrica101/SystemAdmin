<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function generateID($identifier, $user){
    //     $prefix = '';
    //     $rightDigits = sprintf("%05u", intval($user));  //%u - Unsigned decimal number (equal to or greater than zero) 
    //     switch($identifier){
    //         case 'User' || 'Admin' || 'Responder':
    //             $prefix = 'u';
    //             break;
            
    //         case 'ResponderApp':
    //             $prefix = 'r';
    //             break;
            
    //         case 'Request':
    //             $prefix = 'req';
    //             break;

    //         default:
    //             return 4;
    //             break;
    //     }

    //     if(!empty($prefix)){
    //         $newID = $prefix.$rightDigits;
    //     }

    //     return $newID;
    // }
}
