<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';
    protected $fillable = [
        'responderID',
        'requestID',
        'status',
        // include timestamp "created date"
    ];

    public function requests(){
        return $this->belongsTo(Requests::class, 'requestID');
    }

    public function responders(){
        return $this->belongsTo(Responder::class, 'responderID');
    }
}
