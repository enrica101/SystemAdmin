<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRequest extends Model
{
    use HasFactory;
    protected $table = 'history_requests';
    protected $fillable = [
        'requestID',
        'userID',
        'responderID',
        'requestType',
        'lat',
        'lng',
        'status',
        // include timestamp "created date"
    ];

    public function requests(){
        return $this->belongsTo(Requests::class, 'requestID');
    }

    public function users(){
        return $this->belongsTo(User::class, 'userID');
    }

    public function responders(){
        return $this->belongsTo(Responder::class, 'responderID');
    }
}
