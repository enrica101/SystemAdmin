<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDispatch extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'request_dispatch';
    protected $fillable = [
        'requestID',
        'userID',
        // include timestamp "created date"
    ];

    public function users(){
        return $this->belongsTo(User::class, 'userID');
    }

    public function requests(){
        return $this->belongsTo(Requests::class, 'requestID');
    }
}
