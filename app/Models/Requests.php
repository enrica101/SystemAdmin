<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'requestType',
        'lat',
        'lng',
        'status',
    ];

    public function requestDispatch(){
        return $this->hasMany(RequestDispatch::class, 'id');
    }

    public function responses(){
        return $this->hasMany(Response::class, 'id');
    }

    public function historyRequests(){
        return $this->hasMany(HistoryRequest::class, 'id');
    }
}
