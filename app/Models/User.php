<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'accountType',
        'email',
        'password',
        'fname',
        'mname',
        'lname',
        'gender',
        'birthdate',
        'contactNumber',
        'avatar',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requestDispatch(){
        return $this->hasMany(RequestDispatch::class, 'id');
        
    }

    public function responders(){
        return $this->hasMany(Responder::class, 'id');
        
    }

    public function historyRequests(){
        return $this->hasMany(HistoryRequest::class, 'id');
        
    }
}
