<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responder extends Model
{
    use HasFactory;
    protected $table = 'responders';
    protected $fillable = [
        'userID',
        'field',
        'lat',
        'lng',
    ];

    public function users(){
        return $this->hasMany(User::class, 'userID');
    }

    public function responses(){
        return $this->hasMany(Response::class, 'id');
    }

    public function historyRequests(){
        return $this->hasMany(HistoryRequest::class, 'id');
        
    }
}
